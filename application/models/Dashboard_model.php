<?php
class Dashboard_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_users($username = FALSE) {
		if ($username === FALSE) {
			$this->db->select('
				user.publicId,
				user.username,
				user.firstName,
				user.lastName,
				user.isAvailable,
				user.note,
				status.title AS status
			');
			$this->db->from('user');
			$this->db->join('status', 'user.statusId = status.statusId','left');
			$this->db->order_by('lastName, firstName, username');
			$query = $this->db->get();
			return $query->result_array();
		}

		$this->db->select('
			user.publicId,
			user.username,
			user.firstName,
			user.lastName,
			user.isAvailable,
			user.note,
			status.publicId AS statusPublicId,
			status.title AS status
		');
		$this->db->from('user');
		$this->db->join('status', 'user.statusId = status.statusId','left');
		$this->db->where(array('username' => $username));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function set_user_status($username = FALSE) {
		$data = array(
			'username' => $username,
			'statusId' => null,
			'note' => $this->input->post('note'),
			'isAvailable' => $this->input->post('isAvailable')
		);

		//Get the private statusId
		$this->db->select('status.statusId');
		$query = $this->db->get_where('status',array('publicId' => $this->input->post('statusId')));
		$data['statusId'] =$query->row_array()['statusId'];

		$this->db->where('username', $username);
		return $this->db->update('user', $data);		
	}
}
?>
