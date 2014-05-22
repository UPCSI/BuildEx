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

	public function create($user_info = null, $faculty_info = null){
		$user_info['password'] = $this->my_hash($user_info['password']);
		$faculty_info['uid'] = $this->user_model->create($user_info);
		$this->db->insert('Faculty', $faculty_info);
		return $this->db->insert_id();
	}


	public function delete_faculty($fid = 0,$username = null){
		/*
		* Deletes a faculty member given its fid or username.
		* Returns true if the actual delete happened,
		* false otherwise.
		*/
		if($fid == 0 && is_null($username)){
			return false;
		}

		if($fid > 0){
			$this->db->where('fid',$fid);
			$this->db->delete('Faculty');
		}
		else{
			$q = "DELETE FROM \"Faculty\" AS f
				  USING \"Users\" AS u
				  WHERE f.uid = u.uid AND
				  u.username = ?";
			$this->db->query($q,array($username));
		}
		return $this->is_rows_affected();
	}

	public function update_faculty($fid = 0, $faculty_info){
		$this->db->where('fid', $fid);
		$this->db->update('Faculty', $faculty_info);
		return $this->is_rows_affected();
	}

	public function get_faculty_profile($fid = 0, $username = null){
		/*
		* Returns the profile of a particular faculty member 
		* given its fid or username.
		*/
		if($fid == 0 && is_null($username)){
			return false;
		}

		$this->db->select('Faculty.*,Users.*'); //change Users
		$this->db->join('Users','Users.uid = Faculty.uid');
		if($fid > 0){
			$this->db->where('Faculty.fid',$fid);
		}
		else{
			$this->db->where('Users.username',$username);
		}
		$q = $this->db->get('Faculty');
		return $this->query_row_conversion($q);
	}

	
	public function get_all_lab_faculty($labid = 0){
		/*
		* Given the labid of the laboratory
		* this function will return all the faculty in
		* that lab.
		*/
		$this->db->select('Users.*,Faculty.*');
		$this->db->join('faculty_member_of','faculty_member_of.fid = Faculty.fid');
		$this->db->join('Users','Users.uid = Faculty.uid');
		$this->db->join('Laboratories','Laboratories.labid = faculty_member_of.labid');
		$this->db->where('Laboratories.labid',$labid);
		$this->db->where('faculty_member_of.status','t');
		$q = $this->db->get('Faculty');

		return $this->query_conversion($q);
	}

	public function request_advise($fid,$eid){
		return $this->db->insert('advise',array('fid'=>$fid,'eid'=>$eid));
	}

	public function get_faculty_by_experiment($eid = 0){
		$this->db->select('Faculty.*');
		$this->db->join('faculty_conduct','faculty_conduct.fid = Faculty.fid');
		$this->db->where('faculty_conduct.eid',$eid);
		$q = $this->db->get('Faculty');

		$res = $this->query_row_conversion($q);

		return $res;
	}

	/* Laboratory Heads functionalities*/

	/*Admin functionalities*/
	public function get_all_faculty(){
		$this->db->select('Users.uid,username,first_name,middle_name,last_name,email_ad,fid,faculty_num');
		$this->db->where('Faculty.account_status','t');
		$this->db->join('Users','Users.uid = Faculty.uid');
		$q = $this->db->get('Faculty');
		return $this->query_conversion($q);
	}

	public function get_all_account_requests(){
		$this->db->select('Users.uid,username,first_name,middle_name,last_name,email_ad,fid,faculty_num');
		$this->db->join('Users','Users.uid = Faculty.uid');
		$this->db->where('Faculty.account_status','f');
		$q = $this->db->get('Faculty');
		return $this->query_conversion($q);
	}
}