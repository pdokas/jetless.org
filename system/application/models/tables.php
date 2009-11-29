<?php
class Tables extends Model {

	function __construct() {
		parent::__construct();
		
		$this->load->dbforge();
	}
	
	function nuke() {
		$this->init_sessions();
		$this->init_users();
		$this->init_blogs();
		$this->init_blog_entries();
		$this->stub_in_data();
	}

	// TODO: Remove all of these
	function init_sessions()		{ return $this->_init_sessions();		}
	function init_users()			{ return $this->_init_users();			}
	function init_blogs()			{ return $this->_init_blogs();			}
	function init_blog_entries()	{ return $this->_init_blog_entries();	}
	function stub_in_data()			{ return $this->_stub_in_data();		}
	
	/* Private functions */
	
	function _init_sessions() {
		$this->dbforge->drop_table('ci_sessions');
		
		$this->dbforge->add_field(array(
			'session_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'default' => '0'
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => 16,
				'default' => '0'
			),
			'user_agent' => array(
				'type' => 'VARCHAR',
				'constraint' => 50
			),
			'last_activity' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'default' => '0'
			),
			'user_data' => array(
				'type' => 'TEXT'
			)
		));
		$this->dbforge->add_key('session_id', TRUE);
		$this->dbforge->create_table('ci_sessions', TRUE);
	}

	function _init_users() {
		$this->dbforge->drop_table('users');
		
		$this->dbforge->add_field(array(
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			),
			'pass' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			)
		));
		$this->dbforge->add_key('name', TRUE);
		$this->dbforge->create_table('users', TRUE);
	}
	
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
			'mode' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'default' => 'draft'
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
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
		
		$this->db->insert('users', array(
			'name' => 'phil',
			'pass' => '74fc3f83082d2f69b99a4155e393357576f2d7cd'
		));
	}
}

/* End of file tables.php */
/* Location: ./system/application/models/tables.php */