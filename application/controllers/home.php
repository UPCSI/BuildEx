<?php 

class Home extends MY_Controller{

	public function index(){
		$this->load->model('admins_model');
		$data['title'] = 'Home';
		$this->load->view('templates/home_template',$data);
	}
}