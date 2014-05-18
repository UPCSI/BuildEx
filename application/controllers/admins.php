<?php

class Admins extends User_Controller{

	public function __construct(){
		parent::__construct();
		$this->role = 'admin';
	}

	public function laboratories(){
		$data['laboratories'] = $this->get_laboratories_list();
		$data['title'] = 'Admin';
		$data['main_content'] = 'users/index';
		$data['page'] = "laboratories";
		$data['notification'] = $this->session->flashdata('notification');
		$this->load->view('main_layout',$data);
	}

	public function faculty(){
		$data['faculty'] = $this->get_faculty_list();
		$data['requests'] = $this->get_faculty_account_requests();
		$data['title'] = 'Admin';
		$data['main_content'] = 'users/index';
		$data['page'] = 'faculty';
		$data['notification'] = $this->session->flashdata('notification');
		if(!$data['notification']){
			$data['notification'] = null;
		}
		$this->load->view('main_layout',$data);
	}

	public function graduates(){
		$data['graduates'] = $this->get_graduate_list();
		$data['title'] = 'Admin';
		$data['main_content'] = 'users/index';
		$data['page'] = 'graduates';
		$this->load->view('main_layout',$data);
	}

	/* REST Methods */
	public function add(){
		return 0;
	}

	public function create(){
		return 0;
	}

	public function edit($uid = 0, $aid = 0){
		$data['title'] = 'Profile';
		$data['user_profile'] = $this->users_model->get_user_profile($uid);
		$data['admin_profile'] = $this->admins_model->get_admin_profile($aid);
		$data['main_content'] = 'users/indexofile';
		$data['experiments'] = -1;
		$this->load->view('main_layout', $data);
	}

	public function update(){
		return 0;
	}

	public function destroy(){
		return 0;
	}
	/* End of REST Methods */

	private function get_admin_list(){
		$this->load->model('admin_model','admin');
		return $this->admin->get_all_admins();
	}

	private function get_faculty_list(){
		$this->load->model('faculty_model','faculty');
		return $this->faculty->get_all_faculty();
	}

	private function get_faculty_account_requests(){
		$this->load->model('faculty_model','faculty');
		return $this->faculty->get_all_account_requests();
	}

	private function get_graduate_list(){
		$this->load->model('graduate_model','graduate');
		return $this->graduate->get_all_graduates();
	}

	private function get_respondent_list(){
		$this->load->model('respondent_model','respondent');
		return $this->respondent->get_all_respondents();
	}

	private function get_laboratories_list(){
		$this->load->model('laboratory_model','laboratory');
		return $this->laboratory->get_all_laboratories();
	}
}