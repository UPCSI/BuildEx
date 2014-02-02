<?php

class Graduate extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('graduates_model');
	}
	
	public function index() {
		if(in_array('graduate',$this->session->userdata('role'))){
			$data['title'] = 'Graduate';
			$data['main_content'] = 'graduate/index';
			$this->load->view('_main_layout', $data);
		}
		else{
			$role = $this->session->userdata('active_role');
			redirect($role[0]);
		}
	}

	public function profile(){
		$username = $this->session->userdata('username');
		$data['user'] = $this->users_model->get_user_profile(0,$username);
		$data['graduate'] = $this->graduates_model->get_graduate_profile($this->session->userdata('active_id'));
		$data['roles'] = $this->session->userdata('role');
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate/profile';
		$this->load->view('_main_layout',$data);
	}

	public function experiments(){
		$data['gid'] = $this->session->userdata('active_id');
		$data['experiments'] = $this->get_all_experiments($data['gid']);
		$data['title'] = 'Graduate';
		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = null;
		}
		$data['main_content'] = 'graduate/experiments';
		$this->load->view('_main_layout',$data);
	}

	public function laboratories(){
		$this->load->model('laboratories_model');
		$this->load->model('faculty_model');
		$gid = $this->session->userdata('active_id');
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate/laboratories';
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

	public function view($username = null){
		if(is_null($username)){
			redirect('');
			//implement where to redirect if username is non-existent
		}

		$data['user'] = $this->users_model->get_user_profile(0,$username);

		if(is_null($data['user'])){
			redirect('');
			//implement where to redirect if user doesn't exist
		}
		$data['graduate'] = $this->graduates_model->get_graduate_profile(0,$username);
		$gid = $data['graduate']->gid;
		$data['title'] = 'Graduate';
		$data['experiments'] = $this->get_all_experiments($gid);
		$data['main_content'] = 'graduate/view';
		$this->load->view('_main_layout', $data);
	}

	public function view_experiment($gid = 0, $eid = 0){
		if($eid == 0 || $gid == 0){
			redirect('');
			//implement where to redirect if eid or gid is non-existent
		}

		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = null;
		}

		$this->load->model('experiments_model');
		$data['experiment'] = $this->experiments_model->get_graduates_experiment($gid,$eid);
		$data['title'] = 'Graduate';
		$data['main_content'] = 'graduate/view_experiment';
		$this->load->view('_main_layout', $data);
	}

	public function request_advise($eid = 0){
		if($eid == 0){
			redirect('');
			//implement where to redirect if eid is non-existent
		}
		$this->load->model('faculty_model');
		$gid = $this->session->userdata('active_id');
		$faculty_uname = $this->input->post('faculty_uname');
		$faculty = $this->faculty_model->get_faculty_profile(0,$faculty_uname);
		if(isset($faculty)){
			$status = $this->faculty_model->request_advise($faculty->fid,$eid);
			if($status){
				$msg = 'Request sent!';
			}
			else{
				$msg = 'Failed to request advise. Please try again later.';
			}
		}
		else{
			$msg = 'Faculty member does not exists.';
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('graduate/view_experiment/'.$gid.'/'.$eid); //implement where to redirect after sending a request for advise
	}

	private function get_all_experiments($gid = 0){
		$this->load->model('experiments_model');
		return $this->experiments_model->get_all_graduates_experiments($gid);	
	}
}