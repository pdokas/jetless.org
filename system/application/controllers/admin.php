<?php

class Admin extends Controller {

	function __construct() {
		parent::__construct();

		$this->output->enable_profiler(TRUE);
	}

	function index() {
		$data['content'] = $this->_list_blogs();

		$this->load->view('admin/header');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer');
	}
	
	function add($blog_id, $title, $body, $excerpt = '') {
		$this->load->model('Blog');
		$this->load->plugin('sql_datetime');
		
		$this->Blog->add_entry(array(
			'blog_id' => $blog_id,
			'title' => $title,
			'body' => $body,
			'excerpt' => $excerpt,
			'datetime' => sql_datetime(time())
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

	function _list_blogs() {
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

/* End of file junk.php */
/* Location: ./system/application/controllers/junk.php */
