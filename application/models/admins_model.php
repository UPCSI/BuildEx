<?php

class Admins_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_admin($user_info = null,$admin_info = null){ //insert row in Admins
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		$uid = $this->db->insert_id();
		$admin_info['uid'] = $uid;
		return $this->db->insert('Admins',$admin_info);
	}

	public function delete_admin($username){
		$this->load->model('users_model');
		$this->users_model->delete_user($username);
	}

	public function get_admin_profile($username){ //get the profile of particular admin
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Admins.uid');
		$this->db->where('Users.username',$username);
		$q = $this->db->get('Admins');
		return $this->query_row_conversion($q);
	}

	public function get_all_admins(){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Admins.uid');
		$q = $this->db->get('Admins');
		return $this->query_conversion($q);
	}

}