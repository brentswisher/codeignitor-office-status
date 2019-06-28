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
		$method = $this->input->method();
		if($method == 'get'){
			//Get current status
			$data['response'] = $this->dashboard_model->get_users($username);
			if (empty($data['response'])){
				show_404();
			}
		} else if ($method == 'post') {
			//Update a status
			$data['response'] = $this->dashboard_model->set_user_status($username);
			if (empty($data['response'])){
				show_404();
			}
		}
		$this->load->view('dashboard/api/status', $data);
	}
}
?>