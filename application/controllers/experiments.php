<?php

class Experiments extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiment_model', 'experiment');
	}

	/* REST Methods */
	public function index($role = NULL, $username = NULL){
		$data['role'] = $role;
		$data['username'] = $username;
		$data['experiments'] = $this->faculty->get_experiments($fid);
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'experiments';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout',$data);
	}

	public function add($role = NULL, $username = NULL) {
    $researcher_info = $this->user_model->get_researcher($role, $username);
		$data['researcher'] = $researcher_info[0];
		$data['experiment'] = NULL;
		$data['action'] = 'create';
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'new';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout', $data);
	}

	public function create($role = NULL, $username = NULL) {
		$info['title'] = $this->input->post('title');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');
		$eid = $this->experiment->create($info);
		$msg = 'You have successfully created an experiment!';
		$this->session->set_flashdata('notification', $msg);
		redirect("{$role}/{$username}/experiment/{$eid}/builder");
	}

	public function destroy($role = NULL, $id = 0){
		$eid = $this->input->post('experiment_id');
		if($this->experiment->destroy($eid)){
			$msg = 'You have successfully deleted an experiment!';
		}
		else{
			$msg = 'Error in deleting experiment.';
		}
		$this->session->set_flashdata('notification',$msg);
		redirect("{$role}/{$id}/experiments");
	}

	public function view($role = NULL, $username = NULL, $eid = 0){
		$researcher_info = $this->user_model->get_researcher($role, $username);
		$data['researcher'] = $researcher_info[0];
		$data['experiment'] = $this->experiment->get($role, $researcher_info[1], $eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'view';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout', $data);
	}

	public function edit($role = NULL, $username = NULL, $eid = 0){
		$researcher_info = $this->user_model->get_researcher($role, $username);
		$data['researcher'] = $researcher_info[0];		
		$data['experiment'] = $this->experiment->get($role, $researcher_info[1], $eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'edit';
		$this->load->view('main_layout', $data);
	}

	public function update($role = NULL, $username = NULL){
		$eid = $this->input->post('experiment_id');
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
		redirect("{$role}/{$username}/experiment/{$eid}");
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
		$data['respondents'] = $this->respondent_model->get_respondents($eid);
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