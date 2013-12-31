<?php

class Users_model extends MY_Model{
	public $rules = array(
		'username' => array(
			'field' => 'username', 
			'label' => 'Username', 
			'rules' => 'trim|required|xss_clean|min_length[4]|max_length[16]'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|min_length[6]|max_length[16]'
		)
	);

	public function __construct(){
		parent::__construct();
	}
	
	public function is_valid_user($username = null, $password = null){
		/*returns true if there's an existing user with corresponding username and password*/

		$this->db->select('username','password');
		$this->db->where('username',$username);
		$this->db->where('password',$this->my_hash($password));

		$q = $this->db->get('Users');

		if($this->query_row_conversion($q)){
			return true;
		}

		return false;
	}

	public function delete_user($username){
		$this->db->where('username',$username);
		return $this->db->delete('Users');
	}

	public function set_session_data($username){
		$this->db->where('username', $username);
		$query = $this->db->get('Users');
		$user = $query->row();
		$data = array(
			'id' => $user->uid,
			'username' => $user->username,
			'fname' => $user->first_name,
			'mname' => $user->middle_name,
			'lname' => $user->last_name,
			'email' => $user->email_ad,
			'loggedin' => TRUE
		);

		$this->session->set_userdata($data);
	}
}