<?php

class MY_Controller extends Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		
		if (!$this->session->userdata('loggedin')) {
			header('Location: /auth/login');
		}
	}
}

?>