<?php
class Users_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_users($username = FALSE) {
		if ($username === FALSE) {
			$query = $this->db->get('user');
			return $query->result_array();
		}

		$query = $this->db->get_where('user', array('username' => $username));
		return $query->row_array();
	}

	public function set_user() {
		$this->load->helper('url');

		$username = url_title($this->input->post('username'), 'dash', TRUE);

		$data = array(
			'username' => $username,
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName')
		);

		return $this->db->insert('user', $data);
	}
	public function delete_user($username = FALSE) {
		$this->load->helper('url');

		$username = url_title($username, 'dash', TRUE);

		return $this->db->delete('user', array('username' => $username));
	}
}
?>