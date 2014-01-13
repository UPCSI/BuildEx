<?php

class Admin extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('admins_model');
	}
	
	public function index() {
		if(in_array('admin',$this->session->userdata('role'))){
			$data['title'] = 'Admin';
			$data['main_content'] = 'contents/admin_body';
			$data['admins'] = $this->get_admin_list();
			$data['faculty'] = $this->get_faculty_list();
			$data['graduates'] = $this->get_graduate_list();
			$data['respondents'] = $this->get_respondent_list();
			$this->load->view('_main_layout', $data);
		}
		else{
			redirect($this->session->userdata('role')[0]);
		}
	}

	public function get_admin_list(){
		$list = $this->admins_model->get_all_admins();
		if($list != NULL){
			return $list;
		}
		else{
			return $list = [];
		}
	}

	public function edit_admin($uid = 0, $aid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['admin_profile'] = $this->admins_model->get_admin_profile($aid);
		$data['main_content'] = 'contents/profile';
		$data['experiments'] = -1;
		$this->load->view('_main_layout', $data);
	}

	public function get_faculty_list(){
		$this->load->model('faculty_model');
		$list = $this->faculty_model->get_all_faculty();
		if($list != NULL){
			return $list;
		}
		else{
			return $list = [];
		}
	}

	public function get_graduate_list(){
		$this->load->model('graduates_model');
		$list = $this->graduates_model->get_all_graduates();
		if($list != NULL){
			return $list;
		}
		else{
			return $list = [];
		}
	}

	public function get_respondent_list(){
		$this->load->model('respondents_model');
		$list = $this->respondents_model->get_all_respondents();
		if($list != NULL){
			return $list;
		}
		else{
			return $list = [];
		}
	}
}