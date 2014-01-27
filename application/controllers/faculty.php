<?php

class Faculty extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('faculty_model');
		
	}
	
	public function index(){
		if(in_array('faculty',$this->session->userdata('role'))){
			$this->load->model('experiments_model');
			$data['title'] = 'Faculty';
			$data['main_content'] = 'contents/faculty_body';
			$data['experiments'] = $this->experiments_model->get_all_faculty_experiments($this->session->userdata('active_id'));
			$this->load->view('_main_layout', $data);
		}
		else{
			$role = $this->session->userdata('role');
			redirect($role[0]);
		}
	}

	public function get_all_experiments($fid = 0){
		$this->load->model('experiments_model');
		$list = $this->experiments_model->get_all_faculty_experiments($fid);
		if($list == NULL)
			$list = array();
		return $list;
	}

	public function edit_faculty($uid = 0, $fid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['faculty_profile'] = $this->faculty_model->get_faculty_profile($fid);
		$data['experiments'] = $this->get_all_experiments($fid);
		$data['main_content'] = 'contents/profile';
		$this->load->view('_main_layout', $data);
	}
}