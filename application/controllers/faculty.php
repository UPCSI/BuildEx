<?php

class Faculty extends MY_Controller{
	
	public function index() {
		if(in_array('faculty',$this->session->userdata('role'))){
			$data['title'] = 'Faculty';
			$data['main_content'] = 'contents/faculty_body';
			$data['experiments'] = $this->get_all_experiments();
			$this->load->view('_main_layout', $data);
		}
		else
			redirect($this->session->userdata('role')[0]);
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