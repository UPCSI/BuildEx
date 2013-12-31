<?php 

class Home extends MY_Controller{

	public function index(){
		$this->load->model('admins_model');
		$data['title'] = 'Home';
		$data['main_content'] = 'home_body';
		$this->load->view('_main_layout', $data);
	}
}