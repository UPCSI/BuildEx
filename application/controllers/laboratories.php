<?php

class Laboratories extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('laboratories_model');
		$this->load->model('faculty_model');
		$this->load->model('graduates_model');
	}

	public function view($labid = null){
		if(is_null($labid)){
			redirect('');
			//implement here where to redirect if $labid is not supplied
		}

		$data['title'] = 'Laboratories';
		$data['main_content'] = 'laboratory_view';
		$data['laboratory'] = $this->laboratories_model->get_laboratory($labid);
		if(is_null($data['laboratory'])){
			redirect('');
			//implement here where to redirect if $labid is an invalid laboratory
		}
		$data['faculty_members'] = $this->faculty_model->get_all_lab_faculty($labid);
		$data['graduates'] = $this->graduates_model->get_all_lab_graduates($labid);

		$this->load->view('_main_layout',$data);
	}
}