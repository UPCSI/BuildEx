<?php

class Builder extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function form($eid = 0){
		$data['title'] = 'Experiment';
		$data['eid'] = $eid;
		$data['main_content'] = 'builder/form_maker';
		$this->load->view('builder/_maker_layout',$data);
	}

	public function app($eid = 0){
		/*this is the index of the app
		* for the reason that we need the eid
		* of the experiment for the app
		* and it's not trivial to pass a variable
		* from view to the controller index.
		*/

		$data['title'] = 'Experiment';
		$data['eid'] = $eid;
		$data['var'] = $this->get_all_objects($eid);

		$data['main_content'] = 'builder/workspace';
		$this->load->view('builder/layout', $data);
	}

/*
	------------------------------------------------------------------------------------
	SAVE
	------------------------------------------------------------------------------------
*/

	public function save() {
		$message = $this->input->post('msg');
		if ($message == 'false')
			return;

		/* page */
		$page['eid'] = $this->input->post('eid');
		$this->delete($page['eid']);
		$page['order'] = 1;

		/* object */
		$object['pid'] = $this->add_page($page);		
		foreach ($message as $item){
			$object['x_pos'] = (double)$item[0];
			$object['y_pos'] = (double)$item[1];
			$object['type'] = $item[2];
			// $object['width'] = $item[];
			// $object['height'] = $item[];
			$oid = $this->add_object($object);

			/* label */
			if ($object['type'] == "label" || $object['type'] == "question"){
				$label['oid'] = $oid;
				$label['text'] = $item[3];
				// $label['font'] = ;
				// $label['font_size'] = ;
				// $label['font_color'] = ;

				$label_id = $this->add_label($label);
			}

			/* question */
			if ($object['type'] == "question"){
				$question['oid'] = $oid;
				$question['is_required'] = 'f';
				// $question['input'] = ;
				$question['label'] = $label_id;

				$qid = $this->add_question($question);
			}

			/* button */
			if ($object['type'] == "button"){
				$button['oid'] = $oid;
				$button['text'] = $item[3];
				// $button['go_to'] = ;
				// $button['type'] = ;

				$button_id = $this->add_button($button);
			}

			// /* radio */
			// if ($object['type'] == "radio" || $object['type'] == "radio"){
			// 	$input['oid'] = $oid;
			// 	$input['text'] = $item[3];
			// 	// $input['go_to'] = ;
			// 	// $input['type'] = ;

			// 	$input_id = $this->add_input($input);
			// }
		}

		echo $this->session->userdata('active_role'); #for ajax
	}

	public function delete($eid){
		$this->load->model('builder_model');
		$this->builder_model->delete($eid);
	}

	public function get_all_objects($eid){
		$this->load->model('builder_model');
		return $this->builder_model->get_all_objects($eid);
	}

/*
	------------------------------------------------------------------------------------
	ADD TO TABLES
	------------------------------------------------------------------------------------
*/

	public function add_page($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_page($data);
	}

	public function add_object($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_object($data);
	}

	public function add_label($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_label($data);
	}

	public function add_button($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_button($data);
	}

	public function add_question($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_question($data);
	}

	public function add_input($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_input($data);
	}

	public function add_text($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_text($data);
	}

	public function add_radio($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_radio($data);
	}

	public function add_checkbox($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_checkbox($data);
	}

	public function add_dropdown($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_dropdown($data);
	}

	public function add_slider($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_slider($data);
	}

}