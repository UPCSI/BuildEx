<?php

class Experiments_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_faculty_experiment($fid = 0,$info = null){
		/*
		* Inserts the experiment to the database
		* Returns the eid of that specific experiment.
		*/
		$this->db->insert('Experiments',$info);
		$conduct_info['eid'] = $this->db->insert_id();
		$conduct_info['fid'] = $fid;
		$this->db->insert('faculty_conduct',$conduct_info);
		return $conduct_info['eid'];
	}

	public function add_graduates_experiment($gid = 0,$info = null){
		/*
		* Inserts the experiment to the database
		* Returns the eid of that specific experiment.
		*/
		$this->db->insert('Experiments',$info);
		$conduct_info['eid'] = $this->db->insert_id();
		$conduct_info['gid'] = $gid;
		$this->db->insert('graduates_conduct',$conduct_info);
		return $conduct_info['eid'];
	}

	public function delete_faculty_experiment($fid = 0, $eid = 0){
		/*
		* Deletes an experiment given the fid of the faculty
		* and the eid of the target experiment.
		* Returns true if the actual delete happened
		* false otherwise.
		*/
		$q = "DELETE FROM \"Experiments\" AS e
			  USING \"Faculty\" AS f, faculty_conduct AS fc
			  WHERE f.fid = fc.fid AND
			  e.eid = fc.eid AND
			  fc.fid = ? AND
			  e.eid = ?";

		$this->db->query($q,array($fid,$eid));
		return $this->is_rows_affected();
	}

	public function delete_graduates_experiment($gid = 0, $eid = 0){
		/*
		* Deletes an experiment given the gid of the graduate
		* and the eid of the target experiment.
		* Returns true if the actual delete happened
		* false otherwise.
		*/
		$q = "DELETE FROM \"Experiments\" AS e
			  USING \"Graduates\" AS g, graduates_conduct AS gc
			  WHERE g.gid = gc.gid AND
			  e.eid = gc.gid AND
			  gc.gid = ? AND
			  e.eid = ?";

		$this->db->query($q,array($gid,$eid));
		return $this->is_rows_affected();
	}

	public function get_experiment($eid = 0){
		/*
		* Returns an experiment given its eid
		*/
		$this->db->select('*');
		$this->db->where('eid',$eid);
		$q = $this->db->get('Experiments');
		return $this->query_row_conversion($q);
	}

	public function get_faculty_experiment($fid = 0, $eid = 0){
		/*
		* Returns all the fields of an experiment
		* given the fid of a faculty
		*/
		$this->db->select('Experiments.*');
		$this->db->join('faculty_conduct','faculty_conduct.eid = Experiments.eid');
		$this->db->join('Faculty','Faculty.fid = faculty_conduct.fid');
		$this->db->where('Experiments.eid',$eid);
		$this->db->where('Faculty.fid',$fid);
		$q = $this->db->get('Experiments');

		return $this->query_row_conversion($q);
	}

	public function get_graduates_experiment($gid = 0, $eid = 0){
		/*
		* Returns all the fields of an experiment
		* given the gid of a graduate
		*/
		$this->db->select('Experiments.*');
		$this->db->join('graduates_conduct','graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates','Graduates.gid = graduates_conduct.gid');
		$this->db->where('Experiments.eid',$eid);
		$this->db->where('Graduates.gid',$gid);
		$q = $this->db->get('Experiments');

		return $this->query_row_conversion($q);
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


	public function increment_count($eid = 0){
		/*
		* Given the eid of the experiment, this 
		* method will update the number of respondents
		* who participated.
		*
		* Returns true if the actual update happened
		* false otherwise.
		*/
		$this->db->where('eid', $eid);
		$this->db->set('current_count', 'current_count+1', FALSE);
		$this->db->update('Experiments');
		return $this->is_rows_affected();
	}

	public function decrement_count($eid = 0){
		/*
		* Given the eid of the experiment,
		* this method will update the 
		* number of respondents who participated.
		*
		* Can be use if a researcher deletes an obsolete
		* submission.
		*
		* Returns true if the actual update happened
		* false otherwise.
		*/
		$this->db->where('eid', $eid);
		$this->db->set('current_count', 'current_count-1', FALSE);
		$this->db->update('Experiments');
		return $this->is_rows_affected();
	}

	public function is_experiment_complete($eid = 0){
		/*
		* Returns true if an experiment with eid 
		* is already completed; false otherwise
		*/
		$experiment = $this->get_experiment($eid);
		if(isset($experiment)){
			if($experiment->status == 't'){
				return true;
			}
		}
		return false;
	}

	public function update_experiment($eid = 0, $info = null){
		/*
		* Updates an experiment with eid given an array of data
		*/
		$this->db->where('eid', $eid);
		$this->db->update('Experiments', $info);
		return $this->is_rows_affected();
	}

	public function get_all_faculty_experiments($fid = 0, $category = null){
		/*
		* Returns all facuty experiments by default. 
		* If category is specified, it will filter it further.
		*/
		$this->db->select('Experiments.*');
		$this->db->join('faculty_conduct','faculty_conduct.eid = Experiments.eid');
		$this->db->join('Faculty','Faculty.fid = faculty_conduct.fid');
		$this->db->where('Faculty.fid',$fid);
		if(isset($category)){
			$this->db->where('Experiments.category',$category);
		}

		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
	}

	public function get_all_advisory_experiments($fid = 0){
		$this->db->select('Users.uid,Users.first_name,Users.middle_name,Users.last_name,Graduates.gid,Experiments.*');
		$this->db->join('advise','advise.eid = Experiments.eid');
		$this->db->join('Faculty','Faculty.fid = advise.fid');
		$this->db->join('graduates_conduct','graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates','Graduates.gid = graduates_conduct.gid');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$this->db->where('Faculty.fid', $fid);
		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
	}

	public function get_all_graduates_experiments($gid = 0, $category = null){
		/*
		* Returns all graduate experiments by default. 
		* If category is specified, it will filter it further.
		*/
		$this->db->select('Experiments.*');
		$this->db->join('graduates_conduct','graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates','Graduates.gid = graduates_conduct.gid');
		$this->db->where('Graduates.gid',$gid);
		if(isset($category)){
			$this->db->where('Experiments.category',$category);
		}

		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
	}

	public function get_all_faculty_laboratory_experiments($lid,$labid){
		/*
		* Given the lab head's lid and the labid of the laboratory
		* it manages, this function will return all the public and within_lab
		* experiments [faculty]
		*/
		$this->db->select('Experiments.*');
		$this->db->join('faculty_conduct','faculty_conduct.eid = Experiments.eid');
		$this->db->join('Faculty','Faculty.fid = faculty_conduct.fid');
		$this->db->join('faculty_member_of','faculty_member_of.fid = Faculty.fid');
		$this->db->join('Laboratories','Laboratories.labid = faculty_member_of.labid');
		$this->db->join('manages','manages.labid = Laboratories.labid');
		$this->db->join('LaboratoryHeads','LaboratoryHeads.lid = LaboratoryHeads.lid');
		$this->db->where('LaboratoryHeads.lid',$lid);
		$this->db->where('Laboratories.labid',$labid);
		$this->db->where('Experiments.privacy',2);
		$this->db->or_where('Experiments.privacy',3);
		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
	}

	public function get_all_graduate_laboratory_experiments($lid,$labid){
		/*
		* Given the lab head's lid and the labid of the laboratory
		* it manages, this function will return all the public and within_lab
		* experiments [graduate]
		*/
		$this->db->select('Experiments.*');
		$this->db->join('graduates_conduct','graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates','Graduates.gid = graduates_conduct.fid');
		$this->db->join('faculty_member_of','faculty_member_of.fid = Faculty.fid');
		$this->db->join('Laboratories','Laboratories.labid = graduates_member_of.labid');
		$this->db->join('manages','manages.labid = Laboratories.labid');
		$this->db->join('LaboratoryHeads','LaboratoryHeads.lid = LaboratoryHeads.lid');
		$this->db->where('LaboratoryHeads.lid',$lid);
		$this->db->where('Laboratories.labid',$labid);
		$this->db->where('Experiments.privacy',2);
		$this->db->or_where('Experiments.privacy',3);
		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
	}

	/* Admin Functionalities */

	public function get_all_experiments(){
		//$this->db->select('eid,title,category,description,target_count,current_count,status,is_published,privacy');
		$this->db->select('Experiments.*');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function get_all_active_experiments(){
		$this->db->select('Experiments.*');
		$this->db->where('status','t');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function get_all_inactive_experiments(){
		$this->db->select('*');
		$this->db->where('status','f');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}
}