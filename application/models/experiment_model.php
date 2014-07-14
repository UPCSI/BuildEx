<?php

class Experiment_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	/* CRUD Methods */
	public function create($info = NULL){
		$this->db->insert('Experiments', $info);
		$eid = $this->db->insert_id();

		$new_info['url'] = $this->generate_url($eid, $info['title']);
		$this->update($eid, $new_info);

		$this->assign_to(role(), role_id(), $eid);
		
		return $eid;
	}

	public function get($eid = 0){
		$this->db->join('faculty_conduct', 'faculty_conduct.eid = Experiments.eid');
		$this->db->join('Faculty', 'Faculty.fid = faculty_conduct.fid');
		$this->db->join('Users', 'Users.uid = Faculty.uid');
		$this->db->where('Experiments.eid', $eid);
		$q = $this->db->get('Experiments');
		return $this->query_row_conversion($q);
	}

	public function all(){
		$all = array();
		$faculty_exp = $this->all_faculty_experiments();
		$graduates_exp = $this->all_graduate_experiments();
		if(isset($faculty_exp)){
			$all = array_merge($all, $faculty_exp);
		}

		if(isset($graduates_exp)){
			$all = array_merge($all, $graduates_exp);
		}

		if(empty($all)){
			return null;
		}

		return $all;
	}

	public function update($eid = 0, $info = NULL){
		$this->db->where('eid', $eid);
		$this->db->update('Experiments', $info);
		return $this->is_rows_affected();
	}

	public function destroy($eid = 0){
		$this->db->where('eid', $eid);
		$this->db->delete('Experiments');
		return $this->is_rows_affected();
	}
	/* END of CRUD Methods */

	public function assign_to($role = NULL, $id = 0, $eid = 0){
		$conduct_info['eid'] = $eid;
		if($role == 'faculty'){
			$conduct_info['fid'] = $id;
			$this->db->insert('faculty_conduct', $conduct_info);
		}
		else if($role == 'graduate'){
			$conduct_info['gid'] = $id;
			$this->db->insert('graduates_conduct', $conduct_info);
		}
		return $this->is_rows_affected();
	}

	public function all_faculty_experiments(){
		$this->db->join('faculty_conduct', 'faculty_conduct.eid = Experiments.eid');
		$this->db->join('Faculty', 'Faculty.fid = faculty_conduct.fid');
		$this->db->join('Users', 'Users.uid = Faculty.uid');
		$this->db->join('faculty_member_of', 'faculty_member_of.fid = Faculty.fid');
		$this->db->join('Laboratories', 'Laboratories.labid = faculty_member_of.labid');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function all_graduate_experiments(){
		$this->db->join('graduates_conduct', 'graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates', 'Graduates.gid = graduates_conduct.gid');
		$this->db->join('Users', 'Users.uid = Graduates.uid');
		$this->db->join('graduates_member_of', 'graduates_member_of.gid = Graduates.gid');
		$this->db->join('Laboratories', 'Laboratories.labid = graduates_member_of.labid');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function get_experiment_by_hash($url){
		$this->db->select('*');
		$this->db->where('url',$url);
		$this->db->where('is_published','t');
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

	public function get_all_advisory_experiments($fid = 0){
		$this->db->select('Users.uid,Users.username,Users.first_name,Users.middle_name,Users.last_name,Graduates.gid,advise.status as advise_status,Experiments.*');
		$this->db->join('advise','advise.eid = Experiments.eid');
		$this->db->join('Faculty','Faculty.fid = advise.fid');
		$this->db->join('graduates_conduct','graduates_conduct.eid = Experiments.eid');
		$this->db->join('Graduates','Graduates.gid = graduates_conduct.gid');
		$this->db->join('Users','Users.uid = Graduates.uid');
		$this->db->where('Faculty.fid', $fid);
		$q = $this->db->get('Experiments');

		return $this->query_conversion($q);
	}

	public function generate_slug($title,$replace = array(),$delimiter='-'){
		if(!empty($replace)){
			$title = str_replace((array)$replace,' ',$title);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $title);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean,'-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		$slug = $clean;

		return $slug;

	}
	
	public function advise_experiment($fid,$eid){
		$info['status'] = "true";
		$this->db->where('fid', $fid);
		$this->db->where('eid', $eid);
		$this->db->update('advise', $info);
		return $this->is_rows_affected();
	}

	public function reject_experiment($fid,$eid){
		$this->db->where('fid', $fid);
		$this->db->where('eid', $eid);
		$this->db->delete('advise');
		return $this->is_rows_affected();
	}

	public function get_all_graduates_experiments($gid = 0, $category = NULL){
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

	public function all_active_experiments(){
		$this->db->select('Experiments.*');
		$this->db->where('status','t');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	public function all_inactive_experiments(){
		$this->db->select('*');
		$this->db->where('status','f');
		$q = $this->db->get('Experiments');
		return $this->query_conversion($q);
	}

	/* PRIVATE METHODS */
	private function generate_url($eid,$title){
		$str = strval($eid).$title;
		return base64_encode($str);
	}
	/* END OF PRIVATE METHODS */
}