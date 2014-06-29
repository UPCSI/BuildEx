<?php

class Graduates extends User_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('graduate_model', 'graduate');
		$this->role = 'graduate';
	}

	/* Graduate Pages */
	public function experiments(){
		$gid = role_id();
		$data['experiments'] = $this->graduate->get_experiments($gid);
		$data['title'] = 'Graduate';
		$data['main_content'] = 'users/index';
		$data['page'] = 'experiments';
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout',$data);
	}
	/* End of Graduate Pages */

	/* Rest Methods */
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
			$student_id = $this->input->post('student_num');

			if($this->graduate->create($new_user, $student_id)){
				redirect('signup/success');	
			}
		}
		else{
			$msg = 'Username already taken.';
		}
		$this->session->set_flashdata('notification',$msg);
		redirect('signup/graduate');
	}

	public function view($username = NULL){
		$data['graduate'] = $this->graduate->get(0, $username);
		if(isset($data['graduate'])){
        	$gid = $data['graduate']->gid;
	        $data['roles'] = array_keys($this->session->userdata('roles'));
	        $data['experiments'] = $this->graduate->get_experiments($gid);
	        $data['title'] = 'Graduate';
	        $data['main_content'] = 'graduate/index';
	        $data['page'] = 'view';
	        $data['notification'] = $this->session->flashdata('notification');
	        $this->load->view('main_layout', $data);
        }
        else{
        	show_404();
        }
	}

	public function destroy(){
		$graduate_id = $this->input->post('graduate_id');
		if($this->graduate->destroy($graduate_id, NULL)){
			$msg = "Deletion successful!";
		}
		else{
			$msg = "Deletion failed!";
		}
		$this->session->set_flashdata('notification', $msg);
		redirect('admin/graduates');
	}
	/* End of REST Methods */

	private function get_all_experiments($gid = 0){
		$this->load->model('experiments_model');
		return $this->experiments_model->get_all_graduates_experiments($gid);	
	}
}