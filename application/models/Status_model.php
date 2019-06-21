<?php
class Status_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_statuses($publicId = FALSE) {
		if ($publicId === FALSE) {
			$this->db->order_by('title');
			$query = $this->db->get('status');
			return $query->result_array();
		}

		$query = $this->db->get_where('status', array('publicId' => $publicId));
		return $query->row_array();
	}

	public function set_status($publicId = FALSE) {
		$data = array(
			'publicId' => $this->input->post('publicId'),
			'title' => $this->input->post('title')
		);

		if(empty($publicId)){
			return $this->db->insert('status', $data);
		} else {
			$this->db->where('publicId', $publicId);
			return $this->db->update('status', $data);	
		}
	}

	public function delete_status($publicId = FALSE) {
		return $this->db->delete('status', array('publicId' => $publicId));
	}
}
?>