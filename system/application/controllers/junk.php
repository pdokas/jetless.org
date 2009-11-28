<?php

class Junk extends Controller {

	function __construct() {
		parent::__construct();
		
		$this->output->enable_profiler(TRUE);
	}
	
	function index() {
		$this->load->library('session');
		
		echo ($this->session->userdata('loggedin') ? 'Logged in' : 'Not logged in') . '<br>';
		echo "<a href='/auth/'>Login</a><br>";
		echo "<a href='/auth/logout'>Logout</a><br>";
	}
}

/* End of file junk.php */
/* Location: ./system/application/controllers/junk.php */