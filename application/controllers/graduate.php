<?php

class Graduate extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('graduates_model');
	}
	
	public function index() {
		if(in_array('graduate',$this->session->userdata('role'))){
			$data['title'] = 'Graduate';
			$data['main_content'] = 'graduate_index';
			$this->load->view('_main_layout', $data);
		}
		else{
			$role = $this->session->userdata('role');
			redirect($role[0]);
		}
	}

	public function profile(){
		$username = $this->session->userdata('username');
		$data['user'] = $this->users_model->get_user_profile(0,$username);
		$data['roles'] = $this->session->userdata('role');
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate_profile';
		$this->load->view('_main_layout',$data);
	}

	public function experiments(){
		$data['experiments'] = $this->get_all_experiments($this->session->userdata('gid'));
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate_experiments';
		$this->load->view('_main_layout',$data);
	}

	public function laboratories(){

	}

	public function edit_graduate($uid = 0, $gid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['graduate_profile'] = $this->graduates_model->get_graduate_profile($gid);
		$data['experiments'] = $this->get_all_experiments($gid);
		$data['main_content'] = 'contents/profile';
		$this->load->view('_main_layout', $data);
	}

	private function get_all_experiments($gid = 0){
		$this->load->model('experiments_model');
		$list = $this->experiments_model->get_all_graduates_experiments($gid);	
		return $list;
	}
}