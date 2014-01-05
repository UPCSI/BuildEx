<?php

class Graduate extends MY_Controller{
	
	public function index() {
		$data['title'] = 'Graduate';
		$data['main_content'] = 'contents/graduate_body';
		$data['experiments'] = $this->get_all_experiments();
		$this->load->view('_main_layout', $data);
	}

	public function get_all_experiments(){
		$this->load->model('experiments_model');
		$list = $this->experiments_model->get_users_experiments($this->session->userdata('id'));
		if($list != NULL){
			return $list;
		}
		else{
			return $list = [];
		}
	}
}