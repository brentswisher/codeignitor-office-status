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

	public function create() {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create a new user';

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('firstName', 'First Name', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/create');
			$this->load->view('templates/footer');
		} else {
			$this->users_model->set_user();
			redirect('/users/');
		}
	}

	public function delete($username = NULL) {
		// $this->load->helper('session');
		$data['user_detail'] = $this->users_model->get_users($username);
		if (empty($data['user_detail'])){
			show_404();
		}
		$this->users_model->delete_user($username);
		// $this->session->set_flashdata('message', 'User '.$usernaem.' successfully deleted');
		redirect('/users/');
	}
}
?>