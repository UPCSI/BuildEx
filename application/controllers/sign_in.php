<?php

class Sign_in extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){
		$data['title'] = 'Sign in';
		$data['main_content'] = 'signin/index';
		$data['notification'] = $this->session->flashdata('notification');	
		$this->load->view('main_layout', $data);
	}

	public function validate_user(){
		$rules = $this->user_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($this->user_model->is_valid_user($username, $password)){
				$this->user_model->set_session_data($username);
				$active_role = $this->session->userdata('active_role');

				if($active_role == 'faculty' && $this->user_model->confirmed_faculty() == "t"){
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
		redirect('sign_in');
	}
}