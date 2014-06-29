<?php

class Faculty extends User_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('faculty_model', 'faculty');
		$this->role = 'faculty';
	}

	/* Faculty Pages */
	public function experiments(){
		$fid = role_id();
		$data['experiments'] = $this->faculty->get_experiments($fid);
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'experiments';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout',$data);
	}

	public function advisories(){
		$fid = role_id();
		$data['experiments'] = $this->faculty->get_advisory_experiments($fid, 't'); #confirmed
		$data['requests'] = $this->faculty->get_advisory_experiments($fid, 'f'); #not confirmed
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'advisory_experiments';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout',$data);
	}
	/* End of Faculty Pages */

	/* REST Methods */
	public function create(){
		$this->load->library('form_validation');
		$username = $this->input->post('username');
		$email = $this->input->post('email');

		if($this->user_model->is_unique($username, $email)){
			$new_user = array(
				'first_name' => $this->input->post('first_name'),
				'middle_name' => $this->input->post('middle_name'),
				'last_name' => $this->input->post('last_name'),
				'email_ad' => $email,
				'username' => $username,
				'password' => $this->input->post('password')
			);	
			$faculty_id = $this->input->post('faculty_num');

			if($this->faculty->create($new_user, $faculty_id)){
				redirect('signup/success');	
			}
		}
		else{
			$msg = 'Username already taken.';
		}
		
		$this->session->set_flashdata('notification',$msg);
		redirect('signup/faculty');
	}

	public function view($username = NULL){
        $data['faculty'] = $this->faculty->get(0, $username);
        if(isset($data['faculty'])){
        	$fid = $data['faculty']->fid;
	        $data['roles'] = array_keys($this->session->userdata('roles'));
	        $data['experiments'] = $this->faculty->get_experiments($fid);
	        $data['title'] = 'Faculty';
	        $data['main_content'] = 'faculty/index';
	        $data['page'] = 'view';
	        $data['notification'] = $this->session->flashdata('notification');
	        $this->load->view('main_layout',$data);
        }
        else{
        	show_404();
        }
    }

	public function destroy(){
		$faculty_id = $this->input->post('faculty_id');
		if($this->faculty->destroy($faculty_id, NULL)){
			$msg = "Deletion successful!";
		}
		else{
			$msg = "Deletion failed!";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('admin/faculty');
	}
	/* End of REST Methods */

	public function confirm_experiment($eid = 0){
		if($eid == 0){
			redirect(''); //redirect somewhere if $eid was not supplied
		}
		$info['is_published'] = "true";
		$fid = $this->session->userdata('active_id');
		if($this->experiments_model->advise_experiment($fid,$eid) && $this->experiments_model->update_experiment($eid,$info)){
			$msg = "You have successfully confirmed an experiment.";
		}
		else{
			$msg = "Confirming an experiment failed.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('faculty/advisory');
		//Warning: Update of experiment happened before assigning it to be advised by the faculty
	}

	public function reject_experiment($eid = 0){
		if($eid == 0){
			redirect(''); //redirect somewhere if $eid was not supplied
		}
		$fid = $this->session->userdata('active_id');
		if($this->experiments_model->reject_experiment($fid,$eid)){
			$msg = "You have successfully rejected an experiment.";
		}
		else{
			$msg = "Rejecting an experiment failed.";
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('faculty/advisory');
		//Warning: Update of experiment happened before assigning it to be advised by the faculty
	}

	public function edit_faculty($uid = 0, $fid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['faculty_profile'] = $this->faculty_model->get_faculty_profile($fid);
		$data['experiments'] = $this->get_all_experiments($fid);
		$data['main_content'] = 'contents/profile';
		$this->load->view('main_layout', $data);
	}

	/* Private Methods */
	private function get_all_request_experiments($list){
		$requests = array();
		foreach($list as $e){
			if($e->advise_status == 'f'){
				$requests[] = $e;
			}
		}
		if(empty($requests)){
			$requests = NULL;
		}
		return $requests;
	}

	private function get_all_advised_experiments($list){
		$advisory = array();
		foreach ($list as $e){
			if($e->advise_status == 't'){
				$advisory[] = $e;
			}
		}
		if(empty($advisory)){
			$advisory = NULL;
		}
		return $advisory;
	}
	/* End of Private Methods*/
}
