<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();
		// import libraries
		$this->load->library(['session', 'email', 'form_validation', 'pagination', 'calendar', 'zip', 'user_agent']); // 'phpqrcode/QRlib'
		// import helpers
        $this->load->helper(['url', 'file', 'form', 'string', 'date', 'inflector', 'download']); // singular, plural, camelize, underscore, humanize, is_countable(bool)
        
        date_default_timezone_set('Asia/Rangoon');

        $this->load->database();
        $this->load->model(['main_model' => 'mmodel', 'table_model' => 'tmodel']);

        $this->tmodel->create_tbls();
	}

    protected function __chk_login($username, $password) {
        if ( !$username  && !$password ) {
            return 4;
        }
        if ( !$password ) {
            return 5;
        }
        $chk_user = $this->db->get_where('users', ['username' => $username])->row();
        if ($chk_user) {
            if (password_verify($password, $chk_user->password)) {
            	$sess_data = [
            		'id' => $chk_user->id,
            		'uuid' => $chk_user->uuid,
            		'name' => $chk_user->name,
            		'username' => $chk_user->username,
            		'state' => TRUE,
            	];
                $this->session->set_userdata($sess_data);
                // ok state
                return 1;
            } else {
            	// wrong password
                return 3;
            }
        } else {
            // wrong username or no account
            return 2;
        }
    }

    protected function __logged_in() {
    	if ($this->session->has_userdata('state')) {
    		redirect('home');
    	}
    }

    // redirect login page if no session data
    protected function __not_logged_in() {
    	if (!$this->session->has_userdata('state')) {
    		redirect(base_url());
    	}
    }

    // logout
    protected function __logout() {
    	$this->session->sess_destroy();
		redirect(base_url());
    }

	/* ==================================
	check url is redirected or not
	================================== */
	protected function __just_click() {
		if (!isset($_SERVER['HTTP_REFERER'])) {
			redirect('home');
		}
	}

    /* ==================================
    Pagination funcs
    ================================== */
    protected function __pagination_total_rows($tbl, $search_name = null) {
        return $this->db->count_all_results($tbl);
    }

    protected function __pagination_total_result($tbl, $search_name = null, $per_page = null, $page_no = null) {
        $this->db->limit($per_page, $page_no);
        return $this->db->get($tbl)->result();
    }

    protected function __generate_qr($qr_name, $name, $key_id) {
        $qr_code = $qr_name.".png";
        $folder = FCPATH."assets/qr/";
        $text = base_url()."images/$qr_name?name=$name&passcode=$key_id";
        $save_qr_png = $folder.$qr_code;
        QRcode::png($text, $save_qr_png);
        return $qr_code;
    }
}