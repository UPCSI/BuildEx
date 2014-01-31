<?php

class Labhead extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('laboratories_model');
	}
	
	public function index(){
		$fid = $this->session->userdata('fid');
		$lab = $this->laboratories_model->get_faculty_laboratory($fid);
		$data['lab_name'] = $lab->name;
		if($this->session->userdata('active_role') == 'labhead'){
			$data['title'] = 'Lab Head';
			$data['main_content'] = 'labhead/main';
			$this->load->view('_main_layout', $data);
		}

		else
			redirect($this->session->userdata('active_role'));
	}

	public function profile(){
		$fid = $this->session->userdata('fid');
		$lab = $this->laboratories_model->get_faculty_laboratory($fid);
		$data['lab_name'] = $lab->name;
		$username = $this->session->userdata('username');
		$data['user'] = $this->users_model->get_user_profile(0,$username);
		$data['roles'] = $this->session->userdata('role');
		$data['title'] = 'Lab Head';
		$data['main_content'] = 'labhead/profile';
		$this->load->view('_main_layout',$data);
	}

	public function laboratory(){
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
		$data['main_content'] = 'labhead/lab';
		$this->load->view('_main_layout',$data);
	}

	public function faculty_requests(){
		$labid = $this->session->userdata('labid');
		$data['requests'] = $this->laboratories_model->get_all_faculty_requests($labid);
		$data['title'] = 'Lab Head';
		$data['main_content'] = 'labhead/faculty_requests';
		$this->load->view('_main_layout',$data);
	}

	public function confirm_faculty($fid=0){
		$query = $this->laboratories_model->get_faculty_laboratory($fid);
		$labid = $query->labid;

		$status = $this->laboratories_model->accept_faculty($labid,$fid);
		if($status)
			$data['main_content'] = 'message_success';

		else
			$data['main_content'] = 'message_error';

		$data['title'] = 'Lab Head';
		$this->load->view('_main_layout',$data);
	}

	public function reject_faculty($fid=0){
		$query = $this->laboratories_model->get_faculty_laboratory($fid);
		$labid = $query->labid;

		$status = $this->laboratories_model->reject_faculty($labid,$fid);
		if($status)
			$data['main_content'] = 'message_success';

		else
			$data['main_content'] = 'message_error';

		$data['title'] = 'Lab Head';
		$this->load->view('_main_layout',$data);		
	}

	public function graduates_requests(){
		$labid = $this->session->userdata('labid');
		$data['requests'] = $this->laboratories_model->get_all_graduates_requests($labid);
		$data['title'] = 'Lab Head';
		$data['main_content'] = 'labhead/graduates_requests';
		$this->load->view('_main_layout',$data);
	}

	public function confirm_graduate($gid=0){
		$query = $this->laboratories_model->get_graduate_laboratory($gid);
		$labid = $query->labid;

		$status = $this->laboratories_model->accept_graduate($labid,$gid);
		if($status)
			$data['main_content'] = 'message_success';

		else
			$data['main_content'] = 'message_error';

		$data['title'] = 'Lab Head';
		$this->load->view('_main_layout',$data);
	}

	public function reject_graduate($gid=0){
		$query = $this->laboratories_model->get_graduate_laboratory($gid);
		$labid = $query->labid;

		$status = $this->laboratories_model->reject_graduate($labid,$gid);
		if($status)
			$data['main_content'] = 'message_success';

		else
			$data['main_content'] = 'message_error';

		$data['title'] = 'Lab Head';
		$this->load->view('_main_layout',$data);		
	}

}