<?php

class Welcome extends Controller {

	function __construct() {
		parent::__construct();
		
		$this->output->enable_profiler(TRUE);
	}
	
	function index() {
		$this->load->view('welcome_message');
	}
	
	function foo() {
		echo "foo!";
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */