<?php

class Login extends CI_Controller{
	public function index(){
		$this->load->model('admins_model');
		$data['title'] = 'Login';
		$data['main_content'] = 'login_body';
		$this->load->view('_main_layout', $data);		
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
				if (in_array('Admin',$role)){
					redirect('admin');
				}
				elseif (in_array('Faculty',$role)){
					redirect('faculty');
				}
				elseif (in_array('Graduate',$role)){
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

	public function logout() {	
		$this->session->sess_destroy();
		redirect('');
	}

}