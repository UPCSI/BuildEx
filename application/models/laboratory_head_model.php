<?php

class Laboratory_head_model extends MY_Model{

	/* CRUD */
	public function create($labhead_info){
		$this->db->insert('LaboratoryHeads',$labhead_info);
		return $this->db->insert_id();
	}

	public function delete_laboratory_head($lid =0,$username){
		if(lid == 0 && is_null($username)){
			return false;
		}

		if($lid > 0){
			$this->db->where('lid',$lid);
			$this->db->delete('LaboratoryHeads');
		}
		else{
			$q = "DELETE FROM \"LaboratoryHeads\" AS l
				  USING \"Users\" AS u
				  WHERE l.uid = u.uid AND
				  u.username = ?";
			$this->db->query($q,array($username));
		}
		return $this->is_rows_affected();
	}

	public function update_laboratory_head($lid,$labhead_info){
		/*
		* Updates a laboratory head given its lid.
		* Returns true if the actual update happened,
		* false otherwise.
		*/
		$this->db->where('lid', $lid);
		$this->db->update('LaboratoryHeads', $labhead_info);
		return $this->is_rows_affected();
	}

	public function get_laboratory_head_profile($lid = 0,$username = NULL){
		/*
		* Returns the profile of a particular laboratory head 
		* given its lid or username.
		*/
		if($lid == 0 && is_null($username)){
			return false;
		}
		$this->db->select('LaboratoryHeads.*');
		if($lid > 0){
			$this->db->where('LaboratoryHeads.lid',$lid);
		}
		else{
			$this->db->join('Users','Users.uid = LaboratoryHeads.uid');
			$this->db->where('Users.username',$username);
		}
		$q = $this->db->get('LaboratoryHeads');
		return $this->query_row_conversion($q);
	}
	/* End of CRUD */

	public function assign_to($lid = 0, $labid = 0){
		return $this->db->insert('manage',array('lid'=>$lid, 'labid'=>$labid));
	}

	public function get_laboratory_head_of_lab($labid = 0){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = LaboratoryHeads.uid');
		$this->db->join('manage','manage.lid = LaboratoryHeads.lid');
		$this->db->join('Laboratories','Laboratories.labid = manage.labid');
		$this->db->where('Laboratories.labid',$labid);
		$q = $this->db->get('LaboratoryHeads');
		return $this->query_row_conversion($q);
	}

	/* Admin Functionalities*/
	public function get_all_laboratory_heads(){
		$this->db->select('LaboratoryHeads.*');
		$q = $this->db->get('LaboratoryHeads');
		return $this->query_conversion($q);
	}
}