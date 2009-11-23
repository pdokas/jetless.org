<?php

class Junk extends Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->dbutil();
		
		$this->output->enable_profiler(TRUE);
	}
	
	function index() {
		$dbs = $this->dbutil->list_databases();

		foreach($dbs as $db) {
			$tables = $this->db->list_tables();

			foreach ($tables as $table) {
			   echo $db . ' ' . $table . "<br />\n";
			}
		}
	}
}

/* End of file junk.php */
/* Location: ./system/application/controllers/junk.php */