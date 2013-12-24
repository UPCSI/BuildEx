<?php 
class Signup extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = "Sign Up";
		$data['role'] = 'none';
		$this->load->view('templates/signup_template',$data);
	}

	public function student(){
		$data['title'] = "Sign Up";
		$data['role'] = 'student';
		$this->load->view('templates/signup_template',$data);
	}

	public function faculty(){
		$data['title'] = "Sign Up";
		$data['role']= 'faculty';
		$this->load->view('templates/signup_template',$data);
	}
}