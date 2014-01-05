<?php

class Experiment extends MY_Controller{
	
	public function index() {
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment_builder';
		$this->load->view('_main_layout', $data);
	}

	public function add_experiment(){
		//$this->load->library('form_validation');
		$this->load->model('experiments_model');

		$info['title'] = $this->input->post('title');
		$info['category'] = $this->input->post('category');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');
		$uid = $this->session->userdata('id');
		$this->experiments_model->add_experiment($uid,$info);

		redirect('graduate');
	}
}