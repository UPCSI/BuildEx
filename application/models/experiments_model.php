<?php

class Experiments_model extends MY_Model{

	public function add_experiment($uid = 0,$info = null){
		/*
		* Inserts the experiment to the database
		* Returns the eid of that specific experiment.
		*/
		$this->db->insert('Experiments',$info);
		$conduct_info['uid'] = $uid;
		$conduct_info['eid'] = $this->db->insert_id();
		$conduct_info['since'] = date("Y-m-d H:i:s");
		$this->db->insert('conduct',$conduct_info);
		return $conduct_info['eid'];
	}

	public function request_experiment($eid,$fid){
		/*
		* Inserts a request of an experiment with eid
		* for a faculty with fid.
		*/
		$request_info['eid'] = $eid;
		$request_info['fid'] = $fid;
		return $this->db->insert('request',$request_info);
	}

	public function delete_experiment($uid = 0, $eid = 0){
		/*
		* Deletes an experiment given the uid of the user
		* and the eid of the target experiment.
		* Returns true if the actual delete happened
		* false otherwise.
		*/
		$q = "DELETE FROM \"Experiments\" AS e
			  USING \"Users\" AS u, conduct AS c
			  WHERE u.uid = c.uid AND
			  e.eid = c.eid AND
			  e.eid = ? AND
			  c.uid = ?";

		$this->db->query($q,array($eid,$uid));
		return $this->is_rows_affected();
	}

	public function increment_count($uid = 0, $eid = 0){
		/*
		* Given the uid of the researcher and eid of 
		* the experiment, this method will update the 
		* number of respondents who participated.
		* Returns true if the actual update happened
		* false otherwise.
		*/
		$q = "UPDATE \"Experiments\" AS e
			  SET current_count = current_count+1
			  From \"Users\" AS u, conduct AS c
			  WHERE u.uid = c.uid AND
			  e.eid = c.eid AND
			  e.eid = ? AND
			  c.uid = ?";

		$this->db->query($q,array($eid,$uid));

		return $this->is_rows_affected();
	}

	public function decrement_count($uid = 0, $eid = 0){
		/*
		* Given the uid of the researcher and eid of 
		* the experiment, this method will update the 
		* number of respondents who participated.
		*
		* Can be use if a researcher deletes an obsolete
		* submission.
		*
		* Returns true if the actual update happened
		* false otherwise.
		*/
		$q = "UPDATE \"Experiments\" AS e
			  SET current_count = current_count-1
			  From \"Users\" AS u, conduct AS c
			  WHERE u.uid = c.uid AND
			  e.eid = c.eid AND
			  e.eid = ? AND
			  c.uid = ?";

		$this->db->query($q,array($eid,$uid));

		return $this->is_rows_affected();
	}

	public function get_experiment($uid = 0, $eid = 0){
		/*
		* Returns all the fields o
		*/
		$this->db->select('*');
		$this->db->join('conduct','conduct.eid = Experiments.eid');
		$this->db->join('Users','Users.uid = conduct.uid');
		$this->db->where('Experiments.eid',$eid);
		$this->db->where('Users.uid',$uid);
		$q = $this->db->get('Experiments');

		return $this->query_row_conversion($q);
	}

	public function is_complete($uid = 0,$eid = 0){
		$experiment = $this->get_experiment($uid, $eid);
		if(isset($experiment)){
			if($experiment->status == 'TRUE'){
				return true;
			}
		}
		return false;
	}

	public function update_experiment($eid = 0, $info = null){
		$this->db->where('eid', $eid);
		$this->db->update('Experiments', $info);
	}

	public function get_users_experiments($uid = 0, $category = null){
		/*
		* returns all user's experiments by default. 
		* If category is specified, it will filter it further.
		*/
		$this->db->select('*');
		$this->db->join('conduct','conduct.eid = Experiments.eid');
		$this->db->join('Users','Users.uid = conduct.uid');
		$this->db->where('Users.uid',$uid);
		if(isset($category)){
			$this->db->where('Experiments.category',$category);
		}

		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
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
		$this->db->where('status','TRUE');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function get_all_inactive_experiments(){
		$this->db->select('*');
		$this->db->where('status','FALSE');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}
}