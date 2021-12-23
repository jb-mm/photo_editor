<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}

	public function create_tbls() {
		/* usres */
		$fields = [
			'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE],
			'uuid' => ['type' => 'VARCHAR', 'constraint' => 191],
			'name' => ['type' => 'VARCHAR', 'constraint' => 191],
			'username' => ['type' => 'VARCHAR', 'constraint' => 191, 'unique' => TRUE],
			'password' => ['type' => 'VARCHAR', 'constraint' => 191],
			'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
			'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users', TRUE);
		$chk_users = $this->db->count_all_results('users');
        if($chk_users < 1) {
            $data = [
            	[
	            	'uuid' => random_str(),
	            	'name' => 'System',
	                'username' => 'system',
	                'password' => password_hash("123123", PASSWORD_DEFAULT, [24]),
	            ],
            	[
	            	'uuid' => random_str(),
	            	'name' => 'Admin',
	                'username' => 'admin',
	                'password' => password_hash("admin123!@#", PASSWORD_DEFAULT, [24]),
	            ]
			];
            $this->db->insert_batch('users', $data);
        }

		// Image
		$fields = [
			'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE],
			'uuid' => ['type' => 'VARCHAR', 'constraint' => 191],
			'orig_name' => ['type' => 'VARCHAR', 'constraint' => 191],
			'image_type' => ['type' => 'VARCHAR', 'constraint' => 191],
			'image_size' => ['type' => 'INTEGER', 'constraint' => 191],
			'image_width' => ['type' => 'INTEGER', 'constraint' => 191],
			'image_height' => ['type' => 'INTEGER', 'constraint' => 191],
			'file_name' => ['type' => 'VARCHAR', 'constraint' => 191],
			'file_ext' => ['type' => 'VARCHAR', 'constraint' => 191],
			'name_id' => ['type' => 'VARCHAR', 'constraint' => 191],
			'key_id' => ['type' => 'VARCHAR', 'constraint' => 191],
			'qr_code' => ['type' => 'VARCHAR', 'constraint' => 191],
			'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
			'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('images', TRUE);
	}
}
