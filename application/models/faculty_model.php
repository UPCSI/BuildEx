<?php

class Faculty_model extends MY_Model{
	/* CRUD */
	public function create($user_info = NULL, $faculty_id = 0){
		$faculty_info['uid'] = $this->user_model->create($user_info);
		$faculty_info['faculty_num'] = $faculty_id;
		$this->db->insert('Faculty', $faculty_info);
		return $this->db->insert_id();
	}

	public function destroy($fid = 0, $username = NULL){
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

	public function update($fid = 0, $faculty_info = NULL){
		$this->db->where('fid', $fid);
		$this->db->update('Faculty', $faculty_info);
		return $this->is_rows_affected();
	}

	public function get($fid = 0, $username = NULL){
		$this->db->select('Faculty.*, Users.*');
		$this->db->join('Users','Users.uid = Faculty.uid');
		if($fid > 0){
			$this->db->where('Faculty.fid', $fid);
		}
		else{
			$this->db->where('Users.username', $username);
		}
		$q = $this->db->get('Faculty');
		return $this->query_row_conversion($q);
	}
	/* End of CRUD */

	public function get_rules(){
		//put form validation here
		return 0;
	}

	public function get_experiments($fid = 0, $category = NULL){
		$this->db->join('faculty_conduct', 'faculty_conduct.eid = Experiments.eid');
		$this->db->join('Faculty', 'Faculty.fid = faculty_conduct.fid');
		$this->db->where('Faculty.fid',$fid);
		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
	}

	public function confirm($fid = 0){
		$faculty_info['account_status'] = 'true';
		return $this->update($fid, $faculty_info);
	}

	public function reject($fid = 0){
		return $this->destroy($fid);
	}

	public function is_confirmed($fid = 0){
		$faculty = $this->faculty->get($fid, NULL);
		return $faculty->account_status == 't';
	}
	
	public function get_all_lab_faculty($labid = 0){
		$this->db->select('Users.*,Faculty.*');
		$this->db->join('faculty_member_of', 'faculty_member_of.fid = Faculty.fid');
		$this->db->join('Users', 'Users.uid = Faculty.uid');
		$this->db->join('Laboratories', 'Laboratories.labid = faculty_member_of.labid');
		$this->db->where('Laboratories.labid', $labid);
		$this->db->where('faculty_member_of.status', 't');
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