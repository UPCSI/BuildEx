<?php

class Faculty extends MY_Controller{
	
	public function index() {
		if(in_array('faculty',$this->session->userdata('role'))){
			$data['title'] = 'Faculty';
			$data['main_content'] = 'contents/faculty_body';
			$data['experiments'] = $this->get_all_experiments($this->session->userdata('id'));
			$this->load->view('_main_layout', $data);
		}
		else{
			$role = $this->session->userdata('role');
			redirect($role[0]);
		}
	}

	public function get_all_experiments($id = 0){
		$this->load->model('experiments_model');
		$list = $this->experiments_model->get_users_experiments($id);
		if($list == NULL)
			$list = array();
		
		return $list;
	}

	public function edit_faculty($id = NULL){
		$uid = explode('_', $id)[0];
		$fid = explode('_', $id)[1];

		$this->load->model('faculty_model');
		$data['title'] = 'Profile';
		$data['profile'] = $this->faculty_model->get_faculty_profile($fid);
		$data['experiments'] = $this->get_all_experiments($uid);
		$data['main_content'] = 'contents/profile';
		$this->load->view('_main_layout', $data);
	}
}