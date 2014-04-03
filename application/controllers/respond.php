<?php

class Respond extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiments_model');
		$this->load->model('builder_model');
	}

	public function view($hash){
		$exp = $this->experiments_model->get_experiment_by_hash($hash); //experiment with given url(hash)
		
		if (is_null($exp)){
			echo "Error 404: Page not found"; //handle this error
			return 0;
		}

		$data['title'] = 'Respond';
		$data['exp'] = $exp;
		$data['var'] = $this->get_objects($exp->eid);
		$data['main_content'] = 'builder/respondent/view';
		$this->load->view('builder/respondent/_view_layout', $data);
	}

	public function save(){
		$eid = $this->input_post('eid');
		/*
		save the answers here
		*/
		echo "Save success!";
	}

	public function pause(){
		$eid = $this->input_post('eid');
		/* not a priority */
	}

	private function get_objects($eid = 0){
		//returns all the objects for the experiment with eid = $eid
		return 0;
	}
}