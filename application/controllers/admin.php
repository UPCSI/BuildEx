<?php

class Admin extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('admins_model');
	}
	
	public function index(){
		if(in_array('admin',$this->session->userdata('role'))){
			$data['title'] = 'Admin';
			$data['main_content'] = 'users/index';
			$data['page'] = 'index';
			$this->load->view('main_layout',$data);
		}
		else{
			redirect($this->session->userdata('active_role'));
		}
	}

	public function profile(){
		$username = $this->session->userdata('username');
		$data['user'] = $this->users_model->get_user_profile(0,$username);
		$data['roles'] = $this->session->userdata('role');
		$data['title'] = 'Admin';
		$data['main_content'] = 'users/index';
		$data['page'] = 'profile';
		$this->load->view('main_layout',$data);
	}

	public function laboratories(){
		$data['laboratories'] = $this->get_laboratories_list();
		$data['title'] = 'Admin';
		$data['main_content'] = 'users/index';
		$data['page'] = "laboratories";
		
		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = null;
		}

		$this->load->view('main_layout',$data);
	}

	public function faculty(){
		$data['faculty'] = $this->get_faculty_list();
		$data['requests'] = $this->get_faculty_account_requests();
		$data['title'] = 'Admin';
		$data['main_content'] = 'users/index';
		$data['page'] = 'faculty';

		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = null;
		}
		
		
		$this->load->view('main_layout',$data);
	}

	public function graduates(){
		$data['graduates'] = $this->get_graduate_list();
		$data['title'] = 'Admin';
		$data['main_content'] = 'users/index';
		$data['page'] = 'graduates';
		$this->load->view('main_layout',$data);
	}

	public function confirm_faculty($fid = 0){
		$data['title'] = 'Admin';
		$this->load->model('faculty_model');
		$faculty_info['account_status'] = 'true';
		$status = $this->faculty_model->update_faculty($fid,$faculty_info);
		if($status){
			$msg = 'Confirmation successful!';
		}
		else{
			$msg = 'Confirmation failed!';
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('admin/faculty');
	}

	public function reject_faculty($fid = 0){
		$data['title'] = 'Admin';
		$this->load->model('faculty_model');
		$status = $this->faculty_model->delete_faculty($fid);
		if($status){
			$msg = 'Rejection complete!';
		}
		else{
			$msg = 'Rejection failed!';
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('admin/faculty');
	}

	public function edit_admin($uid = 0, $aid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['admin_profile'] = $this->admins_model->get_admin_profile($aid);
		$data['main_content'] = 'users/indexofile';
		$data['experiments'] = -1;
		$this->load->view('main_layout', $data);
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
			$laboratory_info['description'] = $this->input->post('description');
			$faculty = $this->faculty_model->get_faculty_profile(0,$username);
			if($faculty->account_status == 't'){
				$labid = $this->laboratories_model->add_laboratory($laboratory_info,$lab_head_info);
				$this->laboratories_model->request_faculty_lab($labid,$faculty->fid);
				$this->laboratories_model->accept_faculty($labid,$faculty->fid);
				$this->laboratories_model->increment_member_count($labid);
				$msg = 'You have successfully created a laboratory!';				
			}
			else{
				$msg = 'You have selected a non-faculty member.';
			}
		}
		else{
			$msg = 'Error creating laboratory!';
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('admin/laboratories');
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
		return $this->laboratories_model->get_all_laboratories();
	}
}