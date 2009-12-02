<?php
class Admin extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->output->enable_profiler(TRUE);
	}

	function index() {
		$data['blog_table'] = $this->_list_blog_entries();

		$this->load->view('includes/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('includes/footer');
	}
	
	function add($title, $body, $blog_id = 1, $excerpt = '') {
		$this->load->model('Blog');
		$this->load->helper('sql_datetime');
		
		$this->Blog->add_entry(array(
			'blog_id' => $blog_id,
			'title' => $title,
			'body' => $body,
			'excerpt' => $excerpt,
			'datetime' => to_sql_datetime(time())
		));
	}

	function nuke() {
		$this->load->model('Tables');
		$this->Tables->nuke();
	}
	
	function do_once() {
		// $this->load->model('Tables');
		// $this->Tables->init_users();
	}

	/* Private functions */

	function _list_blog_entries() {
		$this->load->model('Blog');
		return $this->Blog->list_entries();
	}

	function _list_all_tables() {
		$this->load->database();

		$tables = $this->db->list_tables();
		$ret = '';
		
		foreach ($tables as $table) {
			$ret .= $table . "<br>\n";

			$fields = $this->db->list_fields($table);
			foreach ($fields as $field) {
				$ret .= '&rarr; ' . $field . "<br>\n";
			}

			$query = $this->db->get($table);
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					foreach ($row as $item) {
						$ret .= ' ' . $item;
					}
					$ret .= "<br>\n";;
				}
			}
			
			$ret .= "<br>\n";
		}
		
		return $ret;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
