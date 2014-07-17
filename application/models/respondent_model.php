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
		$this->db->select('*');
		$this->db->where('rid',$rid);
		$q = $this->db->get('Respondents');
		return $this->query_row_conversion($q);
	}

	public function all(){
		$this->db->join('Experiments', 'Experiments.eid = Respondents.eid');
		$q = $this->db->get('Respondents');
		return $this->query_conversion($q);
	}

	public function destroy($eid = 0, $rid = 0){
		$this->db->where('rid',$rid);
		$this->db->delete('Respondents');
		
		if($this->db->affected_rows() == 0){
			return false;
		}

		$this->experiments_model->decrement_count($eid);
		return true;
	}
	/* End of CRUD */

	public function get_respondents($eid){
		$this->db->where('eid',$eid);
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
}
