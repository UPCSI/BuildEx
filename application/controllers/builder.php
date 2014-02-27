<?php

class Builder extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		//temp values
		//$data['var'] = array(array(400,200),array(56,78));

		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/add_experiment_form';
		$this->load->view('_main_layout', $data);
	}

	public function save() {
		$message = $this->input->post('msg');
		echo $message;
		// $data['main_content'] = 'experiment/test';
		// $this->load->view('_main_layout', $data);
	}

	public function app($eid = 0){
		// echo 'I am your builder.';
		echo $this->update_option();
	}

	public function add_page(){
		/*
			Adds page. Returns pid. Required data listed below:
				eid = experiment id
				order = page number of current experiment
				template = integer; form maker (1), text (2), comparison stimulus(3)

			Additional data needed for grid (applies only if template is text or images):
				row
				column
		*/

		// $data['eid'] = ;
		// $data['order'] = ;
		// $data['template'] = ;

		if ($data['template'] > 1) {
			// $data['row'] = 1;
			// $data['column'] = 1;
		}

		$this->load->model('builder_model');
		return $this->builder_model->add_page($data);
	}

	public function add_form(){
		/* 
			Adds form/question. Returns qid. Required data listed below:
				pid = page id
				label = question itself (i.e. "Are you a psychopath?")
				type = integer; text box (0), radio button (1), multiple choice (2), dropdown (3)
				is_required = boolean; must be 't' or 'f'
		*/

		// $data['pid'] = ;
		// $data['label'] = ;
		// $data['type'] = ;
		// $data['is_required'] = ;

		$this->load->model('builder_model');
		return $this->builder_model->add_form($data);
	}

	public function add_option(){
		/*
			Adds option. Applies only if form_type > 0 (builder_model checks this). Returns oid.
			Required data listed below:
				qid = id of form
				label = option itself (i.e. yes, no, maybe)

		*/

		// $data['qid'] = ;
		// $data['label'] = ;

		$this->load->model('builder_model');
		return $this->builder_model->add_option($data);
	}

	public function update_form(){
		/*
			Updates form/question; does not change order of questions. Required data listed below:
				qid = id of form

			Optional data to be updated:
				label = change question
				is_required = boolean; must be 't' or 'f'
		*/

		// $data['qid'] = ;

		// $data['label'] = ;
		// $data['is_required'] = ;

		$this->load->model('builder_model');
		$this->builder_model->update_form($data);
	}

	public function update_option(){
		/*
			Updates individual options. Required data listed below:
				oid = id of option
				label = option itself
		*/

		// $data['oid'] = ;
		// $data['label'] = ;

		$this->load->model('builder_model');
		$this->builder_model->update_option($data);
	}

	public function delete_page(){
		/*
			NOT YET DONE. DO NOT EDIT.

			Deletes page along with associated form and options. Changes numbering accordingly.
			Required data listed below:
				eid = id of current experiment
				pid = id of page
		*/

		// $data['eid'] = ;
		// $data['pid'] = ;
		$this->load->model('builder_model');
		$this->builder_model->delete_page($data);
	}

	public function insert_page(){
		/*
			NOT YET DONE. DO NOT EDIT.

			Inserts page in between and changes numbering accordingly. Required data listed below:
				pid = id of page
		*/

		// $data['pid'] = ;
		$this->load->model('builder_model');
		$this->builder_model->insert_page($data);
	}



}