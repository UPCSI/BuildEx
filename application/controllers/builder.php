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
		$data['pages'] = $this->get_all_pages($eid);
		$data['var'] = $this->get_all_objects($eid);


		// var_dump($data['var']);
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
		
		$eid = $this->input->post('eid');
		$this->delete($eid);
		$pid_list = array();
		// $radio_list = array();

		/* page */
		$page['eid'] = $this->input->post('eid');
		$this->delete($page['eid']);
		$total_pages = array_shift($message);

		for($index=1; $index <= $total_pages; $index++){
			$page['eid'] = $eid;
			$page['order'] = $index;
			array_push($pid_list, $this->add_page($page));
		}

		/* object */
		foreach ($message as $item){
			$order = (int)substr($item[0], 4);
			$object['pid'] = $pid_list[$order-1];
			$object['x_pos'] = (double)$item[1];
			$object['y_pos'] = (double)$item[2];
			$object['type'] = $item[3];

			if($object['type'] == "textinput"){
				$object['width'] = $item[4];
				$object['height'] = $item[5];				
			}

			else if(isset($item[5]) && isset($item[6])){			
				$object['width'] = $item[5];
				$object['height'] = $item[6];
				$object['width'] = (double)substr($object['width'],0, -2);
				$object['height'] = (double)substr($object['height'],0, -2);
			}

			
			$oid = $this->add_object($object);

			/* question */
			if ($object['type'] == "question"){
				$label['oid'] = $oid;
				$label['text'] = $item[4];
				// $label['font'] = ;
				// $label['font_size'] = ;
				// $label['font_color'] = ;

				$label_id = $this->add_label($label);

				$question['oid'] = $oid;
				$question['is_required'] = 'f';
				// $question['input'] = ;
				$question['label'] = $label_id;

				$qid = $this->add_question($question);
			}

			/* textinput */
			if ($object['type'] == "textinput"){
				$this->session->set_userdata('truee');
				$input_id = $this->save_input($oid, 'textinput');

				$textinput['input_id'] = $input_id;
				// $textinput['length'] = ;
				// $textinput['orientation'] = ;

				$textinput_id = $this->add_textinput($textinput);
				$this->bind($object['pid'], $input_id);
			}

			/* button */
			if ($object['type'] == "button"){
				$button['oid'] = $oid;
				$button['text'] = $item[4];
				// $button['go_to'] = ;
				// $button['type'] = ;

				$button_id = $this->add_button($button);
			}

			/* radio */
			if ($object['type'] == "radio"){
				$input_id = $this->save_input($oid, 'radio');
				$radio['input_id'] = $input_id;
				$radio['choices'] = $item[4];
				// $radio['orientation'] = ;

				$radio_id = $this->add_radio($radio);
				$this->bind($object['pid'], $input_id);
			}
			
			/* checkbox */
			if ($object['type'] == "checkbox"){
				$input_id = $this->save_input($oid, 'checkbox');
				$checkbox['input_id'] = $input_id;
				$checkbox['choices'] = $item[4];
				// $checkbox['orientation'] = ;

				$checkbox_id = $this->add_checkbox($checkbox);
				$this->bind($object['pid'], $input_id);
			}


			/* slider */
			if ($object['type'] == "slider"){
				$this->session->set_userdata('fsd');
				$input_id = $this->save_input($oid, 'slider');
				$slider['input_id'] = $input_id;
// 				$slider['type'] = ;
				$slider['min_num'] = (int)$item[4];
				$slider['max_num'] = (int)$item[5];

				$slider_id = $this->add_slider($slider);
				$this->bind($object['pid'], $input_id);
			}


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

	public function bind($pid, $input_id){
		$this->load->model('builder_model');
		$this->builder_model->bind($pid, $input_id);
	}

	public function get_all_pages($eid){
		$this->load->model('builder_model');
		return $this->builder_model->get_all_pages($eid);
	}

	public function save_input($oid, $type){
		$input['oid'] = $oid;
		$input['type'] = $type;
		// $input['helper'] = ;
		return $this->add_input($input);		
	}

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

	public function add_textinput($data){
		$this->load->model('builder_model');
		return $this->builder_model->add_textinput($data);
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