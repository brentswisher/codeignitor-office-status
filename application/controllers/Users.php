<?php
class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper('url_helper');
	}

	public function index() {
		$data['users'] = $this->users_model->get_users();
		$data['title'] = 'User List';

		$this->load->view('templates/header', $data);
		$this->load->view('users/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($username = NULL){
		$data['user_detail'] = $this->users_model->get_users($username);
		if (empty($data['user_detail'])){
			show_404();
		}

		$data['title'] = $data['user_detail']['username'];

		$this->load->view('templates/header', $data);
		$this->load->view('users/view', $data);
		$this->load->view('templates/footer');
	}

}
?>