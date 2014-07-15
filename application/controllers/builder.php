<?php

class Builder extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('experiment_model', 'experiment');
		$this->load->model('builder_model', 'builder');
		$this->load->model('faculty_model', 'faculty');
		$this->load->model('graduate_model', 'graduate');
	}

	/* REST Methods */
	public function edit($role = NULL, $username = NULL, $eid = 0){
		/* You can use the $role and $username variables for authorization purposes*/
		$researcher_info = $this->user_model->get_researcher($role, $username);
		$data['researcher'] = $researcher_info[0];
		$data['experiment'] = $this->experiment->get($role, $researcher_info[1], $eid);
		$data['pages'] = $this->get_all_pages($eid);
		$data['var'] = $this->get_all_objects($eid);
		$data['title'] = 'Experiment';
		$data['main_content'] = 'builder/workspace';
		$this->load->view('builder/layout', $data);
	}

	public function view($eid = 0, $slug = NULL){
		if($this->is_agreed()){
			$data['eid'] = $eid;
			$data['slug'] = $slug;
			$data['experiment'] = $this->builder->get($eid);
			$data['pages'] = $this->builder->get_all_pages($eid);
			$data['var'] = $this->builder->get_all_objects($eid);
			$data['title'] = "Respond";
			$data['main_content'] = "respondent/workspace.php";
			$this->load->view('respondent/_presentation_layout', $data);
		}
		else{
			redirect("respond/{$eid}/{$slug}/terms");
		}
	}
	/* End of REST Methods */

	public function save() {
		$message = $this->input->post('msg');
		if ($message == 'false')
			return;
		
		/* page */
		$eid = $this->input->post('eid');
		$this->delete($eid);
		$pid_list = array();
		$page['eid'] = $eid;
		$total_pages = array_shift($message);

		for($index=1; $index <= $total_pages; $index++){
			$page['eid'] = $eid;
			$page['order'] = $index;
			array_push($pid_list, $this->add_page($page));
		}

		/* object */
		foreach ($message as $item){
			$order = (int)substr($item['id'], 4);
			$object['pid'] = $pid_list[$order-1];
			$object['x_pos'] = (double)$item['xPos'];
			$object['y_pos'] = (double)$item['yPos'];
			$object['type'] = $item['type'];
			
			if($object['type'] != "dropdown" && $object['type'] != "slider"){
				$object['width'] = (double)substr($item['width'],0, -2);
				$object['height'] = (double)substr($item['height'],0, -2);				
			}

			else{
				$object['width'] = 0;
				$object['height'] = 0;
			}

			$oid = $this->add_object($object);

			/* question */
			if ($object['type'] == "question"){
				$label['oid'] = $oid;
				$label['text'] = $item['text'];
				$label['font_color'] = substr($item['color'],1);
				$label_id = $this->add_label($label);

				$question['oid'] = $oid;
				$question['is_required'] = 'f';
				$question['label'] = $label_id;

				$qid = $this->add_question($question);
			}

			/* textinput */ 
			if ($object['type'] == "textinput"){
				$input_id = $this->save_input($oid, 'textinput');

				$textinput['input_id'] = $input_id;
				$textinput_id = $this->add_textinput($textinput);
				$this->bind($object['pid'], $input_id);
			}

			/* button */
			if ($object['type'] == "button"){
				$button['oid'] = $oid;
				$button['text'] = $item['text'];
				$button_id = $this->add_button($button);
			}

			/* radio */
			if ($object['type'] == "radio"){
				$input_id = $this->save_input($oid, 'radio');
				$radio['input_id'] = $input_id;
				$radio['choices'] = $item['text'];

				$radio_id = $this->add_radio($radio);
				$this->bind($object['pid'], $input_id);
			}
			
			/* checkbox */
			if ($object['type'] == "checkbox"){
				$input_id = $this->save_input($oid, 'checkbox');
				$checkbox['input_id'] = $input_id;
				$checkbox['choices'] = $item['text'];

				$checkbox_id = $this->add_checkbox($checkbox);
				$this->bind($object['pid'], $input_id);
			}

			/* slider */
			if ($object['type'] == "slider"){
				$input_id = $this->save_input($oid, 'slider');
				$slider['input_id'] = $input_id;

				$slider['min_num'] = (int)$item['min'];
				$slider['max_num'] = (int)$item['max'];

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

	/* bind an input with a question */
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
		return $this->add_input($input);		
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

	private function is_agreed(){
		return $this->session->userdata('agreed');
	}
}