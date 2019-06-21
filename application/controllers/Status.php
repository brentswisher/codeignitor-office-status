<?php
class Status extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('status_model');
		$this->load->helper('url_helper');
	}

	public function index() {
		$data['statuses'] = $this->status_model->get_statuses();
		$data['title'] = 'Status List';

		$this->load->view('templates/header', $data);
		$this->load->view('status/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit($publicId = NULL) {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['status_item'] = $this->status_model->get_statuses($publicId);
		if (empty($data['status_item'])){
			$data['title'] = 'Create a new status';
		} else {
			$data['title'] = 'Edit status '.$data['status_item']['title'];	
		}
		
		$this->form_validation->set_rules('title', 'Title', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('status/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->status_model->set_status($data['status_item']['publicId']);
			redirect('/status/');
		}
	}

	public function delete($publicId = NULL) {
		// $this->load->helper('session');
		$data['status_item'] = $this->status_model->get_statuses($publicId);
		if (empty($data['status_item'])){
			show_404();
		}
		$this->status_model->delete_status($publicId);
		// $this->session->set_flashdata('message', 'User '.$usernaem.' successfully deleted');
		redirect('/status/');
	}
}
?>