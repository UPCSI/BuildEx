<?php

class Admin extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('admins_model');
	}
	
	public function index(){
		if(in_array('admin',$this->session->userdata('role'))){
			$data['title'] = 'Admin';
			$data['main_content'] = 'admin_index';
			$this->load->view('_main_layout', $data);
		}
		else{
			redirect($this->session->userdata('role')[0]);
		}
	}

	public function profile(){
		$username = $this->session->userdata('username');
		$data['user'] = $this->users_model->get_user_profile(0,$username);
		$data['roles'] = $this->session->userdata('role');
		$data['title'] = 'Admin';
		$data['main_content'] = 'admin_profile';
		$this->load->view('_main_layout',$data);
	}

	public function graduates(){
		$data['graduates'] = $this->get_graduate_list();
		$data['title'] = 'Admin';
		$data['main_content'] = 'admin_graduates';
		$this->load->view('_main_layout',$data);
	}

	public function faculty(){
		$data['faculty'] = $this->get_faculty_list();
		$data['requests'] = $this->get_faculty_account_requests();
		$data['title'] = 'Admin';
		$data['main_content'] = 'admin_faculty';
		$this->load->view('_main_layout',$data);
	}

	public function confirm_faculty($fid = 0){
		$data['title'] = 'Admin';
		$this->load->model('faculty_model');
		$faculty_info['account_status'] = 'true';
		$status = $this->faculty_model->update_faculty($fid,$faculty_info);
		if($status){
			$data['main_content'] = 'message_success';
		}
		else{
			$data['main_content'] = 'message_error';
		}

		$this->load->view('_main_layout',$data);
	}

	public function reject_faculty($fid = 0){
		$data['title'] = 'Admin';
		$this->load->model('faculty_model');
		$status = $this->faculty_model->delete_faculty($fid);
		if($status){
			$data['main_content'] = 'message_success';
		}
		else{
			$data['main_content'] = 'message_error';
		}
		$this->load->view('_main_layout',$data);
	}

	public function laboratories(){
		$data['laboratories'] = $this->get_laboratories_list();
		$data['title'] = 'Admin';
		$data['main_content'] = 'admin_laborat5ories';
		$this->load->view('_main_layout',$data);
	}

	public function edit_admin($uid = 0, $aid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['admin_profile'] = $this->admins_model->get_admin_profile($aid);
		$data['main_content'] = 'contents/profile';
		$data['experiments'] = -1;
		$this->load->view('_main_layout', $data);
	}

	public function add_lab(){
		$this->load->model('users_model');
		$this->load->model('faculty_model');
		$this->load->model('laboratories_model');
		$username = $this->input->post('lab_head');
		$data['title'] = 'Admin';
		$lab_head_user = $this->users_model->get_user_profile(0,$username);
		if (isset($lab_head_user)){
			$lab_head_info['uid'] = $lab_head_user->uid;
			$laboratory_info['name'] = $this->input->post('lab_name');
			$faculty = $this->faculty_model->get_faculty_profile(0,$username);
			$labid = $this->laboratories_model->add_laboratory($laboratory_info,$lab_head_info);
			echo $this->laboratories_model->request_faculty_lab($labid,$faculty->fid);
			echo $this->laboratories_model->accept_faculty($labid,$faculty->fid);
			$data['main_content'] = 'message_success';
		}
		else{
			$data['main_content'] = 'message_error';
		}
		//$this->load->view('_main_layout',$data);
	}

	private function get_admin_list(){
		$list = $this->admins_model->get_all_admins();
		return $list;
	}

	private function get_faculty_list(){
		$this->load->model('faculty_model');
		$list = $this->faculty_model->get_all_faculty();
		return $list;
	}


	private function get_faculty_account_requests(){
		$this->load->model('faculty_model');
		$list = $this->faculty_model->get_all_account_requests();
		return $list;
	}

	private function get_graduate_list(){
		$this->load->model('graduates_model');
		$list = $this->graduates_model->get_all_graduates();
		return $list;
	}

	private function get_respondent_list(){
		$this->load->model('respondents_model');
		$list = $this->respondents_model->get_all_respondents();
		return $list;
	}

	private function get_laboratories_list(){
		$this->load->model('laboratories_model');
		$list = $this->laboratories_model->get_all_laboratories();
		return $list;
	}
}