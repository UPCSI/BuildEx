<?php

class Labhead extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('laboratories_model');
	}
	
	public function index(){
		$data['modules'] = array('home','profile','laboratory','confirm_faculty');
		$fid = $this->session->userdata('fid');
		$lab = $this->laboratories_model->get_faculty_laboratory($fid);
		$data['lab_name'] = $lab->name;
		if($this->session->userdata('active_role') == 'labhead'){
			$data['title'] = 'Lab Head';
			$data['main_content'] = 'labhead/index';
			$this->load->view('_main_layout_internal', $data);
		}
		else{
			redirect($this->session->userdata('active_role'));
		}
	}

	public function profile(){
		$data['modules'] = array('home','profile','laboratory');
		$fid = $this->session->userdata('fid');
		$lab = $this->laboratories_model->get_faculty_laboratory($fid);
		$data['lab_name'] = $lab->name;
		$username = $this->session->userdata('username');
		$data['user'] = $this->users_model->get_user_profile(0,$username);
		$data['roles'] = $this->session->userdata('role');
		$data['title'] = 'Lab Head';
		$data['main_content'] = 'labhead/profile';
		$this->load->view('_main_layout_internal',$data);
	}

	public function laboratory(){
		$data['modules'] = array('home','profile','laboratory');
		$this->load->model('faculty_model');
		$this->load->model('graduates_model');

		$fid = $this->session->userdata('fid');
		$lab = $this->laboratories_model->get_faculty_laboratory($fid);
		$labid = $lab->labid;
		$data['laboratory'] = $this->laboratories_model->get_laboratory($labid);
		$data['role'] = 'labhead';
		$data['lab_name'] = $lab->name;
		$data['faculty_members'] = $this->faculty_model->get_all_lab_faculty($labid);
		$data['graduates'] = $this->graduates_model->get_all_lab_graduates($labid);

		$data['title'] = 'Lab Head';
		$data['main_content'] = 'labhead/laboratory';
		$this->load->view('_main_layout_internal',$data);
	}

	public function laboratories(){
		$data['title'] = 'Faculty';
		$data['main_content'] = 'laboratory/all';
		$data['laboratories'] = $this->laboratories_model->get_all_laboratories();
		$this->load->view("_main_layout_internal",$data);
	}

	public function requests(){
		$lab = $this->laboratories_model->get_labhead_laboratory($this->session->userdata('lid'));
		$labid = $lab->labid;
		$data['fac_requests'] = $this->laboratories_model->get_all_faculty_requests($labid);
		$data['grad_requests'] = $this->laboratories_model->get_all_graduates_requests($labid);
		$data['title'] = 'Lab Head';
		$data['main_content'] = 'labhead/requests';

		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = null;
		}

		$this->load->view('_main_layout_internal',$data);
	}

	public function confirm_faculty($labid = 0,$fid=0){
		$query = $this->laboratories_model->get_faculty_laboratory($fid,$cond = "false");
		$labid = $query->labid;
		$status = $this->laboratories_model->accept_faculty($labid,$fid);
		if($status){
			$this->laboratories_model->increment_member_count($labid);
			$this->laboratories_model->delete_other_faculty_requests($fid);
			$msg = "You have successfully added a faculty member to your lab.";
		}
		else{
			$msg = "Error accepting faculty.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('labhead/requests');
	}

	public function reject_faculty($labid = 0,$fid=0){
		$query = $this->laboratories_model->get_faculty_laboratory($fid,$cond = "false");
		$labid = $query->labid;
		$status = $this->laboratories_model->reject_faculty($labid,$fid);
		if($status){
			$msg = "You have successfully rejected a faculty member from your lab.";
		}
		else{
			$msg = "Error rejecting a faculty member.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('labhead/requests');	
	}

	public function confirm_graduate($labid = 0,$gid=0){
		$status = $this->laboratories_model->accept_graduate($labid,$gid);
		if($status){
			$this->laboratories_model->increment_member_count($labid);
			$this->laboratories_model->delete_other_graduate_requests($gid);
			$msg = "You have successfully added a graduate student to your lab.";
		}
		else{
			$msg = "Error accepting a graduate student.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('labhead/requests');
	}

	public function reject_graduate($labid = 0,$gid=0){
		$query = $this->laboratories_model->get_graduate_laboratory($gid,$cond = "false");
		$labid = $query->labid;

		$status = $this->laboratories_model->reject_graduate($labid,$gid);
		if($status){
			$msg = "You have successfully rejected a graduate student from your lab.";
		}
		else{
			$msg = "Error rejecting a graduate student.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('labhead/requests');		
	}
}