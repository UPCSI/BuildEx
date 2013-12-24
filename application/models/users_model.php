<?php

class Users_model extends MY_Model{

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
}