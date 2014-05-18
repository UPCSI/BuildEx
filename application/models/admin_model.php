<?php

class Admin_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_admin($uid = 0,$admin_info = null){
		/*
		* Inserts admin to the database
		*/
		$admin_info['uid'] = $uid;
		$this->db->insert('Admins',$admin_info);
		$aid = $this->db->insert_id();
		return $aid;
	}

	public function delete_admin($aid = 0,$username = null){
		/*
		* Deletes an admin given its aid or username.
		* Returns true if the actual delete happened,
		* false otherwise.
		*/
		if($aid == 0 && is_null($username)){
			return false;
		}

		if($aid > 0){
			$this->db->where('aid',$aid);
			$this->db->delete('Admins');
		}
		else{
			$q = "DELETE FROM \"Admins\" AS a
				  USING \"Users\" AS u
				  WHERE a.uid = u.uid AND
				  u.username = ?";
			$this->db->query($q,array($username));
		}
		return $this->is_rows_affected();
	}

	public function get_admin_profile($aid = 0,$username = null){ 
		/*
		* Returns the profile of a particular admin given its aid or username
		*/
		if($aid == 0 && is_null($username)){
			return false;
		}
		$this->db->select('Admins.*');
		if($aid > 0){
			$this->db->where('Admins.aid',$aid);
		}
		else{
			$this->db->join('Users','Users.uid = Admins.uid');
			$this->db->where('Users.username',$username);
		}
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