<?php

class Login extends MY_Controller{

	public function index(){
		
	}

	public function validate_user(){
		$this->load->model('users_model');

		$username = $this->input->post('username');
		$password = $this->input->post('password');
	}
}