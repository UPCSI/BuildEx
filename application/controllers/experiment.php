<?php

class Experiment extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiments_model');
	}

	public function add_experiment() {
		$info['title'] = $this->input->post('title');
		$info['category'] = $this->input->post('category');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');
		$info['privacy'] = $this->input->post('privacy');
		$role = $this->session->userdata('active_role');

		$id = $this->session->userdata('active_id');
		$eid  = 0;
		if ($role == 'faculty'){
			$eid = $this->experiments_model->add_faculty_experiment($id,$info);
		}
		else if ($role == 'graduate'){
			$eid = $this->experiments_model->add_graduates_experiment($id,$info);
		}

		$success = 'You have successfully created an experiment!';
		$this->session->set_flashdata('notification',$success);
		//redirect($role.'/experiments');
		redirect('builder/app/'.$eid);
		//echo $eid;
    }

	public function delete_experiment($eid = 0){
		$success = null;
		if($eid == 0){
			$success = 'Experiment does not exist!';
		}
		else{
			$role = $this->session->userdata('active_role');
			$id = $this->session->userdata('active_id');
			if($role == 'faculty'){
				$status = $this->experiments_model->delete_faculty_experiment($id,$eid);
			}
			else if ($role == 'graduate'){
				$status = $this->experiments_model->delete_graduates_experiment($id,$eid);
			}

			if($status){
				$success = 'You have successfully deleted an experiment!';
			}
			else{
				$success = 'Error in deleting experiment. Please try again later.';
			}
		}
		$this->session->set_flashdata('notification',$success);
		redirect($role.'/experiments');
	}

	/*
		Temporary Edit function
	*/
	public function edit_experiment($eid = 0){
		$data['experiment'] = $this->experiments_model->get_experiment($eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/edit_experiment_form';
		$this->load->view('_main_layout', $data);
	}

	public function update_experiment($eid = 0){
		if($eid == 0){
			$msg = 'Experiment does not exist!';
		}
		else{
			$info['title'] = $this->input->post('title');
			$info['category'] = $this->input->post('category');
			$info['description'] = $this->input->post('description');
			$info['target_count'] = $this->input->post('target_count');

			$status = $this->experiments_model->update_experiment($eid, $info);
			if($status){
				$msg = 'Experiment updated!';
			}
			else{
				$msg = 'Failed to update!';
			}
		}
		
		$role = $this->session->userdata('active_role');
		$this->session->set_flashdata('notification',$msg);
		redirect($role.'/experiments');
	}

	public function view($eid = 0){
		if($eid == 0){
			redirect('');
			//implement where to redirect if eid is non-existent
		}
		$data['experiment'] = $this->experiments_model->get_experiment($eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/view';
		$this->load->view('_main_layout_internal', $data);
	}
}