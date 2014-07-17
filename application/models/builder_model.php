<?php

class Builder_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	/* CRUD Methods */
	public function get($eid = 0){
		$this->db->where('Experiments.eid', $eid);
		$q = $this->db->get('Experiments');
		return $this->query_row_conversion($q);
	}

	public function get_all_objects($eid){
		$data = array();

		$this->db->where('Pages.eid', $eid);
		$this->db->join('Pages', 'Pages.pid = Objects.pid');
		$query = $this->db->get('Objects');

		if($query->num_rows == 0)
			return NULL;

		$objects = $this->query_conversion($query);
		foreach($objects as $object){
			$this->db->where('pid', $object->pid);
			$query = $this->db->get('Pages');
			$order = $this->query_row_conversion($query);

			$new_obj = array();
			$new_obj['page'] = $object->order;
			$new_obj['xPos'] = $object->x_pos;
			$new_obj['yPos'] = $object->y_pos;
			$new_obj['type'] = $object->type;
			$new_obj['width'] = $object->width;
			$new_obj['height'] = $object->height;

			if ($new_obj['type'] == "question"){
				$label = $this->get_object($object->oid, 'Labels');
				$new_obj['text'] = $label->text;
				$new_obj['color'] = $label->font_color;
				$question = $this->get_object($object->oid, 'Questions');
				$new_obj['qid'] = $question->qid;
			}

			if ($new_obj['type'] == "button"){
				$button = $this->get_object($object->oid, 'Buttons');
				$new_obj['text'] = $button->text;
			}

			if ($new_obj['type'] == "radio"){
				$radio = $this->get_input($object->oid, 'Radios');
				$new_obj['text'] = $radio->choices;
			}

			if ($new_obj['type'] == "checkbox"){
				$checkbox = $this->get_input($object->oid, 'Checkboxes');
				$new_obj['text'] = $checkbox->choices;
			}

			if ($new_obj['type'] == "dropdown"){
				/*
					we cannot use the get_input() method because each option for a single dropdown
					is saved as one row in the Dropdowns table. Thus, input_id is not unique. (This
					is because one dropdown object has several options, whereas in radio buttons and
					checkboxes, one option is considered one object.)
				*/

				// $dropdown = $this->get_input($object->oid, 'Dropdowns');
				$this->db->where('Inputs.oid', $object->oid);
				$this->db->join('Inputs', 'Dropdowns'.'.input_id = Inputs.input_id');
				$query = $this->db->get('Dropdowns');
				$dropdown = $this->query_conversion($query);

				$options = array();
				foreach($dropdown as $choice){
					array_push($options, $choice->choices);
				}

				$new_obj['options'] = $options;
			}

			if ($new_obj['type'] == "slider"){
				$slider = $this->get_input($object->oid, 'Sliders');
				$new_obj['min'] = $slider->min_num;
				$new_obj['max'] = $slider->max_num;
			}

			array_push($data, $new_obj);
		}

		return $data;
	}

	public function get_all_pages($eid){
		$this->db->select("*");
		$this->db->where('eid', $eid);
		$query = $this->db->get('Pages');
		return $this->query_conversion($query);
	}

	public function get_object($oid, $table){
		$this->db->where('oid', $oid);
		$query = $this->db->get($table);
		return $this->query_row_conversion($query);
	}

	public function get_input($oid, $table){
		$this->db->where('Inputs.oid', $oid);
		$this->db->join('Inputs', $table.'.input_id = Inputs.input_id');
		$query = $this->db->get($table);

		return $this->query_row_conversion($query);
	}

	public function delete($eid){
		$this->db->where('eid',$eid);
		$this->db->delete('Pages');		
	}

	public function bind($pid, $input_id){
		$this->db->select('*');
		$this->db->where('Pages.pid', $pid);
		$this->db->join('Pages', 'Pages.pid = Objects.pid');
		$this->db->join('Questions', 'Questions.oid = Objects.oid');
		$query = $this->db->get('Objects');
		$object = $this->query_row_conversion($query);
		$this->db->where('qid', $object->qid);
		$this->db->update('Questions', array('input' => $input_id));
	}

	public function add_page($data){
		$this->db->insert('Pages',$data);
		return $this->db->insert_id();
	}

	public function add_object($data){
		$this->db->insert('Objects',$data);
		return $this->db->insert_id();
	}

	public function add_label($data){
		$this->db->insert('Labels',$data);
		return $this->db->insert_id();
	}

	public function add_textinput($data){
		$this->db->insert('Texts',$data);
		return $this->db->insert_id();
	}

	public function add_button($data){
		$this->db->insert('Buttons',$data);
		return $this->db->insert_id();
	}

	public function add_question($data){
		$this->db->insert('Questions',$data);
		return $this->db->insert_id();
	}

	public function add_input($data){
		$this->db->insert('Inputs',$data);
		return $this->db->insert_id();
	}

	public function add_text($data){
		$this->db->insert('Texts',$data);
		return $this->db->insert_id();
	}

	public function add_radio($data){
		$this->db->insert('Radios',$data);
		return $this->db->insert_id();
	}

	public function add_checkbox($data){
		$this->db->insert('Checkboxes',$data);
		return $this->db->insert_id();
	}

	public function add_dropdown($data){
		$this->db->insert('Dropdowns',$data);
		return $this->db->insert_id();
	}

	public function add_slider($data){
		$this->db->insert('Sliders',$data);
		return $this->db->insert_id();
	}

}