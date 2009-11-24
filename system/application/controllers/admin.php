<?php

class Admin extends Controller {

	function __construct() {
		parent::__construct();

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

	/* Private functions */

	function _list_blogs() {
		$this->load->database();

		$tables = $this->db->list_tables();

		foreach ($tables as $table) {
			echo $table . "<br />\n";

			$fields = $this->db->list_fields($table);
			foreach ($fields as $field) {
				echo '&rarr; ' . $field . "<br />\n";
			}

			$query = $this->db->get($table);
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					foreach ($row as $item) {
						echo ' ' . $item;
					}
					echo "<br />\n";;
				}
			}
			
			echo "<br />\n";
		}
	}

	function nuke() {
		$this->load->model('Tables');
		$this->Tables->nuke();
	}
}

/* End of file junk.php */
/* Location: ./system/application/controllers/junk.php */
