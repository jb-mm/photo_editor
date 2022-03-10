<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		function title() {
			echo "Image Share";
		}
        
		function id_num($value = null, $delimeter = 3) {
			return str_pad($value, $delimeter, 0, STR_PAD_LEFT);
		}

		function error_msg($value = null) {
			switch ($value) {
				case '1': return 'Welcome!'; break;
				case '2': return 'username is invalid'; break;
				case '3': return 'password is invalid'; break;
				case '4': return 'username and password are required'; break;
				case '5': return 'password is required'; break;
				default: return 'no messsage'; break;
			}
		}

		function random_str($length = 54) {
			return substr(str_shuffle("0123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnopqrstvwxyz"), 0, $length).getdate()[0];
		}

		function get_uuid($trim = true) {
			$format = ($trim == false) ? '%04x%04x-%04x-%04x-%04x-%04x%04x%04x' : '%04x%04x%04x%04x%04x%04x%04x%04x';
			return sprintf($format,

				// 32 bits for "time_low"
				mt_rand(0, 0xffff), mt_rand(0, 0xffff),

				// 16 bits for "time_mid"
				mt_rand(0, 0xffff),

				// 16 bits for "time_hi_and_version",
				// four most significant bits holds version number 4
				mt_rand(0, 0x0fff) | 0x4000,

				// 16 bits, 8 bits for "clk_seq_hi_res",
				// 8 bits for "clk_seq_low",
				// two most significant bits holds zero and one for variant DCE1.1
				mt_rand(0, 0x3fff) | 0x8000,

				// 48 bits for "node"
				mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
			);
		}
	}

	public function name($value) {
		return $this->db->get_where('users', ['id' => $value])->row()->name;
	}

	public function image_sum() {
		$total = $this->db->query('SELECT SUM(image_size) as size FROM images')->row()->size;
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 
		$bytes = max($total, 0); 
		$pow = floor(($total ? log($total) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		// Uncomment one of the following alternatives
		// $total /= pow(1024, $pow);
		$total /= (1 << (10 * $pow)); 

		return round($total, 3).' '.$units[$pow]." of 50 GB";
	}
}
