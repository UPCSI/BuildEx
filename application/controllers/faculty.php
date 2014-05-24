<?php

class Faculty extends User_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('faculty_model','faculty');
		$this->role = 'faculty';
	}

	/* Faculty Pages */
	public function experiments(){
		$data['fid'] = $this->session->userdata('active_id');
		$data['experiments'] = $this->get_all_experiments($data['fid']);
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'experiments';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout',$data);
	}

	public function advisory(){
		$fid = $this->session->userdata('active_id');
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'advisory_experiments';
		$exp = $this->get_all_advisory_experiments($fid);
		
		if(isset($exp)){
			$data['experiments'] = $this->get_all_advised_experiments($exp);
			$data['requests'] = $this->get_all_request_experiments($exp);
		}
		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = NULL;
		}
		$this->load->view('main_layout',$data);
	}

	public function laboratory(){
		$fid = $this->session->userdata('active_id');
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'laboratory';
		$data['main_lab'] = $this->laboratories_model->get_faculty_laboratory($fid);
		if(isset($data['main_lab'])){
			$labid = $data['main_lab']->labid;
			$data['lab_head'] = $this->laboratoryheads_model->get_laboratory_head_of_lab($labid);
			$data['faculty_members'] = $this->faculty_model->get_all_lab_faculty($labid);
			$data['graduates'] = $this->graduates_model->get_all_lab_graduates($labid);
		}
		$data['laboratories'] = $this->laboratories_model->get_all_laboratories();
		$this->load->view('main_layout',$data);
	}

	public function laboratories(){
		$data['title'] = 'Faculty';
		$data['main_content'] = 'users/index';
		$data['page'] = 'laboratories';
		$data['laboratories'] = $this->laboratories_model->get_all_laboratories();
		$this->load->view("main_layout",$data);
	}
	/* End of Faculty Pages */

	public function view_experiment($eid = 0){
		if($eid == 0){
			redirect('');
		}
		
		$fid = $this->session->userdata('fid');
		$data['experiment'] = $this->experiments_model->get_faculty_experiment($fid,$eid);
		$data['title'] = 'Faculty';
		$data['main_content'] = 'faculty/view_experiment';

		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = NULL;
		}

		$this->load->view('main_layout', $data);
	}

	public function view($username = NULL){
		if(is_null($username)){
			redirect('');
			//implement where to redirect if username is non-existent
		}

		$data['user'] = $this->users_model->get_user_profile(0,$username);

		if(is_null($data['user'])){
			redirect('');
			//implement where to redirect if user is non-existent
		}

		$data['faculty'] = $this->faculty_model->get_faculty_profile(0,$username);
		$fid = $data['faculty']->fid;
		$data['experiments'] = $this->get_all_experiments($fid);
		$data['title'] = 'Faculty';
		$data['main_content'] = 'faculty/view';
		$this->load->view('main_layout', $data);
	}

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

	public function request_lab($labid = 0){
		if($labid == 0 || is_null($labid)){
			redirect('');
			//implement where to redirect if labid is 0 or none
		}
		$fid = $this->session->userdata('active_id');
		$status = $this->laboratories_model->request_faculty_lab($labid,$fid);
		if($status){
			$msg = "Request sent!";
		}
		else{
			$msg = "Error sending the request";
		}	
		$this->session->set_flashdata('notification',$msg);
		redirect(''); //implement where to redirect after a faculty request for a lab
	}

	public function edit_faculty($uid = 0, $fid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['faculty_profile'] = $this->faculty_model->get_faculty_profile($fid);
		$data['experiments'] = $this->get_all_experiments($fid);
		$data['main_content'] = 'contents/profile';
		$this->load->view('main_layout', $data);
	}

	/* REST Methods */
	public function create(){
		$this->load->library('form_validation');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$rules = $this->faculty->rules;
		print_var($rules);
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()){
			if($this->user_model->is_unique($username, $email)){
				$new_user = array(
					'first_name' => $this->input->post('fname'),
					'middle_name' => $this->input->post('mname'),
					'last_name' => $this->input->post('lname'),
					'email_ad' => $email,
					'username' => $username,
					'password' => $this->input->post('password')
				);	
				$faculty_info = array('faculty_num' => $this->input->post('faculty_num'));

				if($this->faculty->create($new_user, $faculty_info)){
					redirect('signup/success');	
				}
			}
			else{
				$msg = 'Username already taken.';
			}
		} 
		else{
			$msg = 'Invalid input. Please try again.';
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('signup/faculty');
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

	/* Private Methods */
	private function get_all_experiments($fid = 0){
		return $this->experiments_model->get_all_faculty_experiments($fid);
	}

	private function get_all_advisory_experiments($fid = 0){
		return $this->experiments_model->get_all_advisory_experiments($fid);
	}

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