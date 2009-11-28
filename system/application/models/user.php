<?php

class User extends Model {

	function __construct() {
		parent::__construct();

		$this->load->database();
	}

	function authenticate($name, $pass) {
		$pass_hash = sha1($pass);
		
		$this->db->select('*')->from('users')->where('name', $name)->where('pass', $pass_hash);
		$query = $this->db->get();
		
		return $query->num_rows();
	}
}

?>
