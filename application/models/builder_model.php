<?php

class Builder_model extends MY_Model{

	function __construct(){
		parent::__construct();
	}

	function get_positions($eid){
		$data = [];

		$this->db->where('Pages.eid', $eid);
		$this->db->join('Pages', 'Pages.pid = Objects.pid');
		$query = $this->db->get('Objects');

		if($query->num_rows == 0)
			return null;

		$objects = $this->query_conversion($query);
		foreach($objects as $object){
			$new_obj = array($object->x_pos, $object->y_pos);
			array_push($data, $new_obj);
		}

		return $data;
	}

	function delete($eid){
		$this->db->where('eid',$eid);
		$this->db->delete('Pages');		
	}

	function add_page($data){
		$this->db->where('eid', $data['eid']);
		$this->db->delete('Pages');

		$this->db->insert('Pages',$data);
		return $this->db->insert_id();
	}

	function add_object($data){
		$this->db->insert('Objects',$data);
		return $this->db->insert_id();
	}

	function add_label($data){
		$this->db->insert('Labels',$data);
		return $this->db->insert_id();
	}

	function add_button($data){
		$this->db->insert('Buttons',$data);
		return $this->db->insert_id();
	}

	function add_question($data){
		$this->db->insert('Questions',$data);
		return $this->db->insert_id();
	}

	function add_input($data){
		$this->db->insert('Inputs',$data);
		return $this->db->insert_id();
	}

	function add_text($data){
		$this->db->insert('Texts',$data);
		return $this->db->insert_id();
	}

	function add_radio($data){
		$this->db->insert('Radios',$data);
		return $this->db->insert_id();
	}

	function add_checkbox($data){
		$this->db->insert('Checkboxes',$data);
		return $this->db->insert_id();
	}


/*
	------------------------------------------------------------------------------------
	UPDATE
	------------------------------------------------------------------------------------
*/


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