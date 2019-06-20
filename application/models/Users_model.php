<?php
class Users_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_users($username = FALSE) {
		if ($username === FALSE) {
			$query = $this->db->get('office_user');
			return $query->result_array();
		}

		$query = $this->db->get_where('office_user', array('username' => $username));
		return $query->row_array();
	}
}
?>