<?php

class Experiment_builder extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function app($eid = 0){
		echo 'I am your builder.';
	}
}