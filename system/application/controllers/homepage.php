<?php
class Homepage extends Controller {

	function __construct() {
		parent::__construct();
		
		$this->output->enable_profiler(TRUE);
	}
	
	function index() {
		$this->load->model('Blog');
		$this->load->helper('sql_datetime_helper');
		$data['entries'] = $this->Blog->list_entries();

		$this->load->view('includes/header', $data);
		$this->load->view('homepage', $data);
		$this->load->view('includes/footer');
	}
}

/* End of file junk.php */
/* Location: ./system/application/controllers/junk.php */
