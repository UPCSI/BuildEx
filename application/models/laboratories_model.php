<?php

class Laboratories_model extends MY_Model{

	public function add_laboratory($laboratory_info,$lab_head_info){
		/*
		* Inserts a laboratory to the database given the laboratory info 
		* Returns the labid of the newly inserted laboratory
		*/
		$this->db->insert('Laboratories',$laboratory_info);
		$labid = $this->db->insert_id();
		$this->load->model('laboratoryheads_model');
		$lid = $this->laboratoryheads_model->add_laboratory_head($lab_head_info);
		$this->db->insert('manages',array('lid'=>$lid,'labid'=>$labid));	
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

	/*Laboratory Heads Functionalities*/

	public function add_faculty_member($labid,$fid){
		return $this->db->insert('faculty_member_of',array('labid'=>$labid,'fid'=>$fid));
	}

	public function add_graduate_member($labid,$gid){
		return $this->db->insert('graduate_member_of',array('labid'=>$labid,'gid'=>$gid));
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