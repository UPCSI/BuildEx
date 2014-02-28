<?php

class Builder_model extends MY_Model{

	function __construct(){
		parent::__construct();
	}

	function get_positions($eid){
		$data = [];

		$this->db->where('Pages.eid', $eid);
		$this->db->join('Pages', 'Pages.pid = Questions.pid');
		$query = $this->db->get('Questions');

		if($query->num_rows == 0)
			return null;

		$objects = $this->query_conversion($query);
		foreach($objects as $object){
			$new_obj = array($object->x_pos, $object->y_pos);
			array_push($data, $new_obj);
		}

		return $data;
	}

	function add_page($data){
		$this->db->insert('Pages',$data);
		return $this->db->insert_id();
	}

	function add_form($data){
		$this->db->insert('Questions',$data);
		return $this->db->insert_id();
	}

	function add_option_group($data){
		$this->db->insert('OptionGroups',$data);
		return $this->db->insert_id();
	}

	function add_option($data){
		$this->db->insert('Options',$data);
		return $this->db->insert_id();
	}

	function update_form($data){
		$this->db->where('qid', $data['qid']);
		$this->db->update('Questions',$data);
	}

	function update_option($data){
		$this->db->where('oid', $data['oid']);
		$this->db->update('Options',$data);
	}

/*
	------------------------------------------------------------------------------------
	DO NOT EDIT SECTION BELOW
	------------------------------------------------------------------------------------
*/

	function delete_page($data){
		//gets order (for changing numbering) and qid (for deleting associated forms and options)
		$this->db->where('pid', $data['pid']);
		$query = $this->db->get('Pages');
		$page = $query->row();
		$order = $page->order;

		$this->db->where('pid', $data['pid']);
		$query = $this->db->get('Questions');
		$form = $query->row();
		$qid = $form->qid;

		//deletes page and associated forms and options
		$this->db->where('pid', $data['pid']);
		$this->db->delete('Pages');

		$this->db->where('pid', $data['pid']);
		$this->db->delete('Questions');

		$this->db->where('qid', $data['qid']);
		$this->db->delete('Options');

		//change numbering
		$this->change_numbering($data['eid'], $order, -1);
	}

	function insert_page($data){
	}

	function change_numbering($eid, $order, $incr){
	}



}