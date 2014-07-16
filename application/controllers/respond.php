<?php

class Respond extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiment_model');
		$this->load->model('builder_model');
		$this->load->model('faculty_model');
		$this->load->model('graduate_model');
		$this->load->model('user_model');
		$this->load->model('respondent_model');
		$this->load->model('builder_model');
	}

	public function view($hash){
		$exp = $this->experiment_model->get_experiment_by_hash($hash); //experiment with given url(hash)
		
		if (is_null($exp)){
			echo "Error 404: Page not found"; //handle this error
			return 0;
		}

		$id = $this->faculty_model->get_faculty_by_experiment($exp->eid);
		
		if(is_null($id)){
			$id = $this->graduate_model->get_graduate_by_experiment($exp->eid);
			$author = $this->graduate_model->get_graduate_profile($id->gid,null);
		}
		else{
			$author = $this->faculty_model->get_faculty_profile($id->fid,null);
		}
		$data['eid'] = $exp->eid;
		$data['slug'] = $this->experiment_model->generate_slug($exp->title);
		$data['experiment'] = $exp->title;
		$data['description'] = $exp->description;
		$data['author'] = strtoupper($author->last_name).', '.ucwords($author->first_name);
		
		$data['title'] = 'Respond';
		$data['main_content'] = 'respondent/index';
		$data['page'] = 'view';
		$this->load->view('respondent/view_layout', $data);
	}

	public function agree(){
		$eid = $this->input->post('eid');
		$slug = $this->input->post('slug');
		$this->session->set_userdata('respond_to',$eid);
		$this->session->set_userdata('slug',$slug);
		redirect('respond/fill_up');
	}

	public function fill_up(){
		$data['title'] = 'Respond';
		$data['main_content'] = 'respondent/index';
		$data['page'] = 'fill_up';
		$this->load->view('respondent/view_layout', $data);
	}

	public function register(){
		$eid = $this->session->userdata('respond_to');
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

		$rid = $this->respondent_model->add_respondent($info,$eid);
		$this->session->set_userdata('rid',$rid);
		$slug = $this->session->userdata('slug');
		redirect('respond/exp/'.$slug);
	}

	public function exp($slug){
		/*slide show of the experiment*/
		$eid = $this->session->userdata('respond_to');
		$data['eid'] = $eid;
		$data['slug'] = $slug;
		$data['exp'] = $this->experiment_model->get_experiment($eid);
		$data['pages'] = $this->builder_model->get_all_pages($eid);
		$data['var'] = $this->builder_model->get_all_objects($eid);
		$data['title'] = "Respond";
		$data['main_content'] = "respondent/workspace.php";
		$this->load->view('respondent/_presentation_layout', $data);
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

	public function debrief($slug){
		/*shows the page after the last one*/
		/*to debrief the user and to confirm his inputs just in case*/
		$eid = $this->session->userdata('respond_to');
		$exp = $this->experiment_model->get_experiment($eid);
		$id = $this->faculty_model->get_faculty_by_experiment($eid);
		
		if(is_null($id)){
			$id = $this->graduate_model->get_graduate_by_experiment($eid);
			$author = $this->graduate_model->get_graduate_profile($id->gid,null);
		}
		else{
			$author = $this->faculty_model->get_faculty_profile($id->fid,null);
		}

		$data['experiment'] = $exp->title;
		$data['description'] = $exp->description;
		$data['author'] = strtoupper($author->last_name).', '.ucwords($author->first_name);
		$data['title'] = 'Respond';
		$data['main_content'] = 'respondent/debrief';
		$this->load->view('respondent/_presentation_layout', $data);
	}

	public function submit(){
		$eid = $this->session->userdata('respond_to');
		
		if(!$this->experiment_model->increment_count($eid)){
			var_dump('error!');//go to error page
			return 0;
		}
		/* last call before exiting */

		/*perform form validations*/ //not priority
		redirect('respond/complete');
	}

	public function complete(){
		$this->session->unset_userdata('rid');
		$this->session->unset_userdata('respond_to');
		$this->session->unset_userdata('eid');

		$data['title'] = 'Complete';
		$data['main_content'] = 'respondent/complete';
		$this->load->view('respondent/view_layout', $data);
	
		//when saving to db, add completed experiment = true
	}

	public function leave(){
		$this->session->unset_userdata('rid');
		$this->session->unset_userdata('respond_to');
		$this->session->unset_userdata('eid');

		$data['title'] = 'Good Bye';
		$data['main_content'] = 'respondent/leave';
		$this->load->view('respondent/view_layout', $data);
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