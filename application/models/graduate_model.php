<?php

class Graduate_model extends MY_Model{

	/* CRUD */
	public function create($user_info = NULL, $student_id = 0){
		$graduate_info['uid'] = $this->user_model->create($user_info);
		$graduate_info['student_num'] = $student_id;
		$this->db->insert('Graduates', $graduate_info);
		return $this->db->insert_id();
	}

	public function get($gid = 0, $username = NULL){
		$this->db->join('Users', 'Users.uid = Graduates.uid');
		if($gid > 0){
			$this->db->where('Graduates.gid', $gid);
		}
		else{
			$this->db->where('Users.username', $username);
		}
		$q = $this->db->get('Graduates');
		return $this->query_row_conversion($q);
	}

	public function all(){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$q = $this->db->get('Graduates');
		return $this->query_conversion($q);	
	}

	public function destroy($gid = 0, $username = NULL){
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
	/* End of CRUD */

	public function get_rules(){
		//put form validation here
		return 0;
	}

	public function get_experiments($gid = 0, $category = NULL){
		$this->db->join('graduates_conduct', 'graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates', 'Graduates.gid = graduates_conduct.gid');
		$this->db->where('Graduates.gid',$gid);
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function get_laboratory($gid, $cond = "true"){
		$this->db->select('Laboratories.*');
		$this->db->join('graduates_member_of','graduates_member_of.labid = Laboratories.labid');
		$this->db->where('graduates_member_of.gid',$gid);
		$this->db->where('graduates_member_of.status', $cond);
		$q = $this->db->get('Laboratories');
		return $this->query_row_conversion($q);
	}

	public function get_by_experiment($eid = 0){
		$this->db->join('Users', 'Users.uid = Graduates.uid');
		$this->db->join('graduates_conduct', 'graduates_conduct.gid = Graduates.gid');
		$this->db->where('graduates_conduct.eid', $eid);
		$q = $this->db->get('Graduates');
		return $this->query_row_conversion($q);
	}
}