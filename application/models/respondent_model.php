<?php

class Respondent_model extends MY_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('experiment_model', 'experiment');
	}

	/* CRUD Methods */
	public function create($eid = 0, $info = NULL){
		$info['eid'] = $eid; 
		$this->db->insert('Respondents', $info);
		return $this->db->insert_id();
	}

	public function get($rid = 0){
		$this->db->where('rid', $rid);
		$q = $this->db->get('Respondents');
		return $this->query_row_conversion($q);
	}

	public function all(){
		$all = array();
		$faculty_respondents = $this->all_faculty_respondents();
		$graduates_respondents = $this->all_graduate_respondents();

		if(isset($faculty_respondents)){
			$all = array_merge($all, $faculty_respondents);
		}

		if(isset($graduates_respondents)){
			$all = array_merge($all, $graduates_respondents);
		}

		if(empty($all)){
			return NULL;
		}

		return $all;
	}

	public function destroy($eid = 0, $rid = 0){
		$this->db->where('rid', $rid);
		$this->db->where('eid', $eid);
		$this->db->delete('Respondents');
		
		if(!$this->is_rows_affected()){
			return false;
		}

		$this->experiment_model->decrement_count($eid);
		return true;
	}
	/* End of CRUD */

	public function all_faculty_respondents(){
		$this->db->select('Experiments.*, Users.*, Respondents.*, Faculty.*');
		$this->db->select('faculty_conduct.since AS conduct_since', FALSE);
		$this->db->join('Experiments', 'Experiments.eid = Respondents.eid');
		$this->db->join('faculty_conduct', 'faculty_conduct.eid = Experiments.eid');
		$this->db->join('Faculty', 'Faculty.fid = faculty_conduct.fid');
		$this->db->join('Users', 'Users.uid = Faculty.uid');
		$q = $this->db->get('Respondents');
		return $this->query_conversion($q);
	}

	public function all_graduate_respondents(){
		$this->db->select('Experiments.*, Users.*, Respondents.*, Graduates.*');
		$this->db->select('graduates_conduct.since AS conduct_since', FALSE);
		$this->db->join('Experiments', 'Experiments.eid = Respondents.eid');
		$this->db->join('graduates_conduct', 'graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates', 'Graduates.gid = graduates_conduct.gid');
		$this->db->join('Users', 'Users.uid = Graduates.uid');
		$q = $this->db->get('Respondents');
		return $this->query_conversion($q);	
	}

	public function add_response($info,$qid,$rid){
		$info['rid'] = $rid;
		$info['qid'] = $qid;
		$this->db->insert('Responses',$info);
		return $this->db->insert_id();
	}

	public function save_responses($responses){
		foreach($responses as $response){
			$this->db->insert('Responses',$response);
		}
	}

	public function get_responses($rid){
		$this->db->where('rid', $rid);
		$q = $this->db->get('Responses');
		return $this->query_conversion($q);
	}

	public function get_respondents($eid){
		$this->db->where('eid', $eid);
		$q = $this->db->get('Respondents');
		return $this->query_conversion($q);
	}
}
