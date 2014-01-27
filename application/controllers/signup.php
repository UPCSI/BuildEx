<?php 
class Signup extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('users_model');
	}

	public function graduate(){
		$data['title'] = "Sign Up - Graduate";
		$data['main_content'] = 'guest/signup_graduate';
		$this->load->view('_main_layout',$data);
	}

	public function faculty(){
		$data['title'] = "Sign Up - Faculty";
		$data['main_content'] = 'guest/signup_faculty';
		$this->load->view('_main_layout',$data);
	}

	function add_faculty(){
		$username = $this->input->post('username');
		$email = $this->input->post('email');

		$this->load->library('form_validation');
		$this->load->model('faculty_model');
		$rules = $this->faculty_model->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() && $this->users_model->is_unique($username, $email)) {
			$zemail .= '*';
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
				echo "To confirm your account, follow the link we've sent to your e-mail address.";
			}

			else
				echo "A problem was encountered while creating your account. Please try again.";
		}

		else
			echo "Invalid input.";
	}

	function add_graduate(){
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

			if($this->graduates_model->add_graduate($new_user)) {
				$this->load->model('email_model');
				$this->email_model->send_confirmation_email($email);
				echo "To confirm your account, follow the link we've sent to your e-mail address.";
			}

			else
				echo "A problem was encountered while creating your account. Please try again.";
		}

		else
			echo "Invalid input.";
	}

	function confirm_email($email, $email_code){
		$this->load->model('email_model');
		$email_code = trim($email_code);
		if($this->email_model->validate_email($email, $email_code)) {
			$this->email_model->activate_user($email);
			echo "You have successfully confirmed your e-mail address!";
		}

		else
			echo "A problem was encountered while validating your e-mail address. Please try again.";
	}

}