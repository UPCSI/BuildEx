<?php

class Experiments extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiment_model', 'experiment');
	}

	/* REST Methods */
	public function index($role = NULL, $id = 0){
		$data['role'] = $role;
		$data['id'] = $id;
		$data['experiments'] = $this->faculty->get_experiments($fid);
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'experiments';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout',$data);
	}

	public function add($role = NULL, $id = 0) {
		$data['role'] = $role;
		$data['id'] = $id;
		$data['experiment'] = NULL;
		$data['action'] = 'create';
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'new';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout', $data);
	}

	public function create($role = NULL, $id = 0) {
		$info['title'] = $this->input->post('title');
		$info['description'] = $this->input->post('description');
		$info['target_count'] = $this->input->post('target_count');
		$eid = $this->experiment->create($info);
		$msg = 'You have successfully created an experiment!';
		$this->session->set_flashdata('notification', $msg);
		redirect('builder/app/'.$eid);
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

	public function view($role = NULL, $id = 0, $eid = 0){
		$data['experiment'] = $this->experiment->get($role, $id, $eid);

		if($role = 'graduate'){
			$data['requested_advisers'] = $this->experiment->get_requested_advisers($eid);
			$data['adviser'] = $this->experiment->get_adviser($eid);
		}

		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'view';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout', $data);
	}

	public function edit($role = NULL, $id = 0, $eid = 0){
		$data['experiment'] = $this->experiment->get($role, $id, $eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'experiment/index';
		$data['page'] = 'edit';
		$this->load->view('main_layout', $data);
	}

	public function update($role = NULL, $id = 0){
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

	public function request_adviser($role = NULL, $id = 0, $eid = 0){
		$this->load->model('faculty_model', 'faculty');

		$faculty_username = $this->input->post('faculty_uname');
		$faculty = $this->faculty->get(0, $faculty_username);

		if(isset($faculty)){
			if($this->experiment->assign_adviser($eid, $faculty->fid)){
				$msg = 'Request sent! Please wait for a faculty member to approve your request.';
			}
			else{
				$msg = 'Failed to request advise. Please try again later.';
			}
		}
		else{
			$msg = 'Faculty member does not exists.';
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