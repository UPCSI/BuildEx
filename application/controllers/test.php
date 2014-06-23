<?php

class Test extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model','admin');
		$this->load->model('faculty_model','faculty');
		$this->load->model('graduate_model','graduate');
	}

	public function confirm_type(){
		$a = $this->admin->all();
		echo gettype($a);
	}

	public function add_user(){
		$user_info['username'] = 'test_user1';
		$user_info['password'] = 'password';
		$user_info['first_name'] = 'user_first';
		$user_info['middle_name'] = 'user_middle';
		$user_info['last_name'] = 'user_last';
		$user_info['email_ad'] = 'user_email';
		$this->user_model->create($user_info);
	}

	public function delete_user(){
		$username = 'buildex.admin';
		$status = $this->user_model->destroy(0, $username);
		echo '<pre>';
		echo 'Faculty deleted!';
		echo 'Status: '.$status;
		echo '</pre>';
	}

	public function add_admin(){
		$user_info['username'] = 'admin';
		$user_info['password'] = 'password';
		$user_info['first_name'] = 'Sigmund';
		$user_info['middle_name'] = 'Schlomo';
		$user_info['last_name'] = 'Freud';
		$user_info['email_ad'] = 'buildex.admin@test.com';
		$uid = $this->user_model->create($user_info);
		$user = $this->user_model->get($uid, NULL);
		$aid = $this->admin->create($user->username);
		echo '<pre>';
		echo 'Admin added!';
		echo 'aid: '.$aid;
		echo '</pre>';
	}

	public function add_faculty(){
		$user_info['username'] = 'ppzuniga';
		$user_info['password'] = 'password';
		$user_info['first_name'] = 'Philip';
		$user_info['middle_name'] = 'Zuniga';
		$user_info['last_name'] = 'Zuniga';
		$user_info['email_ad'] = 'pzzuniga@test.com';
		$faculty_id = 199700001;
		$this->faculty->create($user_info, $faculty_id);
		echo '<pre>';
		echo 'Faculty added!';
		echo '</pre>';
	}

	public function add_graduate(){
		$user_info['username'] = 'moshen';
		$user_info['password'] = 'password';
		$user_info['first_name'] = 'Mara';
		$user_info['middle_name'] = 'Mara';
		$user_info['last_name'] = 'Shen';
		$user_info['email_ad'] = 'moshen@test.com';
		$student_id = 20110002;
		$this->graduate->create($user_info, $student_id);
		echo '<pre>';
		echo 'Graduate added!';
		echo '</pre>';
	}


	public function get_faculty(){
		$username = 'mtcarreon';
		$data = $this->faculty_model->get_faculty_profile($username);
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}

	public function delete_faculty(){
		$username = 'mtcarreon';
		$status = $this->faculty_model->delete_faculty($username);
		echo '<pre>';
		echo 'Faculty deleted!';
		echo 'Status: '.$status;
		echo '</pre>';	
	}

	
	public function delete_graduate(){
		$username = 'ebbernardino';
		$this->graduates_model->delete_graduate($username);
		echo '<pre>';
		echo 'Graduate deleted!';
		echo '</pre>';
	}

	public function get_graduate(){
		$username = 'ebbernardino';
		$data = $this->graduates_model->get_graduate_profile($username);
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}

	public function add_experiment(){
		$info['title'] = 'My fucking experiment.';
		$info['category'] = 'Fucking experiment';
		$info['target_count'] = 50;
		$uid = 3;
		$this->experiments_model->add_experiment($uid,$info);
		echo '<pre>';
		echo 'Experiment added!';
		echo '</pre>';
	}

	public function delete_experiment(){
		$uid = 3;
		$eid = 2;
		$a = $this->experiments_model->delete_experiment($uid,$eid);
		echo '<pre>';
		echo 'Experiment deleted!';
		var_dump($a);
		echo '</pre>';
	}

	public function get_experiment(){
		$uid = 3;
		$eid = 3;
		$data = $this->experiments_model->get_experiment($uid,$eid);
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}

	
	public function answer_experiment(){
		$info['first_name'] = 'Rajesh';
		$info['middle_name'] = 'Pakshet';
		$info['last_name'] = 'Koothrappali';
		$uid = 3;
		$eid = 3;
		$this->respondents_model->add_respondent($info,$eid);
		$this->experiments_model->increment_count($uid,$eid);
		echo '<pre>';
		echo 'Experiment answered!';
		echo '</pre>';
	}

	
	public function delete_respondent(){
		$rid = 4;
		$eid = 3;
		$a = $this->respondents_model->delete_respondent($eid,$rid);
		echo '<pre>';
		echo 'Respondent deleted!';
		var_dump($a);
		echo '</pre>';
	}

	public function get_respondent(){
		$rid = 2;
		$res = $this->respondents_model->get_respondent($rid);
		echo '<pre>';
		echo 'Respondent: ';
		var_dump($res);
		echo '</pre>';
	}
}