<?php 
class Signup extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('users_model');
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
		$this->load->model('faculty_model');
		$this->load->library('form_validation');

		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$rules = $this->faculty_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() && $this->users_model->is_unique($username, $email)) {
			$email .= '*';
			$new_user = array(
				'first_name' => $this->input->post('fname'),
				'middle_name' => $this->input->post('mname'),
				'last_name' => $this->input->post('lname'),
				'email_ad' => $email,
				'username' => $username,
				'password' => $this->input->post('password')
			);
			$uid = $this->users_model->add_user($new_user);
			$faculty_info['faculty_num'] = $this->input->post('faculty_num');
			$fid = $this->faculty_model->add_faculty($uid,$faculty_info);
			/*Commented email function for development purposes*/
			//$this->load->model('email_model');
			//$this->email_model->send_confirmation_email($email);
			echo "Check your email!";
		}
		else{
			echo "Invalid input.";
		}
	}

	function add_student(){
		$username = $this->input->post('username');
		$email = $this->input->post('email');

		$this->load->library('form_validation');
		$this->load->model('graduates_model');
		$rules = $this->graduates_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() && $this->users_model->is_unique($username, $email)) {
			$email .= '*';
			$new_user = array(
				'first_name' => $this->input->post('fname'),
				'middle_name' => $this->input->post('mname'),
				'last_name' => $this->input->post('lname'),
				'email_ad' => $email,
				'username' => $username,
				'password' => $this->input->post('password')
			);

			$uid = $this->users_model->add_user($new_user);
			$graduate_info['student_num'] = $this->input->post('student_num');
			$gid = $this->graduates_model->add_graduate($uid,$graduate_info);
			/*Commented email function for development purposes*/
			//$this->load->model('email_model');
			//$this->email_model->send_confirmation_email($email);
			echo "Check your email!";
		}

		else
			echo "Invalid input.";
	}

	function confirm_email($email, $email_code){
		$this->load->model('email_model');
		$email_code = trim($email_code);
		if($this->email_model->validate_email($email, $email_code)) {
			$this->email_model->activate_user($email);
			echo "You have successfully confirmed your email!";
		}

		else
			echo "We can't validate your email. Please try again.";
	}

}