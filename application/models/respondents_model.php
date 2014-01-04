<?php

class Respondents_model extends MY_Model{
	public function add_respondent($info,$eid){
		$this->db->insert('Respondents',$info);
		$answer_info['rid'] = $this->db->insert_id();
		$answer_info['eid'] = $eid;
		$answer_info['since'] = date("Y-m-d H:i:s");
		$this->db->insert('answer',$answer_info);
	}

	public function delete_respondent($eid, $rid){
		$this->load->model('experiments_model');
		$q = "DELETE FROM \"Respondents\" AS r
			  USING \"Experiments\" AS e, answer AS a
			  WHERE e.eid = a.eid AND
			  r.rid = a.rid AND
			  r.rid = ? AND
			  e.eid = ?";

		$this->db->query($q,array($rid,$eid));

		if($this->db->affected_rows()==0){
			return false;
		}

		$this->experiments_model->decrement_count($eid);
		return true;
	}

	public function get_respondent($rid = 0){
		$this->db->select('*');
		$this->db->where('rid',$rid);
		$q = $this->db->get('Respondents');
		return $this->query_row_conversion($q);
	}

	public function get_all_respondents(){
		$q = $this->db->get('Respondents');
		return $this->query_conversion($q);
	}
}