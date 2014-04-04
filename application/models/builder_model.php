<?php

class Builder_model extends MY_Model{

	function __construct(){
		parent::__construct();
	}

	function get_all_objects($eid){
		$data = [];

		$this->db->where('Pages.eid', $eid);
		$this->db->join('Pages', 'Pages.pid = Objects.pid');
		$query = $this->db->get('Objects');

		if($query->num_rows == 0)
			return null;

		$objects = $this->query_conversion($query);
		foreach($objects as $object){
			$new_obj = array($object->x_pos, $object->y_pos, $object->type);
			if ($new_obj[2] == "label"){
				$label = $this->get_object($object->oid, 'Labels');
				if($label != null)
					array_push($new_obj, $label->text);
			}

			if ($new_obj[2] == "question"){
				$label = $this->get_object($object->oid, 'Labels');
				array_push($new_obj, $label->text);
			}

			if ($new_obj[2] == "button"){
				$button = $this->get_object($object->oid, 'Buttons');
				array_push($new_obj, $button->text);
			}

			array_push($data, $new_obj);
		}

		return $data;
	}


	function get_object($oid, $table){
		$this->db->where('oid', $oid);
		$query = $this->db->get($table);
		return $this->query_row_conversion($query);
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

	function add_dropdown($data){
		$this->db->insert('Dropdowns',$data);
		return $this->db->insert_id();
	}

	function add_slider($data){
		$this->db->insert('Sliders',$data);
		return $this->db->insert_id();
	}

}