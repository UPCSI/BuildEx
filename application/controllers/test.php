<?php

class Test extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('admins_model');
		$this->load->model('experiments_model');
		$this->load->model('faculty_model');
		$this->load->model('graduates_model');
		$this->load->model('respondents_model');
		$this->load->model('users_model');
	}

	public function index(){

		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}
}