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

	public function add_graduate($uid, $graduate_info = null){
		$graduate_info['uid'] = $uid;
		$this->db->insert('Graduates',$graduate_info);
		return $this->db->insert_id();
	}


	public function delete_graduate($gid = 0,$username = null){
		/*
		* Deletes a graduate student given its fid or username.
		* Returns true if the actual delete happened,
		* false otherwise.
		*/
		if($gid == 0 && is_null($username)){
			return false;
		}

		if($gid > 0){
			$this->db->where('gid',$gid);
			$this->db->delete('Graduates');
		}
		else{
			$q = "DELETE FROM \"Graduates\" AS g
				  USING \"Users\" AS u
				  WHERE g.uid = u.uid AND
				  u.username = ?";
			$this->db->query($q,array($username));
		}
		return $this->is_rows_affected();
	}

	public function update_graduate($gid = 0, $graduate_info){
		$this->db->where('gid', $gid);
		$this->db->update('Graduates', $graduates_info);
		return $this->is_rows_affected();
	}

	public function get_graduate_profile($gid = 0, $username = null){
		/*
		* Returns the profile of a particular graduate given its 
		* gid or username
		*/
		if($gid == 0 && is_null($username)){
			return false;
		}
		$this->db->select('Graduates.*');
		if($gid > 0){
			$this->db->where('Graduates.gid',$gid);
		}
		else{
			$this->db->join('Users','Users.uid = Graduates.uid');
			$this->db->where('Users.username',$username);
		}
		$q = $this->db->get('Graduates');
		return $this->query_row_conversion($q);
	}

	/*Laboratory Heads Functionalities*/
	public function get_all_lab_graduates($lid = 0,$labid = 0){
		/*
		* Given the lab head's lid and the labid of the laboratory
		* it manages, this function will return all the graduates in
		* that lab.
		*/
		$this->db->select('*');
		$this->db->join('graduates_member_of','graduates_member_of.gid = Graduates.gid');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$this->db->join('Laboratories','Laboratories.labid = graduates_member_of.labid');
		$this->db->join('manages','manages.labid = Laboratories.labid');
		$this->db->join('LaboratoryHeads','LaboratoryHeads.lid = LaboratoryHeads.lid');
		$this->db->where('LaboratoryHeads.lid',$lid);
		$this->db->where('Laboratories.labid',$labid);
		$q = $this->db->get('Graduates');

		return $this->query_conversion($q);
	}

	/*Admin Functionalities*/
	public function get_all_graduates(){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$q = $this->db->get('Graduates');
		return $this->query_conversion($q);	
	}
	
}