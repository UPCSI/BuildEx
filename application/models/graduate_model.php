<?php

class Graduate_model extends MY_Model{

	/* CRUD */
	public function create($user_info = NULL, $student_id = 0){
		$graduate_info['uid'] = $this->user_model->create($user_info);
		$graduate_info['student_num'] = $student_id;
		$this->db->insert('Graduates', $graduate_info);
		return $this->db->insert_id();
	}

	public function delete_graduate($gid = 0,$username = NULL){
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

	public function get_graduate_profile($gid = 0, $username = NULL){
		/*
		* Returns the profile of a particular graduate given its 
		* gid or username
		*/
		if($gid == 0 && is_null($username)){
			return false;
		}
		$this->db->select('Graduates.*,Users.*');
		$this->db->join('Users','Users.uid = Graduates.uid');
		if($gid > 0){
			$this->db->where('Graduates.gid',$gid);
		}
		else{
			
			$this->db->where('Users.username',$username);
		}
		$q = $this->db->get('Graduates');
		return $this->query_row_conversion($q);
	}
	/* End of CRUD */

	public function get_rules(){
		//put form validation here
		return 0;
	}

	public function get_graduate_by_experiment($eid = 0){
		$this->db->select('Graduates.*');
		$this->db->join('graduates_conduct','graduates_conduct.gid = Graduates.gid');
		$this->db->where('graduates_conduct.eid',$eid);
		$q = $this->db->get('Graduates');

		$res = $this->query_row_conversion($q);

		return $this->get_faculty_profile($res->gid);
	}

	/*Laboratory Heads Functionalities*/
	public function get_all_lab_graduates($labid = 0){
		/*
		* Given the labid of the laboratory
		* this function will return all the graduates in
		* that lab.
		*/
		$this->db->select('Users.*,Graduates.*,');
		$this->db->join('graduates_member_of','graduates_member_of.gid = Graduates.gid');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$this->db->join('Laboratories','Laboratories.labid = graduates_member_of.labid');
		$this->db->where('Laboratories.labid',$labid);
		$this->db->where('graduates_member_of.status','t');
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