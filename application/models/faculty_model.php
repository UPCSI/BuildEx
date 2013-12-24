<?php

class Faculty_model extends MY_Model{
	public function get_all_faculty(){
		$this->db->select('*');
		$q = $this->db->get('Faculty');
		return $this->queryConversion($q);
	}
	
}