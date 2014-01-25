<?php

class LaboratoryHeads_model extends MY_Model{


	public function add_laboratory_head($labhead_info){
		$this->db->insert('LaboratoryHeads',$labhead_info);
		return $this->db->insert_id();
	}

	public function delete_laboratory_head($lid =0,$username){
		/*
		* Deletes a laboratory head given its lid or username.
		* Returns true if the actual delete happened,
		* false otherwise.
		*/
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

	public function get_laboratory_head_profile($lid = 0,$username = null){
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

	/* Admin Functionalities*/
	public function get_all_laboratory_heads(){
		$this->db->select('LaboratoryHeads.*');
		$q = $this->db->get('LaboratoryHeads');
		return $this->query_conversion($q);
	}
}