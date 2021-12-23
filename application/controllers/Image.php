<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(FCPATH.'application/libraries/phpqrcode/QRlib.php');

class Image extends My_Controller {
	public function __construct() {
		parent::__construct();
        $this->__not_logged_in();
        $this->__just_click();
	}

    public function image_store() {
		$name = $this->input->post('name', TRUE);
		$password = $this->input->post('password', TRUE);
		if ( !$name ) {
			$this->session->set_flashdata('err_msg', 'You did not set name.');
			redirect('home');
		}
		if ( $password ) {
			if( strlen($password) < 5 ) {
				$this->session->set_flashdata('err_msg', 'Passcode must have minimum 6 charaters.');
				redirect('home');
			}
		} else {
			$this->session->set_flashdata('err_msg', 'You did not set passcode.');
			redirect('home');
		}

		$config['upload_path']= './assets/images/';
		$config['allowed_types']= 'gif|jpg|png|jpeg|webp';
		$config['encrypt_name']= TRUE;
		$config['detect_mime']= TRUE;
		$config['remove_spaces']= TRUE;
		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload('image') ) {
			$this->session->set_flashdata('err_msg', $this->upload->display_errors());
		} else {
            $uuid = get_uuid();
			$key_id = $password;
			$data = $this->upload->data();
            
			// Generate QR
			$qr_code = $this->__generate_qr($uuid, $name, $key_id);

			// db
			$insert_data = [
				'uuid' => $uuid,
				'orig_name' => $data['orig_name'],
				'image_type' => $data['image_type'],
				'image_size' => $data['file_size'],
				'image_width' => $data['image_width'],
				'image_height' => $data['image_height'],
				'file_name' => $data['file_name'],
				'file_ext' => $data['file_ext'],
				'name_id' => $name,
				'key_id' => $key_id,
				'qr_code' => $qr_code
			];
			$this->db->insert('images', $insert_data);
			$this->session->set_flashdata('ok_msg', $insert_data);
		}

		redirect('home');
	}

	public function image_edit() {
		$image = $this->db->get_where('images', ['uuid' => $this->uri->segment(2)])->row();
		$default = [
			'content' => 'pages/images/edit',
			'image' => $image
		];
		$this->load->view('templates/index', $default);
	}

	public function image_update() {
		$uuid = $this->input->post('uuid', TRUE);
		$name = $this->input->post('name', TRUE);
		$password = $this->input->post('password', TRUE);
		if ( !$name ) {
			$this->session->set_flashdata('err_msg', 'You did not set name.');
			redirect('upload/'.$uuid);
		}
		if ( $password ) {
			if( strlen($password) < 5 ) {
				$this->session->set_flashdata('err_msg', 'Passcode must have minimum 6 charaters.');
				redirect('upload/'.$uuid);
			}
		} else {
			$this->session->set_flashdata('err_msg', 'You did not set passcode.');
			redirect('upload/'.$uuid);
		}

		$old_image = $this->db->get_where('images', ['uuid' => $uuid])->row();
		$key_id = $password;

		if ( $_FILES['image']['name'] ) {
			$config['upload_path']= './assets/images/';
			$config['allowed_types']= 'gif|jpg|png|jpeg|webp';
			$config['encrypt_name']= TRUE;
			$config['detect_mime']= TRUE;
			$config['remove_spaces']= TRUE;
			$this->load->library('upload', $config);
			if ( !$this->upload->do_upload('image') ) {
				$this->session->set_flashdata('err_msg', $this->upload->display_errors());
				redirect('upload/'.$uuid);
			} else {
				// delete old photo
				if( file_exists('assets/images/'.$old_image->file_name) ) {
					unlink('assets/images/'.$old_image->file_name);
				}
				$data = $this->upload->data();

				// update to db
				$update_data = [
					'orig_name' => $data['orig_name'],
					'image_type' => $data['image_type'],
					'image_size' => $data['file_size'],
					'image_width' => $data['image_width'],
					'image_height' => $data['image_height'],
					'file_name' => $data['file_name'],
					'file_ext' => $data['file_ext']
				];
				$this->db->update('images', $update_data, ['uuid' => $uuid]);
			}
		}

		// delete old qr
		if( file_exists('assets/qr/'.$old_image->qr_code) ) {
			unlink('assets/qr/'.$old_image->qr_code);
		}
		// Generate QR
		$qr_code = $this->__generate_qr($uuid, $name, $key_id);

		$this->db->update('images', ['qr_code' => $qr_code, 'name_id' => $name, 'key_id' => $key_id], ['uuid' => $uuid]);
			
		redirect('upload/'.$uuid);
	}

	public function image_show() {
		$image = $this->db->get_where('images', ['uuid' => $this->uri->segment(2)])->row();
		$default = [
			'content' => 'pages/images/show',
			'image' => $image
		];
		$this->load->view('templates/index', $default);
	}

	public function image_delete() {
		$uuid = $this->uri->segment(2);
		$image = $this->db->get_where('images', ['uuid' => $uuid])->row();
		// delete photo
		if( file_exists('assets/images/'.$image->file_name) ) {
			unlink('assets/images/'.$image->file_name);
		}
		// delete qr
		if( file_exists('assets/qr/'.$image->qr_code) ) {
			unlink('assets/qr/'.$image->qr_code);
		}
		// delete from db
		$this->db->delete('images', ['uuid' => $uuid]);
		$this->session->set_flashdata('del_msg', 'Successfully Removed!');

		redirect('home');
	}
}