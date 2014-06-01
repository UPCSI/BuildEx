<?php

class Experiments extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiment_model', 'experiment');
	}

	/* REST Methods */
	public function create() {
		$info['title'] = $this->input->post('title');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');
		$eid = $this->experiment->create($info);

		$msg = 'You have successfully created an experiment!';
		$this->session->set_flashdata('notification', $success);
		redirect('builder/app/'.$eid);
    }

    public function delete_experiment($eid = 0){
		$success = NULL;
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

    public function view($role = NULL, $id = 0, $eid = 0){
    	//insert authorization here
    	$data['role'] = $role;
    	$data['id'] = $id;
		$data['experiment'] = $this->experiment->get($eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'view';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout', $data);
	}

	public function edit($role = NULL, $id = 0, $eid = 0){
		$data['role'] = $role;
    	$data['id'] = $id;
		$data['experiment'] = $this->experiment->get($eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'edit';
		$this->load->view('main_layout', $data);
	}

	public function update($role = NULL, $id = 0, $eid = 0){
		$info['title'] = $this->input->post('title');
		$info['category'] = $this->input->post('category');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');

		if($this->experiment->update($eid, $info)){
			$msg = 'Experiment updated!';
		}
		else{
			$msg = 'Failed to update!';
		}
	
		$role = $this->session->userdata('active_role');
		$this->session->set_flashdata('notification',$msg);
		redirect("{$role}/{$id}/experiment/{$eid}");
	}
	/* END of REST Methods */

	public function publish($role = NULL, $id = 0, $eid = 0){
		$info['is_published'] = 'True';
		if($this->experiment->update($eid, $info)){
			$msg = "You have successfully published the experiment.";
		}
		else{
			$msg = "Publication of experiment failed.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect("{$role}/{$id}/experiment/{$eid}");
	}

	public function unpublish($role = NULL, $id = 0, $eid = 0){
		$info['is_published'] = 'False';
		if($this->experiment->update($eid, $info)){
			$msg = "You have successfully unpublished the experiment.";
		}
		else{
			$msg = "Unpublication of experiment failed.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect("{$role}/{$id}/experiment/{$eid}");
	}

	public function respondents($eid = 0){
		$data['respondents'] = $this->respondents_model->get_respondents($eid);
		$data['notification'] = $this->session->flashdata('notification');
		
		if(!$data['notification']){
			$data['notification'] = NULL;
		}

		$data['title'] = 'Faculty';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'respondents';
		$this->load->view('main_layout', $data);
	}
}