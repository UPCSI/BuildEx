<?php

class Graduates_model extends MY_Model{
	public $rules = array(
		'fname' => array(
			'field' => 'fname', 
			'label' => 'fname', 
			'rules' => 'trim|required|xss_clean|min_length[1]|max_length[32]'
		), 
		'mname' => array(
			'field' => 'mname', 
			'label' => 'mname', 
			'rules' => 'trim|required|xss_clean|min_length[1]|max_length[32]'
		), 
		'lname' => array(
			'field' => 'lname', 
			'label' => 'lname', 
			'rules' => 'trim|required|xss_clean|min_length[1]|max_length[32]'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'email', 
			'rules' => 'trim|required|xss_clean|min_length[4]|max_length[32]'
		), 
		'username' => array(
			'field' => 'username', 
			'label' => 'Username', 
			'rules' => 'trim|required|xss_clean|min_length[4]|max_length[16]'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|min_length[6]|max_length[16]'
		),
		'password2' => array(
			'field' => 'password2', 
			'label' => 'Password2', 
			'rules' => 'trim|required|matches[password]'
		)
	);

	public function is_unique($username, $email){
		/* checks if username and email are unique */
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

	public function add_graduate($user_info = null, $graduate_info = null){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		$uid = $this->db->insert_id();
		$graduate_info['uid'] = $uid;
		$this->db->insert('Graduates',$graduate_info);
		return true;
	}


	public function delete_graduate($username){
		$this->load->model('users_model');
		return $this->users_model->delete_user($username);
	}

	public function get_graduate_profile($username){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$this->db->where('Users.username',$username);
		$q = $this->db->get('Graduates');
		return $this->query_row_conversion($q);
	}

	public function get_all_graduates(){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$q = $this->db->get('Graduates');
		return $this->query_conversion($q);	
	}
	
}