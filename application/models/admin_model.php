<?php

class Admin_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	/* CRUD */
	public function create($username = NULL){
		$user = $this->user_model->get(0, $username);
		$admin_info['uid'] = $user->uid;
		$this->db->insert('Admins',$admin_info);
		return $this->db->insert_id();
	}

	public function destroy($aid = 0, $username = NULL){
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
	/* END OF CRUD */

	public function get($aid = 0,$username = NULL){ 
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

	public function all(){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Admins.uid');
		$q = $this->db->get('Admins');
		return $this->query_conversion($q);
	}
}