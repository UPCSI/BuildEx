<?php 
class Sign_up extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index($role = 'graduate'){
		$data['title'] = "Sign Up";
		$data['role'] = $role;
		$data['notification'] = $this->session->flashdata('notification');	
		$data['main_content'] = 'signup/index';
		$this->load->view('main_layout',$data);
	}

	public function success(){
		$data['title'] = "Sign Up";
		$data['notification'] = $this->session->flashdata('notification');	
		$data['main_content'] = 'signup/success';
		$this->load->view('main_layout',$data);
	}

	public function confirm_email($email, $email_code){
		$email_code = trim($email_code);
		if($this->email_model->validate_email($email, $email_code)) {
			$this->email_model->activate_user($email);
			$msg = "You have successfully confirmed your e-mail address!";
		}
		else{
			$msg = "A problem was encountered while validating your e-mail address. Please try again.";
		}
		$this->session->set_flashdata('notification', $msg);
	}

}