<?php

class Laboratories extends MY_Controller{

	public function __construct(){
		parent::__construct();

	}

	public function view($labid = null){
		if(is_null($labid)){
			redirect(''); 
		}

		$role = $this->session->userdata('active_role');
		$role_id = $this->session->userdata('active_id');

		$data['is_member'] = null;
		if($role == 'graduate'){
			$data['is_member'] = $this->laboratories_model->is_graduate_member($role_id);
		}
		else if($role == 'faculty'){
			$data['is_member'] = $this->laboratories_model->is_faculty_member($role_id);
		}

		$data['laboratory'] = $this->laboratories_model->get_laboratory($labid);
		$data['lab_head'] = $this->laboratory_head_model->get_laboratory_head_of_lab($labid);
		$data['role'] = $this->session->userdata('active_role');

		if(is_null($data['laboratory'])){
			redirect('');
			//implement here where to redirect if $labid is an invalid laboratory
		}
		$data['faculty_members'] = $this->faculty->get_all_lab_faculty($labid);
		$data['graduates'] = $this->graduates_model->get_all_lab_graduates($labid);

		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = null;
		}
		
		$data['title'] = 'Laboratories';
		$data['main_content'] = 'laboratory/index';
		$data['page'] = 'view';
		$this->load->view('main_layout',$data);
	}

	public function create(){
		$this->load->model('laboratory_model','laboratory');
		$this->load->model('laboratory_head_model','laboratory_head');
		$this->load->model('faculty_model','faculty');

		$username = $this->input->post('lab_head');
		$lab_head_user = $this->user_model->get_user_profile(0,$username);
		if (isset($lab_head_user)){
			$lab_head_info['uid'] = $lab_head_user->uid;
			$laboratory_info['name'] = $this->input->post('lab_name');
			$laboratory_info['description'] = $this->input->post('description');
			$faculty = $this->faculty->get_faculty_profile(0,$username);
			if($faculty->account_status == 't'){
				$labid = $this->laboratory->add_laboratory($laboratory_info,$lab_head_info);
				$this->laboratory->request_faculty_lab($labid,$faculty->fid);
				$this->laboratory->accept_faculty($labid,$faculty->fid);
				$this->laboratory->increment_member_count($labid);
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
}