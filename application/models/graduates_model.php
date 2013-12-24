<?php

class Graduates_model extends MY_Model{

	public function get_all_graduates(){
		$this->db->select('*');
		$q = $this->db->get('Graduates');
		return $this->queryConversion($q);
	}
	
}