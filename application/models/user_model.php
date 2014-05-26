<?php

class User_model extends MY_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model','admin');
		$this->load->model('graduate_model','graduate');
		$this->load->model('laboratory_head_model','laboratory_head');
	}

	public function get_rules(){
		return array('username' => array('field' => 'username', 
					 					 'label' => 'Username', 
										 'rules' => 'trim|required|xss_clean|min_length[4]|max_length[16]'), 
					 'password' => array('field' => 'password', 
										 'label' => 'Password', 
										 'rules' => 'trim|required|min_length[6]|max_length[16]'));
	}

	/* CRUD */
	public function create($user_info){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		return $this->db->insert_id();
	}

	public function get($uid = 0, $username = NULL){
		if($uid > 0){
			$this->db->where('Users.uid', $uid);
		}
		else{
			$this->db->where('Users.username', $username);
		}
		$q = $this->db->get('Users');
		return $this->query_row_conversion($q);
	}
	/* END OF CRUD */
	
	public function is_valid_user($username = NULL, $password = NULL){
		$user = $this->get(0, $username);
		$hash_pass = $this->my_hash($password);

		if(isset($user)){
			if($user->password === $hash_pass){
				return $this->is_valid_email($user->email_ad);
			}
			return $user->temp_password === $hash_pass;
		}
		return FALSE;
	}

	public function set_session_data($username = NULL){
		$user = $this->get(0, $username);

		$data = array('uid' => $user->uid,
					  'username' => $user->username,
					  'roles' => $this->get_roles($user->uid),
					  'active_role' => NULL,
					  'loggedin' => TRUE);

		if(array_key_exists('admin', $data['roles'])){
			$data['active_role'] = 'admin';
		}
		else if(array_key_exists('labhead', $data['roles'])){
			$data['active_role'] = 'labhead';
		}
		else if(array_key_exists('faculty', $data['roles'])){
			$data['active_role'] = 'faculty';
		}
		else if(array_key_exists('graduate', $data['roles'])){
			$data['active_role'] = 'graduate';
		}

		$this->session->set_userdata($data);
	}

	public function get_roles($uid = 0){
		$roles = array();

		$query = $this->db->get_where('Admins', array('uid' => $uid));
		$admin = $this->query_row_conversion($query);
		if(isset($admin)){
			$roles['admin'] = $admin->aid;
		}

		$query = $this->db->get_where('LaboratoryHeads', array('uid' => $uid));
		$labhead = $this->query_row_conversion($query);
		if(isset($labhead)){
			$roles['labhead'] = $labhead->lid;
		}

		$query = $this->db->get_where('Faculty', array('uid' => $uid));
		$faculty = $this->query_row_conversion($query);
		if(isset($faculty)){
			$roles['faculty'] = $faculty->fid;
		}

		$query = $this->db->get_where('Graduates', array('uid' => $uid));
		$graduate = $this->query_row_conversion($query);
		if(isset($graduate)){
			$roles['graduate'] = $graduate->gid;
		}

		return $roles;
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

	public function is_valid_email($email = NULL){
		return strcmp(substr($email, -1), '*') != 0;
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

	

	public function get_user_profile($uid = 0, $username = NULL){
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

	public function switch_roles($role){
		$this->session->set_userdata(array('active_role' => $role));
		if($role == 'admin')
			$id = $this->session->userdata('aid');
		else if($role == 'labhead')
			$id = $this->session->userdata('lid');
		else if($role == 'faculty')
			$id = $this->session->userdata('fid');
		else if ($role == 'graduate')
			$id = $this->session->userdata('gid');

		$this->session->set_userdata(array('active_id' => $id));
	}


}