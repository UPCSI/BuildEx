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
		$this->load->library('form_validation');
		$this->load->model('faculty_model');
		$rules = $this->faculty_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()) {
			$new_user = array(
				'first_name' => $this->input->post('fname'),
				'middle_name' => $this->input->post('mname'),
				'last_name' => $this->input->post('lname'),
				'email_ad' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			);	

			if($this->faculty_model->add_faculty($new_user))
				redirect('login');
			else
				echo "Cannot create account.";
		}

		else
			echo "Invalid input.";
	}

	function add_student(){
		$this->load->library('form_validation');
		$this->load->model('graduates_model');
		$rules = $this->graduates_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()) {
			$new_user = array(
				'first_name' => $this->input->post('fname'),
				'middle_name' => $this->input->post('mname'),
				'last_name' => $this->input->post('lname'),
				'email_ad' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			);	

			if($this->graduates_model->add_graduate($new_user))
				redirect('login');
			else
				echo "Cannot create account.";
		}

		else
			echo "Invalid input.";
	}

}