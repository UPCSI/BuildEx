<?php

class Graduate extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('graduates_model');
	}
	
	public function index() {
		if($this->session->userdata('active_role') == 'graduate'){
			$data['title'] = 'Graduate';
			$data['main_content'] = 'graduate_index';
			$this->load->view('_main_layout', $data);
		}
		else{
			$role = $this->session->userdata('active_role');
			redirect($role[0]);
		}
	}

	public function redirect($role){
		$this->session->set_userdata(array('active_role' => $role));
		redirect($role);
	}

	public function profile(){
		$username = $this->session->userdata('username');
		$data['user'] = $this->users_model->get_user_profile(0,$username);
		$data['graduate'] = $this->graduates_model->get_graduate_profile($this->session->userdata('active_id'));
		$data['roles'] = $this->session->userdata('role');
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate_profile';
		$this->load->view('_main_layout',$data);
	}

	public function experiments(){
		$data['experiments'] = $this->get_all_experiments($this->session->userdata('active_id'));
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate_experiments';
		$this->load->view('_main_layout',$data);
	}

	public function laboratories(){
		$this->load->model('laboratories_model');
		$this->load->model('faculty_model');
		$gid = $this->session->userdata('active_id');
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate_laboratories';
		$data['main_lab'] = $this->laboratories_model->get_graduate_laboratory($gid);
		if(isset($data['main_lab'])){
			$labid = $data['main_lab']->labid;
			$data['faculty_members'] = $this->faculty_model->get_all_lab_faculty($labid);
			$data['graduates'] = $this->graduates_model->get_all_lab_graduates($labid);
		}
		$data['laboratories'] = $this->laboratories_model->get_all_laboratories();
		$this->load->view('_main_layout',$data);
	}

	public function edit_graduate($uid = 0, $gid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['graduate_profile'] = $this->graduates_model->get_graduate_profile($gid);
		$data['experiments'] = $this->get_all_experiments($gid);
		$data['main_content'] = 'contents/profile';
		$this->load->view('_main_layout', $data);
	}

	public function request_lab($labid = 0){
		if($labid == 0 || is_null($labid)){
			redirect('');
			//implement where to redirect if labid is 0 or none
		}
		$this->load->model('laboratories_model');
		$gid = $this->session->userdata('active_id');
		$this->laboratories_model->request_graduate_lab($labid,$gid);
		redirect(''); //implement where to redirect after a faculty request for a lab
	}

	public function view($uid = 0, $gid =0){
		$data['title'] = 'Graduate';
		$data['user'] = $this->users_model->get_user_profile($uid);
		if(is_null($data['user'])){
			redirect('');
			//implement where to redirect if user doesn't exist
		}
		$data['graduate'] = $this->graduates_model->get_graduate_profile($gid);
		$data['experiments'] = $this->get_all_experiments($gid);
		$data['main_content'] = 'graduate_view';
		$this->load->view('_main_layout', $data);
	}

	private function get_all_experiments($gid = 0){
		$this->load->model('experiments_model');
		$list = $this->experiments_model->get_all_graduates_experiments($gid);	
		return $list;
	}
}