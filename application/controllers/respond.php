<?php

class Respond extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiments_model');
		$this->load->model('builder_model');
	}

	public function view($hash){
		$exp = $this->experiments_model->get_experiment_by_hash($hash); //experiment with given url(hash)
		$eid = $exp->eid; //eid of experiment exp
		var_dump($exp);
		/*
		* Do slide show here.  
		*/
	}
}