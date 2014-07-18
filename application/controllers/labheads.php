<?php

class LabHeads extends User_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('laboratory_head_model', 'laboratory_head');
		$this->load->model('laboratory_model', 'laboratory');
		$this->role = 'labhead';
	}
	
	/* Lab Head Pages */
	public function home(){
		$lid = role_id();
		$laboratory = $this->laboratory_head->get_laboratory($lid);
		$data['laboratory'] = $laboratory;
		$data['experiments'] = $this->laboratory->get_experiments($laboratory->labid);
		$data['title'] = 'LabHead';
    $data['main_content'] = 'users/index';
    $data['page'] = 'home';
    $this->load->view('main_layout', $data);
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
			$data['notification'] = NULL;
		}

		$this->load->view('_main_layout_internal',$data);
	}
	/* End of Lab Head Pages */

	/* REST Methods */
	public function view($username = 0){
		$data['laboratory_head'] = $this->laboratory_head->get(0, $username);
    
    if(isset($data['laboratory_head'])){
    	$lid = $data['laboratory_head']->lid;
    	$uid = $data['laboratory_head']->uid;
      $data['roles'] = array_keys($this->user_model->get_roles($uid));
      $data['title'] = 'LabHead';
      $data['main_content'] = 'labhead/index';
      $data['page'] = 'view';
      $data['notification'] = $this->session->flashdata('notification');
      $this->load->view('main_layout',$data);
    }
    else{
    	show_404();
    }
	}
	/* End of REST Methods */

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