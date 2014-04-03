<?php

class Respond extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiments_model');
		$this->load->model('builder_model');
		$this->load->model('faculty_model');
		$this->load->model('graduates_model');
		$this->load->model('users_model');
		$this->load->model('respondents_model');
	}

	public function view($hash){
		$exp = $this->experiments_model->get_experiment_by_hash($hash); //experiment with given url(hash)
		
		if (is_null($exp)){
			echo "Error 404: Page not found"; //handle this error
			return 0;
		}

		$id = $this->faculty_model->get_faculty_by_experiment($exp->eid);
		
		if(is_null($id)){
			$id = $this->graduates_model->get_graduate_by_experiment($exp->eid);
			$author = $this->graduates_model->get_graduate_profile($id->gid,null);
		}
		else{
			$author = $this->faculty_model->get_faculty_profile($id->fid,null);
		}
		$data['eid'] = $exp->eid;
		$data['slug'] = $this->experiments_model->generate_slug($exp->title);
		$data['title'] = 'Respond';
		$data['experiment'] = $exp->title;
		$data['description'] = $exp->description;
		$data['author'] = strtoupper($author->last_name).', '.ucwords($author->first_name);
		$data['main_content'] = 'respondent/view';
		$this->load->view('respondent/_view_layout', $data);
	}

	public function agree(){
		$eid = $this->input->post('eid');
		$slug = $this->input->post('slug');
		$this->session->set_userdata('respond_to',+$eid);
		$this->session->set_userdata('slug',$slug);
		redirect('respond/fill_up');
	}

	public function fill_up(){
		$data['title'] = 'Respond';
		$data['main_content'] = 'respondent/fill_up';
		$this->load->view('respondent/_view_layout', $data);
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

		$rid = $this->respondents_model->add_respondent($info,$eid);
		$this->session->set_userdata('rid',$rid);
		$slug = $this->session->userdata('slug');
		redirect('respond/exp/'.$slug);
	}

	public function exp($slug){
		/*slide show of the experiment*/
		$eid = $this->session->userdata('respond_to');
		$data['exp'] = $this->experiments_model->get_experiment($eid);
		$data['var'] = $this->get_objects($eid);
		$data['title'] = "Respond";
		$data['main_content'] = "respondent/exp";
		$this->load->view('respondent/_view_layout', $data);
	}

	
	public function leave(){
		return 0;
	}

	public function save(){
		return 0;
	}

	public function save_all(){
		$eid = $this->input->post('eid');
		/*
		save the answers here
		*/
		echo "Save success!";
	}

	public function pause(){
		$eid = $this->input->post('eid');
		/* not a priority */
	}

	private function get_objects($eid = 0){
		//returns all the objects for the experiment with eid = $eid
		return 0;
	}
}