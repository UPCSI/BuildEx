<?php

class Respondents extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiment_model', 'experiment');
		$this->load->model('builder_model', 'builder');
		$this->load->model('faculty_model', 'faculty');
		$this->load->model('graduate_model', 'graduate');
		$this->load->model('respondent_model', 'respondent');
	}

	/* REST Methods */
	public function add($eid = 0, $slug = NULL){
		$data['experiment'] = $this->builder->get($eid);
		$data['title'] = 'Respond';
		$data['main_content'] = 'respondent/index';
		$data['page'] = 'add';
		$this->load->view('main_layout', $data);
	}

	public function create($eid = 0, $slug = NULL){
		$info = array('first_name' => $this->input->post('first_name'),
									'middle_name' => $this->input->post('middle_name'),
									'last_name' => $this->input->post('last_name'),
									'age' => +$this->input->post('age'),
									'email_ad' => $this->input->post('email'),
									'address' => $this->input->post('address'),
									'nationality' => $this->input->post('nationality'),
									'civil_status' => +$this->input->post('civil_status'),
									'gender' => $this->input->post('gender'));

		$info['ip_addr'] = $this->session->userdata('ip_address');
		$info['user_agent'] = $this->session->userdata('user_agent');
		$rid = $this->respondent->create($eid, $info);
		$this->session->set_userdata('rid', $rid);
		redirect("respond/{$eid}/{$slug}");
	}

	public function destroy($eid = 0){
		$rid = $this->input->post('respondent_id');
		if($this->respondent->destroy($eid, $rid)){
			$msg = 'You have successfully deleted a respondent!';
		}
		else{
			$msg = 'Error deleting respondent.';
		}
		$this->session->set_flashdata('notification', $msg);
		redirect("admin/respondents");
	}
	/* End of REST Methods */

	public function agree($eid = 0, $slug = NULL){
		$eid = $this->input->post('eid');
		$this->session->set_userdata('agreed', TRUE);
		redirect("respond/{$eid}/{$slug}/add");
	}

	public function terms($eid = 0, $slug = NULL){
		$experiment = $this->builder->get($eid);
		if(is_null($experiment)){
		 	show_404();
		}
		else{
			$data['experiment'] = $experiment;
			$data['researcher'] = $this->experiment->get_researcher($experiment->eid);
			$data['title'] = 'Respond';
			$data['main_content'] = 'respondent/index';
			$data['page'] = 'terms';
			$this->load->view('main_layout', $data);
		}
	}

	public function save(){ //$rid,$qid
		$message = $this->input->post('msg');
		$rid = $this->session->userdata('rid');
		$total_pages = array_shift($message);
		$time = array_shift($message);
		$responses = array();

		foreach($message as $item){
			$answer = array();
			$answer['rid'] = $rid;
			$answer['qid'] = $item['qid'];
			$answer['duration'] = $time[$item['page']-1];

			if($item['type'] == "text_input"){
				$answer['answer'] = $item['text'];
			}

			else if($item['type'] == "radio" || $item['type'] == "checkbox"){
				if($item['checked'] == "true"){
					$answer['answer'] = $item['text'];
				}
				else{
					continue;
				}
			}

			else if($item['type'] == "dropdown"){
				$answer['answer'] = $item['selected'];
			}

			else if($item['type'] == "slider"){
				$answer['answer'] = $item['value'];
			}

			array_push($responses, $answer);
		}

		$this->respondent_model->save_responses($responses);
	}

	public function debrief($eid = 0, $slug = NULL){
		$data['experiment'] = $this->builder->get($eid);
		$data['researcher'] = $this->experiment->get_researcher($eid);
		$data['title'] = 'Respond';
		$data['main_content'] = 'respondent/index';
		$data['page'] = 'debrief';
		$this->load->view('main_layout', $data);
	}

	public function submit($eid = 0, $slug = NULL){
		$eid = $this->input->post('experiment_id');
		
		if(!$this->experiment->increment_count($eid)){
			var_dump('error!');
			return 0;
		}
		redirect("respond/{$eid}/{$slug}/complete");
	}

	public function complete(){
		$this->session->unset_userdata('rid');
		$this->session->unset_userdata('respond_to');
		$this->session->unset_userdata('agreed');

		$data['title'] = 'Complete';
		$data['main_content'] = 'respondent/index';
		$data['page'] = 'complete';
		$this->load->view('main_layout', $data);
		//when saving to db, add completed experiment = true
	}

	public function leave(){
		$this->session->unset_userdata('rid');
		$this->session->unset_userdata('respond_to');
		$this->session->unset_userdata('agreed');

		$data['title'] = 'Good Bye';
		$data['main_content'] = 'respondent/index';
		$data['page'] = 'leave';
		$this->load->view('main_layout', $data);
	}

	public function interrupted(){
		// $eid = $this->input->post('eid');

		//save to db the state of exp if completed or not
		$message = $this->input->post('done');
		
		/* not a priority */
	}

	public function all($eid = 0){
		if($eid == 0){

		}
		else{
			
		}
	}
}