<?php

class Laboratories_model extends MY_Model{

	public function add_laboratory($laboratory_info,$lab_head_info){
		/*
		* Inserts a laboratory to the database given the laboratory info 
		* Returns the labid of the newly inserted laboratory
		*/
		$this->load->model('laboratoryheads_model');
		$lid = $this->laboratoryheads_model->add_laboratory_head($lab_head_info);

		$this->db->insert('Laboratories',$laboratory_info);
		$labid = $this->db->insert_id();

		$this->db->insert('manage',array('lid'=>$lid,'labid'=>$labid));
		return $labid;
	}

	public function delete_laboratory($labid){
		/*
		* Deletes a laboratory given its labid.
		* Returns true if the actual delete happened,
		* false otherwise.
		*/
		$this->db->where('labid',$labid);
		$this->db->delete('Laboratories');
		return $this->is_rows_affected();
	}

	public function update_laboratory($labid, $laboratory_info){
		/*
		* Updates a laboratory given its labid.
		* Returns true if the actual update happened,
		* false otherwise.
		*/
		$this->db->where('labid', $labid);
		$this->db->update('Laboratories', $laboratory_info);
		return $this->is_rows_affected();
	}

	public function get_laboratory($labid){
		$this->db->select('*');
		$this->db->where('labid',$labid);
		$q = $this->db->get('Laboratories');
		return $this->query_row_conversion($q);
	}

	public function get_graduate_laboratory($gid){
		$this->db->select('Laboratories.*');
		$this->db->join('graduates_member_of','graduates_member_of.labid = Laboratories.labid');
		$this->db->where('graduates_member_of.gid',$gid);
		$q = $this->db->get('Laboratories');
		return $this->query_row_conversion($q);
	}

	public function get_faculty_laboratory($fid){
		$this->db->select('Laboratories.*');
		$this->db->join('faculty_member_of','faculty_member_of.labid = Laboratories.labid');
		$this->db->where('faculty_member_of.fid',$fid);
		$q = $this->db->get('Laboratories');
		return $this->query_row_conversion($q);
	}

	public function get_laboratory_head_laboratory($labid){
		$this->db->select('Laboratories.*');
		$this->db->join('manages','manages.labid = Laboratories.labid');
		$this->db->where('manages.labid',$labid);
		$q = $this->db->get('Laboratories');
		return $this->query_row_conversion($q);
	}

	public function request_faculty_lab($labid,$fid){
		return $this->db->insert('faculty_member_of',array('labid'=>$labid,'fid'=>$fid));
	}

	public function request_graduate_lab($labid,$gid){
		return $this->db->insert('graduates_member_of',array('labid'=>$labid,'gid'=>$gid));
	}

	public function is_graduate_member($gid,$labid){
		$this->db->where('gid',$gid);
		$this->db->where('labid',$labid);
		$q = $this->db->get('graduates_member_of');
		if($q->num_rows() > 0){
			return true;
		}
		return false;
	}

	public function is_faculty_member($fid,$labid){
		$this->db->where('fid',$fid);
		$this->db->where('labid',$labid);
		$q = $this->db->get('faculty_member_of');
		if($q->num_rows() > 0){
			return true;
		}
		return false;
	}

	/* Laboratory Heads functionalities*/
	public function accept_faculty($labid,$fid){
		$this->db->where('labid',$labid);
		$this->db->where('fid',$fid);
		$this->db->update('faculty_member_of',array('status'=>'true'));
		$this->increment_member_count($labid);
		return $this->is_rows_affected();
	}

	private function increment_member_count($labid){
		$this->db->set('members_count', 'members_count+1', FALSE);
		$this->db->where('labid', $labid);
		$this->db->update('Laboratories');
	}

	public function accept_graduate($labid, $gid){
		$this->db->where('labid', $labid);
		$this->db->where('gid',$gid);
		$this->db->update('graduates_member_of',array('status'=>'true'));
		return $this->is_rows_affected();
	}

	public function reject_faculty($labid, $fid){
		$this->db->where('labid', $labid);
		$this->db->where('fid',$fid);
		$this->db->delete('faculty_member_of');
		return $this->is_rows_affected();
	}

	public function reject_graduate($labid, $gid){
		$this->db->where('labid', $labid);
		$this->db->where('gid',$gid);
		$this->db->delete('graduates_member_of');
		return $this->is_rows_affected();
	}

	public function get_all_faculty_requests($labid){
		$this->db->select('Users.uid,username,first_name,middle_name,last_name,email_ad,Faculty.fid,faculty_num');
		$this->db->join('Faculty','Faculty.fid = faculty_member_of.fid');
		$this->db->join('Users','Users.uid = Faculty.uid');
		$this->db->where('faculty_member_of.status','f');
		$q = $this->db->get('faculty_member_of');
		return $this->query_conversion($q);
	}

	public function get_all_graduates_requests($labid){
		$this->db->select('Users.uid,username,first_name,middle_name,last_name,email_ad,Graduates.gid,student_num');
		$this->db->join('Graduates','Graduates.gid = graduates_member_of.gid');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$this->db->where('graduates_member_of.status','f');
		$q = $this->db->get('graduates_member_of');
		return $this->query_conversion($q);
	}

	/*Admin Functionalities*/
	public function assign_laboratory_head($labid,$lid){
		/*
		* Assigns a lab head with lid to manage the laboratory with labid
		*/
		return $this->db->insert('manages',array('lid'=>$lid,'labid'=>$labid));
	}

	public function get_all_laboratories(){
		$this->db->select('Laboratories.*');
		$q = $this->db->get('Laboratories');
		return $this->query_conversion($q);
	}
}