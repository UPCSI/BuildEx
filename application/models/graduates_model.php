<?php

class Graduates_model extends MY_Model{

	public function add_graduate($user_info = null, $graduate_info = null){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$this->db->insert('Users',$user_info);
		$uid = $this->db->insert_id();
		$graduate_info['uid'] = $uid;
		$this->db->insert('Graduates',$graduate_info);
	}

	public function delete_graduate($username){
		$this->load->model('users_model');
		$this->users_model->delete_user($username);
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
		$q = $this->db->get('Graduates');
		return $this->queryConversion($q);
	}
	
}