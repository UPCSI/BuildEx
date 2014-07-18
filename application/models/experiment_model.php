<?php

class Experiment_model extends MY_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('faculty_model', 'faculty');
		$this->load->model('graduate_model', 'graduate');
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

	public function get($role = NULL, $id = 0, $eid = 0){
		
		if($role == 'faculty'){
			$this->db->join('faculty_conduct', 'faculty_conduct.eid = Experiments.eid');
			$this->db->join('Faculty', 'Faculty.fid = faculty_conduct.fid');
			$this->db->where('Faculty.fid', $id);
		}
		else if($role == 'graduate'){
			$this->db->join('graduates_conduct', 'graduates_conduct.eid = Experiments.eid');
			$this->db->join('Graduates', 'Graduates.gid = graduates_conduct.gid');
			$this->db->where('Graduates.gid', $id);
			$role = $role.'s';
		}

		$this->db->join('Users', 'Users.uid = '.ucfirst($role).'.uid');
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
	/* End of CRUD Methods */

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

	public function get_researcher($eid = 0){
		$researcher = $this->faculty->get_by_experiment($eid);
		
		if(is_null($researcher)){
			$researcher = $this->graduate->get_by_experiment($eid);
		}

		return $researcher;
	}

	public function get_respondents($eid){
		$this->db->where('eid', $eid);
		$q = $this->db->get('Respondents');
		return $this->query_conversion($q);
	}

	public function get_by_hash($url = NULL){
		$this->db->where('url', $url);
		$this->db->where('is_published', 't');
		$q = $this->db->get('Experiments');
		return $this->query_row_conversion($q);
	}

	public function increment_count($eid = 0){
		$this->db->where('eid', $eid);
		$this->db->set('current_count', 'current_count+1', FALSE);
		$this->db->update('Experiments');
		return $this->is_rows_affected();
	}

	public function decrement_count($eid = 0){
		$this->db->where('eid', $eid);
		$this->db->set('current_count', 'current_count-1', FALSE);
		$this->db->update('Experiments');
		return $this->is_rows_affected();
	}

	public function is_complete($eid = 0){
		$experiment = $this->get($eid);
		return isset($experiment) && $experiment->status == 't';
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

	/* Private Methods */
	private function generate_slug($title = NULL, $replace = array(), $delimiter='-'){
		
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

	private function generate_url($eid = 0, $title = NULL){
		$slug = $this->generate_slug($title);
		return "{$eid}/{$slug}";
	}
	/* End of Private Methods */
}
