<?php
class MY_Controller extends Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		
		if (!$this->session->userdata('loggedin')) {
			$this->session->set_userdata('redirect_to', $_SERVER['REQUEST_URI']);
			header('Location: /auth/');
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./system/application/libraries/MY_Controller.php */
