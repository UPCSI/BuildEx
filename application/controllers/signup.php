<?php 
class Signup extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = "Sign Up";
		$data['role'] = 'none';
		$this->load->view('templates/signup_template',$data);
	}

	public function student(){
		$data['title'] = "Sign Up";
		$data['role'] = 'student';
		$this->load->view('templates/signup_template',$data);
	}

	public function faculty(){
		$data['title'] = "Sign Up";
		$data['role']= 'faculty';
		$this->load->view('templates/signup_template',$data);
	}

	function add_faculty(){
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$email .= '*';

		$this->load->library('form_validation');
		$this->load->model('faculty_model');
		$rules = $this->faculty_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() && $this->faculty_model->is_unique($username, $email)) {
			$new_user = array(
				'first_name' => $this->input->post('fname'),
				'middle_name' => $this->input->post('mname'),
				'last_name' => $this->input->post('lname'),
				'email_ad' => $email,
				'username' => $username,
				'password' => $this->input->post('password')
			);	

			if($this->faculty_model->add_faculty($new_user)){
				$this->load->model('email_model');
				$this->email_model->send_confirmation_email($email);
				$data['title'] = 'Check your email!';
				$data['main_content'] = 'check_email';
				$this->load->view('_main_layout', $data);
			}
			else
				echo "Cannot create account.";
		}

		else
			echo "Invalid input.";
	}

	function add_student(){
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$email .= '*';

		$this->load->library('form_validation');
		$this->load->model('graduates_model');
		$rules = $this->graduates_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() && $this->graduates_model->is_unique($username, $email)) {
			$new_user = array(
				'first_name' => $this->input->post('fname'),
				'middle_name' => $this->input->post('mname'),
				'last_name' => $this->input->post('lname'),
				'email_ad' => $email,
				'username' => $username,
				'password' => $this->input->post('password')
			);	

			if(!$this->graduates_model->add_graduate($new_user)){
				$this->load->model('email_model');
				$this->email_model->send_confirmation_email($email);
				$data['title'] = 'Check your email!';
				$data['main_content'] = 'check_email';
				$this->load->view('_main_layout', $data);
			}
			
			else
				echo "Cannot create account.";
		}

		else
			echo "Invalid input.";
	}

	function confirm_email($email, $email_code){
		$this->load->model('email_model');
		$email_code = trim($email_code);
		if($this->email_model->validate_email($email, $email_code)) {
			$this->email_model->activate_user($email);
			$data['title'] = 'Signup successful!';
			$data['main_content'] = 'signup_successful';
		}

		else {
			$data['title'] = 'Invalid Email!';
			$data['main_content'] = 'invalid_email';
		}
		
		$this->load->view('_main_layout', $data);
	}

}