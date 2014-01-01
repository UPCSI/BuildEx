<?php

class Faculty_model extends MY_Model{
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
		$this->db->where('username', $username);
		$query = $this->db->get("Users");
		if($query->num_rows > 0)
			return false;

		$this->db->where('email_ad', $email);
		$query = $this->db->get("Users");
		if($query->num_rows > 0)
			return false;

		return true;
	}

	public function add_faculty($user_info = null, $faculty_info = null){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		$uid = $this->db->insert_id();
		$faculty_info['uid'] = $uid;
		$this->db->insert('Faculty',$faculty_info);
		return true;
	}

	public function delete_faculty($username){
		$this->load->model('users_model');
		return $this->users_model->delete_user($username);
	}

	public function get_faculty_profile($username){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Faculty.uid');
		$this->db->where('Users.username',$username);
		$q = $this->db->get('Faculty');
		return $this->query_row_conversion($q);
	}

	public function get_all_faculty(){
		$this->db->select('*');
		$q = $this->db->get('Faculty');
		return $this->queryConversion($q);
	}
}