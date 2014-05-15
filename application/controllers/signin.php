<?php

class SignIn extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('users_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['title'] = 'Sign in';
		$data['main_content'] = 'signin/index';
		$notif = $this->session->flashdata('notification');
		if(isset($notif)){
			$data['notification'] = $notif;
		}
		$this->load->view('main_layout', $data);
	}

	public function validate_user(){
		$rules = $this->users_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($this->users_model->is_valid_user($username, $password)){
				$this->users_model->set_session_data($username);
				$active_role = $this->session->userdata('active_role');

				if($active_role == 'faculty' && $this->users_model->confirmed_faculty() == "t"){
					redirect('faculty');
				}
				else if($active_role != 'faculty'){
					redirect($active_role);
				}
				else{
					$new_session['logged_in'] = FALSE;
					$this->session->set_userdata($new_session);
					redirect('');
				}
			}
		}
		$msg = "Invalid username or password. Please try again.";
		$this->session->set_flashdata('notification',$msg);
		redirect('signin');
	}
}