<?php
class Auth extends Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');

		$this->output->enable_profiler(TRUE);
	}
	
	public function index() {
		if (!$this->session->userdata('loggedin')) {
			$this->login();
		}
		else {
			header('Location: /admin');
		}
	}

	public function login() {
		$this->load->view('includes/header');
		$this->load->view('admin/login');
		$this->load->view('includes/footer');
	}

	public function check() {
		$this->load->model('user');
		
		if ($this->user->authenticate($this->input->post('user'), $this->input->post('pass'))) {
			$this->session->set_userdata('loggedin', TRUE);
			
			$bounce_to = '/admin';
			if ($this->input->post('referer')) {
				$bounce_to = $this->input->post('referer');
			}
			header('Location: ' . $bounce_to);
		}
		else {
			header('Location: /auth');
		}
	}

	public function logout() {
		$this->session->unset_userdata('loggedin');
		header('Location: /');
	}
	
}

/* End of file auth.php */
/* Location: ./system/application/controllers/auth.php */
