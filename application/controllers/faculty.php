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

	public function edit_faculty($uid = 0, $fid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['faculty_profile'] = $this->faculty_model->get_faculty_profile($fid);
		$data['experiments'] = $this->get_all_experiments($fid);
		$data['main_content'] = 'contents/profile';
		$this->load->view('_main_layout', $data);
	}

	public function request_lab($labid = 0){
		if($labid == 0 || is_null($labid)){
			redirect('');
			//implement where to redirect if labid is 0 or none
		}
		$this->load->model('laboratories_model');
		$fid = $this->session->userdata('active_id');
		$this->laboratories_model->request_faculty_lab($labid,$fid);
		redirect(''); //implement where to redirect after a faculty request for a lab
	}

	public function view($uid = 0, $fid = 0){
		$data['title'] = 'Faculty';
		$data['user'] = $this->users_model->get_user_profile($uid);
		$data['faculty'] = $this->faculty_model->get_faculty_profile($fid);
		$data['experiments'] = $this->get_all_experiments($fid);
		$data['main_content'] = 'faculty_view';
		$this->load->view('_main_layout', $data);
	}
	
	private function get_all_experiments($fid = 0){
		$this->load->model('experiments_model');
		$list = $this->experiments_model->get_all_faculty_experiments($fid);
		return $list;
	}
}