<?php

class Admin extends Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->dbforge();
		
		$this->output->enable_profiler(TRUE);
	}
	
	function index() {
		// $data['page_title'] = 'Your title';
		// $this->load->view('header');
		// $this->load->view('menu');
		// $this->load->view('content', $data);
		// $this->load->view('footer');
		
		$this->_list_blogs();
	}
	
	function create_blogs() {
		$this->dbforge->add_field(array(
			'blog_id' => array(
				'type' => 'INT',
				'constraint' => 5, 
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			)
		));
		$this->dbforge->add_key('blog_id', TRUE);
		$this->dbforge->create_table('blogs', TRUE);
	}
	
	/* Private functions */
	
	function _list_blogs() {
		$tables = $this->db->list_tables();

		foreach ($tables as $table) {
			echo $table . "<br />\n";
			
			$fields = $this->db->list_fields('blogs');

			foreach ($fields as $field) {
			   echo '&rarr; ' . $field . "<br />\n";
			}
		}
	}
}

/* End of file junk.php */
/* Location: ./system/application/controllers/junk.php */