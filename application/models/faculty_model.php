<?php

class Faculty_model extends MY_Model{

	public function add_faculty($user_info = null, $graduate_info = null){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		$uid = $this->db->insert_id();
		$graduate_info['uid'] = $uid;
		$this->db->insert('Faculty',$graduate_info);
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