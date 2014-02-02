<?php

class Experiment extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiments_model');
	}

	public function index() {
		$info['title'] = $this->input->post('title');
		$info['category'] = $this->input->post('category');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');
		$info['privacy'] = $this->input->post('privacy');
		$role = $this->session->userdata('active_role');
		$id = $this->session->userdata('active_id');
		if ($role == 'faculty'){
			$this->experiments_model->add_faculty_experiment($id,$info);
		}
		elseif ($role == 'graduate'){
			$this->experiments_model->add_graduates_experiment($id,$info);
		}

		$role = $this->session->userdata('role')[0];
		// redirect($role);
		$this->add_experiment();
		// $success = 'You have successfully created an experiment!';
		// $this->session->set_flashdata('notification',$success);
		// redirect($role.'/experiments');

	}

	public function add_experiment() {
		$data['title'] = 'Experiment';
 		$data['main_content'] = 'experiment/add_experiment_form';
 		$this->load->view('_main_layout', $data);
    }

	public function update_experiment($eid = NULL){
		#setsession(eid)
		$this->session->set_userdata(array('eid' => $eid));
		#endsession
		
		$data['experiment'] = $this->experiments_model->get_experiment($eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/update_experiment_form';
		$this->load->view('_main_layout', $data);
	}

	public function insert_update(){
		$info['title'] = $this->input->post('title');
		$info['category'] = $this->input->post('category');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');

		$eid = $this->session->userdata('eid');
		#unsetsession(eid)
		$this->session->unset_userdata('eid');
		#endsession

		$this->experiments_model->update_experiment($eid, $info);

		$role = $this->session->userdata('role')[0];
		redirect($role);
	}

	public function view($eid = 0){
		if($eid == 0){
			redirect('');
			//implement where to redirect if eid is non-existent
		}
		$data['experiment'] = $this->experiments_model->get_experiment($eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment_view';
		$this->load->view('_main_layout', $data);
	}
}