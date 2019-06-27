<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('status_model');
		$this->load->helper('url_helper');
	}

	public function index() {
		$data['users'] = $this->dashboard_model->get_users();
		$data['statuses'] = $this->status_model->get_statuses();
		$data['title'] = 'Office Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer');
	}

	public function status($username = NULL) {
		//Note: This is only accesses via ajax and returns JSON
		$data['users'] = $this->dashboard_model->get_users($username);
		if (empty($data['users'])){
			show_404();
		}
		$this->load->view('dashboard/api/status', $data);
	}
}
?>