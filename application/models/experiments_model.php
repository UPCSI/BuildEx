<?php

class Experiments_model extends MY_Model{

	public function add_experiment($uid = 0, $info = null){
		$this->db->insert('Experiments',$info);
		$conduct_info['uid'] = $uid;
		$conduct_info['eid'] = $this->db->insert_id();
		$conduct_info['since'] = date("Y-m-d H:i:s");
		$this->db->insert('conduct',$conduct_info);
	}

	public function delete_experiment($uid = 0, $eid = 0){
		$this->db->join('Users','Users.uid = conduct.uid');
		$this->db->join('conduct','conduct.eid = Experiments.eid');
		$this->db->where('Experiments.eid',$eid);
		$this->db->where('Users.uid',$uid);
		return $this->db->delete('Experiments');
	}

	public function update_count($uid = 0, $eid = 0){
		$this->db->join('Users','Users.uid = conduct.uid');
		$this->db->join('conduct','conduct.eid = Experiments.eid');
		$this->db->where('Experiments.eid',$eid);
		$this->db->where('Users.uid',$uid);
		$this->db->set('Experiments.current_count','current_count+1',FALSE);
		$this->db->update('Experiments');
	}

	public function get_experiment($uid = 0, $eid = 0){
		$this->db->select('*');
		$this->db->join('Users','Users.uid = conduct.uid');
		$this->db->join('conduct','conduct.eid = Experiments.eid');
		$this->db->where('Experiments.eid',$eid);
		$this->db->where('Users.uid',$uid);
		$q = $this->db->get('Experiments');

		return $this->query_row_conversion($q);
	}

	public function is_complete($uid = 0,$eid = 0){
		$experiment = $this->get_experiment($uid, $eid);
		if(isset($experiment)){
			if($experiment->status == 'true'){
				return true;
			}
		}
		return false;
	}

	public function get_users_experiments($uid = 0, $category = null){
		/*
		* returns all user's experiments by default. 
		* If category is specified, it will filter it further.
		*/
		$this->db->select('*');
		$this->db->join('Users','Users.uid = conduct.uid');
		$this->db->join('conduct','conduct.eid = Experiments.eid');
		$this->db->where('Users.uid',$uid);
		if(isset($category)){
			$this->db->where('Experiments.category',$category);
		}

		$q = $this->db->get('Experiments');

		return $this->db->query_conversion($q);
	}

	/*
	* NOTE: Not sure whether to implement these methods
	public function get_users_active_experiments($uid = 0){
		return true;
	}

	public function get_users_inactive_experiments($uid = 0){
		return true
	}*/

	/* Admin Functionalities */
	public function get_all_experiments(){
		$this->db->select('*');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function get_all_active_experiments(){
		$this->db->select('*');
		$this->db->where('status','true');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function get_all_inactive_experiments(){
		$this->db->select('*');
		$this->db->where('status','false');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}
}