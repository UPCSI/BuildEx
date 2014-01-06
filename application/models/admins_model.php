<?php

class Admins_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_admin($user_info = null,$admin_info = null){
		/*
		* Inserts the admin to the database
		*/
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		$uid = $this->db->insert_id();
		$admin_info['uid'] = $uid;
		return $this->db->insert('Admins',$admin_info);
	}

	public function delete_admin($username){
		/*
		* Deletes an admin given its username.
		* Returns true if the actual delete happened,
		* false otherwise.
		*/
		$this->load->model('users_model');
		$this->users_model->delete_user($username);

		return $this->is_rows_affected();
	}

	public function get_admin_profile($username){ 
		/*
		* Returns the profile of a particular admin.
		*/
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Admins.uid');
		$this->db->where('Users.username',$username);
		$q = $this->db->get('Admins');
		return $this->query_row_conversion($q);
	}

	public function get_all_admins(){
		/*
		* Returns an array containing all the information for each admin.
		*/
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Admins.uid');
		$q = $this->db->get('Admins');
		return $this->query_conversion($q);
	}

}