<?php

class Builder_model extends MY_Model{

	function __construct(){
		parent::__construct();
	}

	function add_page($data){
		$this->db->insert('Pages',$data);
		return $this->db->insert_id();
	}

	function add_form($data){
		$this->db->insert('Questions',$data);
		return $this->db->insert_id();
	}

	function add_option($data){
		$this->db->where('qid', $data['qid']);
		$query = $this->db->get('Questions');
		$question = $query->row();
		$type = $question->type;

		$this->db->insert('Options',$data);
		return $this->db->insert_id();

		if($type > 0){
			$this->db->insert('Options',$data);
			return $this->db->insert_id();
		}
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