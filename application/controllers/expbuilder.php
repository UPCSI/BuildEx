<?php

class Expbuilder extends MY_Controller{

	public function __construct(){
		parent::__construct();
		#$this->load->model('graduates_model');
	}
	
	public function index() {
		$data['title'] = 'Experiment Builder';
		$data['main_content'] = 'expbuilder/workspace';
		$this->load->view('expbuilder/layout', $data);
	}
}