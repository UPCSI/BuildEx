<?php

class Home extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if(!$this->is_logged_in()){
			$data['title'] = 'Home';
			$data['main_content'] = 'home/index';
			$this->load->view('main_layout', $data);
		}
		else{
			redirect(role());
		}
	}

	public function redirect($role){
		$this->users_model->switch_roles($role);
		redirect($role);
	}

	public function is_logged_in(){
		return (bool) $this->session->userdata('logged_in');
	}

	public function reset(){
		$data['title'] = 'Reset Password';
		$data['main_content'] = 'forms/reset_password_form';
		$this->load->view('_main_layout', $data);			
	}

	public function reset_password() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
		if($this->form_validation->run() == TRUE) {
			$this->load->model('email_model');
			$email = $this->input->post('email');
			$reset = $this->email_model->edit_password($email);
			if($reset){
				echo "We just sent a temporary password to your email address.";
			}
			else{
				echo "We don't recognize that email. Please try again.";
			}
		}
		else{ 
			echo "Invalid input.";
		}
	}
}