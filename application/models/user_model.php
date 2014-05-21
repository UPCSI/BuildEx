<?php

class User_model extends MY_Model{

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

	/* CRUD */
	public function create($user_info){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		return $this->db->insert_id();
	}

	public function get($uid = 0, $username = null){
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
			'aid' => NULL,
			'lid' => NULL,
			'fid' => NULL,
			'gid' => NULL,
			'loggedin' => TRUE
		);

		/* get other id */
		$role = $data['role'];
		if(in_array('admin',$role)){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('Admins');
			$user = $query->row();
			$data['aid'] = $user->aid;
			$data['active_role'] = 'admin';
		}

		if(in_array('labhead',$role)){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('LaboratoryHeads');
			$user = $query->row();
			$data['lid'] = $user->lid;
			$data['active_role'] = 'labhead';
		}		

		if(in_array('faculty',$role)){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('Faculty');
			$user = $query->row();
			$data['fid'] = $user->fid;
			$data['active_role'] = 'faculty';
		}

		if(in_array('graduate',$role)){
			$this->db->where('uid', $data['uid']);
			$query = $this->db->get('Graduates');
			$user = $query->row();
			$data['gid'] = $user->gid;
			$data['active_role'] = 'graduate';
		}		

		/* get active_id */
		$role = $data['role'][0];
		if($role == 'admin')
			$data['active_id'] = $data['aid'];

		else if($role == 'labhead')
			$data['active_id'] = $data['lid'];

		else if($role == 'faculty')
			$data['active_id'] = $data['fid'];

		else if($role == 'graduate')
			$data['active_id'] = $data['gid'];



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
			array_push($role, 'labhead');
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