<?php

class Junk extends Controller {

	function __construct() {
		parent::__construct();
		
		$this->output->enable_profiler(TRUE);
	}
	
	function index() {
		echo "hey!";
	}
}

/* End of file junk.php */
/* Location: ./system/application/controllers/junk.php */