<?php

class Login extends CI_Controller{
	public function index(){
		$this->load->model('admins_model');
		$data['title'] = 'Login';
		$data['main_content'] = 'login_body';
		$this->load->view('_main_layout', $data);	

		#Redirect to profile if logged in
		$role = $this->session->userdata('role');
		$this->loggedin() == False || redirect($role[0]);
	}

	public function validate_user(){
		$this->load->library('form_validation');
		$this->load->model('users_model');
		$rules = $this->users_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->users_model->is_valid_user($username, $password)){
				$this->users_model->set_session_data($username);
				$role = $this->session->userdata('role');
				if (in_array('admin',$role)){
					redirect('admin');
				}
				elseif (in_array('faculty',$role)){
					redirect('faculty');
				}
				elseif (in_array('graduate',$role)){
					redirect('graduate');
				}
				else{ 
					redirect('site');
				}
			}

			else
				echo "Cannot sign in.";
		}

		else
			echo "Invalid input.";
	}

	public function loggedin(){
		return (bool) $this->session->userdata('loggedin');
	}

	public function logout() {	
		$this->session->sess_destroy();
		redirect('');
	}

	public function reset(){
		$data['title'] = 'Reset Password';
		$data['main_content'] = 'reset_body';
		$this->load->view('_main_layout', $data);			
	}

	function reset_password() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
		if($this->form_validation->run() == TRUE) {
			$this->load->model('email_model');
			$email = $this->input->post('email');
			$data = $this->email_model->edit_password($email);

			if($data['reset']) {
				$data['title'] = 'Password Reset!';
				$data['main_content'] = 'reset_successful';
				$this->load->view('_main_layout', $data);			
			}
		}

		else echo "Invalid input.";
	}
}