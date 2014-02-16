<?php

class Laboratories extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('laboratories_model');
		$this->load->model('laboratoryheads_model');
		$this->load->model('faculty_model');
		$this->load->model('graduates_model');
	}

	public function view($labid = null){
		if(is_null($labid)){
			redirect(''); 
			//implement here where to redirect if $labid is not supplied
		}

		$role = $this->session->userdata('active_role');
		$role_id = $this->session->userdata('active_id');

		$data['is_member'] = null;
		if($role == 'graduate'){
			$data['is_member'] = $this->laboratories_model->is_graduate_member($role_id,$labid);
		}
		else if($role == 'faculty'){
			$data['is_member'] = $this->laboratories_model->is_faculty_member($role_id,$labid);
		}

		$data['title'] = 'Laboratories';
		$data['main_content'] = 'laboratory_view';
		$data['laboratory'] = $this->laboratories_model->get_laboratory($labid);
		$data['lab_head'] = $this->laboratoryheads_model->get_laboratory_head_of_lab($labid);
		$data['role'] = $this->session->userdata('role')[0]; //this should be changes to active_role

		if(is_null($data['laboratory'])){
			redirect('');
			//implement here where to redirect if $labid is an invalid laboratory
		}
		$data['faculty_members'] = $this->faculty_model->get_all_lab_faculty($labid);
		$data['graduates'] = $this->graduates_model->get_all_lab_graduates($labid);
		$this->load->view('_main_layout',$data);
	}
}