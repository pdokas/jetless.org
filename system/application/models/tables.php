<?php

class Tables extends Model {

	function __construct() {
		parent::__construct();
		
		$this->load->dbforge();
	}
	
	function nuke() {
		$this->_init_blogs();
		$this->_init_blog_entries();
		$this->_stub_in_data();
	}
	
	function init_blogs() { return $this->_init_blogs(); }
	function init_blog_entries() { return $this->_init_blog_entries(); }
	
	function _init_blogs() {
		$this->dbforge->drop_table('blogs');
		
		$this->dbforge->add_field(array(
			'blog_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('blog_id', TRUE);
		$this->dbforge->create_table('blogs', TRUE);
	}
	
	function _init_blog_entries() {
		$this->dbforge->drop_table('blog_entries');
		
		$this->dbforge->add_field(array(
			'entry_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'blog_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'body' => array(
				'type' => 'TEXT'
			),
			'excerpt' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'datetime' => array(
				'type' => 'DATETIME'
			)
		));
		$this->dbforge->add_key('entry_id', TRUE);
		// $this->dbforge->add_key('blog_id');
		$this->dbforge->create_table('blog_entries', TRUE);
	}
	
	function _stub_in_data() {
		$this->db->insert('blogs', array(
			'name' => 'Everything',
			'description' => "Ph'nglui mglw'nafh Cthulhu R'lyeh wgah'nagl fhtagn"
		));
	}
}

?>