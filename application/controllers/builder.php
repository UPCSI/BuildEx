<?php

class Builder extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function form($eid = 0){
		
		$data['title'] = 'Experiment';
		$data['eid'] = $eid;
		$data['main_content'] = 'builder/form_maker';
		$this->load->view('_main_layout',$data);
	}

	public function app($eid = 0){
		/*this is the index of the app
		* for the reason that we need the eid
		* of the experiment for the app
		* and it's not trivial to pass a variable
		* from view to the controller index.
		*/

		//temp values
		//$data['var'] = array(array(400,200),array(56,78));

		$data['title'] = 'Experiment';
		$data['eid'] = $eid;
		$data['var'] = $this->get_positions($eid);

		$data['main_content'] = 'experiment/add_experiment_form';
		$this->load->view('_main_layout', $data);

	}

	public function save() {
		$message = $this->input->post('msg');
		$page['eid'] = $this->input->post('eid');
		$page['order'] = 1;
		$form['pid'] = $this->add_page($page);
		
		foreach ($message as $object){
			$form['x_pos'] = (double)$object[0];
			$form['y_pos'] = (double)$object[1];
			$group['qid'] = $this->add_form($form);
		//}

		// $data['main_content'] = 'experiment/test';
		// $this->load->view('_main_layout', $data);
	}


	public function get_positions($eid){
		$this->load->model('builder_model');
		return $this->builder_model->get_positions($eid);
	}

	public function add_page($data){
		/*
			Adds page. Returns pid. Required data listed below:
				eid = experiment id
				order = page number of current experiment

				Ignore template, row, and column for now.
		*/

		$this->load->model('builder_model');
		return $this->builder_model->add_page($data);
	}

	public function add_form($data){
		/* 
			Adds form/question. Returns qid. Required data listed below:
				pid = page id
				label = question itself (i.e. "Are you a psychopath?")
				is_required = boolean; must be 't' or 'f'
				x_pos = x position
				y_pos = y position
		*/

		$this->load->model('builder_model');
		return $this->builder_model->add_form($data);
	}

	public function add_option_group($data){
		/*
			Adds option_group. Returns ogid. Required data listed below:
				qid = question id
				type = integer; text box (0), radio button (1), multiple choice (2), dropdown (3)
				x_pos = x position
				y_pos = y position
		*/


		$this->load->model('builder_model');
		return $this->builder_model->add_option_group($data);
	}

	public function add_option($data){
		/*
			Adds option. Returns oid. Required data listed below:
				ogid = option group id
				label = option itself (i.e. yes, no, maybe)
		*/


		$this->load->model('builder_model');
		return $this->builder_model->add_option($data);
	}

	public function update_form($data){
		/*
			Updates form/question; does not change order of questions. Required data listed below:
				qid = id of form

			Optional data to be updated:
				label = change question
				is_required = boolean; must be 't' or 'f'
				x_pos = x postion
				y_pos = y postion
		*/

		$this->load->model('builder_model');
		$this->builder_model->update_form($data);
	}

	public function update_option($data){
		/*
			Updates individual options. Required data listed below:
				oid = id of option
				label = option itself
		*/


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