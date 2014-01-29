<?php

class Users_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

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
	
	public function is_valid_user($username = null, $password = null){
		/*
		* Returns true if there's an existing user with corresponding 
		* username and password
		*/
		$this->db->select('username','password');
		$this->db->where('username',$username);
		$this->db->where('password',$this->my_hash($password));
		$q = $this->db->get('Users');

		if($this->query_row_conversion($q)){
			if(!$this->is_valid_email($username))
				return false;
			return true;
		}

		$this->db->where('username',$username);
		$this->db->where('temp_password',$this->my_hash($password));
		$q = $this->db->get('Users');

		if($this->query_row_conversion($q))
			return true;

		return false;
	}

	public function set_session_data($username){
		$this->db->where('username', $username);
		$query = $this->db->get('Users');
		$user = $query->row();
		$data = array(
			'uid' => $user->uid,
			'username' => $user->username,
			'fname' => $user->first_name,
			'mname' => $user->middle_name,
			'lname' => $user->last_name,
			'email' => $user->email_ad,
			'role'	=> $this->check_role($user->uid),
			'loggedin' => TRUE
		);

		/* get active_id */

		$role = $data['role'][0];

		if($role == 'admin'){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('Admins');
			$user = $query->row();
			$data['active_id'] = $user->aid;
		}

		else if($role == 'lab head'){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('LaboratoryHeads');
			$user = $query->row();
			$data['active_id'] = $user->lid;
		}		

		else if($role == 'faculty'){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('Faculty');
			$user = $query->row();
			$data['active_id'] = $user->fid;
		}

		else if($role == 'graduate'){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('Graduates');
			$user = $query->row();
			$data['active_id'] = $user->gid;
		}		

		$this->session->set_userdata($data);
	}

	public function check_role($uid){
		$role = array();
		$query = $this->db->get_where('Admins', array('uid' => $uid));
		if($query->num_rows == 1){
			array_push($role, 'admin');
		}

		$query = $this->db->get_where('LaboratoryHeads', array('uid' => $uid));
		if($query->num_rows == 1){
			array_push($role, 'lab head');
		}

		$query = $this->db->get_where('Faculty', array('uid' => $uid));
		if($query->num_rows == 1){
			array_push($role, 'faculty');
		}

		$query = $this->db->get_where('Graduates', array('uid' => $uid));
		if($query->num_rows == 1){
			array_push($role, 'graduate');
		}

		return $role;
	}

	public function is_unique($username, $email){
		/* 
		* Checks if username and email are unique
		*/

		$this->db->where('username', $username);
		$query = $this->db->get("Users");
		if($query->num_rows > 0)
			return false;

		$this->db->where('email_ad', $email);
		$query = $this->db->get("Users");
		if($query->num_rows > 0)
			return false;

		$email .= '*';
		$this->db->where('email_ad', $email);
		$query = $this->db->get("Users");
		if($query->num_rows > 0)
			return false;
		return true;
	}

	public function is_valid_email($username){
		$this->db->where('username', $username);
		$query = $this->db->get('Users');
		$user = $query->row();
		if(strcmp(substr($user->email_ad, -1),'*') == 0)
			return false;
		return true;
	}

	public function confirmed_faculty(){
		/* 
		* Checks if faculty has been confirmed by an admin.
		*/

		$this->db->where('fid', $this->session->userdata('active_id'));
		$query = $this->db->get('Faculty');
		$user = $query->row();
		return $user->account_status;		
	}

	public function add_user($user_info){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		return $this->db->insert_id();
	}

	public function update_user($uid, $user_info){
		$this->db->where('uid', $uid);
		$this->db->update('Users', $user_info);
		return $this->is_rows_affected();
	}

	public function delete_user($uid){
		$this->db->where('uid',$uid);
		$this->db->delete('Users');
		return $this->is_rows_affected();
	}

	public function get_user_profile($uid = 0, $username = null){
		/*
		* Returns the profile of a particular user given its uid or username
		*/
		if($uid == 0 && is_null($username)){
			return false;
		}
		$this->db->select('uid,username,first_name,middle_name,last_name,email_ad');
		if($uid > 0){
			$this->db->where('Users.uid',$uid);
		}
		else{
			$this->db->where('Users.username',$username);
		}
		$q = $this->db->get('Users');
		return $this->query_row_conversion($q);
	}
}