<?php
class Blog extends Model {

	function __construct() {
		parent::__construct();

		$this->load->database();
	}

	function add_entry($values) {
		return $this->db->insert('blog_entries', $values);
	}

	function list_entries($start = 0, $length = 10) {
		$query = $this->db->get('blog_entries', $start, $length);

		$result = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$result[] = $row;
			}
		}
		
		return $result;
	}
}

/* End of file blog.php */
/* Location: ./system/application/models/blog.php */