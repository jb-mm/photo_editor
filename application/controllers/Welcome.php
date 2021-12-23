<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends My_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		// if (!$this->session->has_userdata('state')) {
		// 	$this->load->view('templates/login');
		// } else {
		// 	redirect('home');
		// }
		$this->__logged_in();
		$this->load->view('templates/login');
	}

	public function home() {
		$this->__not_logged_in();
		$per_page = 10;
		$page_no = $this->uri->segment(2) ? $this->uri->segment(2) : 0;
		// pagination
		$config['base_url'] = base_url().'home/';
		$config['total_rows'] = $this->__pagination_total_rows('images');
		$config['per_page'] = $per_page;
		$config['reuse_query_string'] = TRUE;
		$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center mt-2">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['cur_tag_open'] = '<li class="page-item"><a class="page-link active">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$this->pagination->initialize($config);

		$this->db->order_by('created_at', 'ASC');
		$images = $this->__pagination_total_result('images', NULL, $per_page, $page_no);
		$default = [
			'content' => 'pages/index',
			'images' => $images,
			'pagination' => $this->pagination->create_links(),
		];
		$this->load->view('templates/index', $default);
	}

	public function login_action() {
		$this->__just_click();
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$_chk_login = $this->__chk_login($username, $password);
		$this->session->set_flashdata('msg', $_chk_login);
		
		redirect(base_url());
	}

	public function logout_action() {
		$this->__just_click();
		$this->__logout();
	}

	public function image_public() {
		$uuid = $this->uri->segment(2);
		$get_name = $_GET['name'] ?? NULL;
		$get_key = $_GET['key'] ?? NULL;

		if (!$get_name || !$get_key) {
			// $this->session->set_flashdata('auth_msg', 'You did not set name or passcode!');
			$image = NULL;
		} else {
			$image = $this->db->get_where('images', ['uuid' => $uuid, 'name_id' => $get_name, 'key_id' => $get_key])->row();
		}
		$default = [
			'content' => 'preview',
			'image' => $image,
			'uuid' => $uuid,
			'name_id' => $get_name,
			'key_id' => $get_key
		];
		$this->load->view('templates/index', $default);
	}
}
