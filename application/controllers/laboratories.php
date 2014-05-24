<?php

class Laboratories extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('laboratory_model','laboratory');
	}

	/* REST Methods */
	public function view($labid = null){
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
		$faculty_username = $this->input->post('faculty');
		$laboratory_info['name'] = $this->input->post('laboratory');
		$laboratory_info['description'] = $this->input->post('description');

		if($this->laboratory->create($laboratory_info, $faculty_username)){
			$msg = 'You have successfully created a laboratory!';
		}
		else{
			$msg = 'Error creating laboratory!';
		}
		
		$this->session->set_flashdata('notification',$msg);
		redirect('admin/laboratories');
	}

	public function destroy(){
		$lab_id = $this->input->post('lab_id');
		if($this->laboratory->destroy($lab_id)){
			$msg = "Deletion successful!";
		}
		else{
			$msg = "Deletion failed!";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('admin/laboratories');
	}
}