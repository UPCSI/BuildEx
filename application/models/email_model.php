<?php

class Email_model extends MY_Model{

	public function send_confirmation_email($email){
		$email = substr($email, 0, -1);
		$email_code = md5((string)$email);
		$url = "" .base_url() .'signup/confirm_email/' .$email ."/" .$email_code;

		//send email
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype('html');
		$this->email->clear();

		$this->email->from($this->config->item('email_bot'), $this->config->item('email_name'));
		$this->email->to($email);	
		$this->email->subject('Email Confirmation');

		$message = '<!DOCTYPE html><html><head></head><body>';
		$message .= '<p>Thank you for registering to BuildEx! ';
		$message .= 'To complete the signup process, please click ';
		$message .= '<strong><a href = "' .$url .'">here</a></strong>';
		$message .= ' to create your account.</p>';
		$message .= '<br/><p><small>If this is not you, please ignore this email.</small></p>';
		$message .= '</body></html>';

		$this->email->message($message);
		if(!$this->email->send())
			echo $this->email->print_debugger();	
	}

	public function validate_email($email, $email_code) {
		if(md5((string)$email) === $email_code)
			return true;
		return false;
	}

	public function activate_user($email){
		$data['email_ad'] = $email;
		$email .= '*';
		$this->db->where('email_ad', $email);
		$this->db->update('Users', $data);
	}

	public function edit_password($email){
		$user = false;

		//check if email exists in database
		$this->db->where('email_ad', $email);
		$query = $this->db->get('Users');

		if($query->num_rows == 1)
			$user = $query->row();

		//if user exists
		if($user != false){
			$data = array(
				'newPassword' => $this->randomizePassword(),
				'reset' => true
			);

			$hashed_pass = $this->my_hash($data['newPassword']);
			$this->db->where('email_ad', $email);
			$this->db->update('Users', array('temp_password' => $hashed_pass));
			$this->send_new_password($email, $data['newPassword']);
		}

		else //user does not exist in the database
			$data['reset'] = false;

		return $data;
	}

	function randLetter($random) {
		switch($random):
			case 0:
				return strtoupper(chr(97 + mt_rand(0, 25))); //random uppercase letter
			case 1:
				return strtolower(chr(97 + mt_rand(0, 25))); //random lowercase letter
		endswitch;
	}

	function randomizePassword() {
		$newPassword = "";
		
		for($i = 0; $i < 8; $i++) {
			$random = mt_rand(0, 2);

			if($random == 2)
				$add = mt_rand(0, 9);
			else
				$add = $this->randLetter($random);
			
			$newPassword .= $add;
		}
		
		return $newPassword;
	}

	function send_new_password($email, $password){
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype('text');
		$this->email->clear();

		$this->email->from($this->config->item('email_bot'), $this->config->item('email_name'));
		$this->email->to($email);	
		$this->email->subject('Password Reset');
		$this->email->message("Good day! You have recently asked for your password to be reset. Your new temporary password is "
			.$password
			.". Please remember to reset your password after logging in to prevent this from happening again."
			." If you did not ask for your password to be reset, please ignore this email. Thank you!");

		if(!$this->email->send())
			echo $this->email->print_debugger();
	}

}