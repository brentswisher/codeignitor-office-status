<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->helper('url_helper');
	}

	public function index() {
		$data['users'] = $this->dashboard_model->get_users();
		$data['title'] = 'Office Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer');
	}
}
?>