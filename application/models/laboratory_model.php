<?php

class Laboratory_model extends MY_Model{

  public function __construct(){
    parent::__construct();
    $this->load->model('laboratory_head_model', 'laboratory_head');
    $this->load->model('faculty_model', 'faculty');
  }

  /* CRUD Methods */
  public function create($laboratory_info = NULL, $faculty_username = NULL){
    $faculty = $this->faculty->get(0, $faculty_username);
    
    if(isset($faculty)){
      $lab_head_info['uid'] = $faculty->uid;
      $lid = $this->laboratory_head->create($lab_head_info);
      $this->db->insert('Laboratories', $laboratory_info);
      $labid = $this->db->insert_id();
      $this->laboratory_head->assign_to($lid, $labid);
      $this->add_faculty($labid, $faculty->fid, 'true');
      return $labid;
    }

    return FALSE;
  }

  public function get($labid = 0, $name = NULL){

    if($labid > 0){
      $this->db->where('labid', $labid);
    }

    if(!is_null($name)){
      $this->db->where('name', $name);
    }
    
    $q = $this->db->get('Laboratories');
    return $this->query_row_conversion($q);
  }

  public function all(){
    $this->db->join('manage','manage.labid = Laboratories.labid');
    $this->db->join('LaboratoryHeads','LaboratoryHeads.lid = manage.lid');
    $this->db->join('Users','Users.uid = LaboratoryHeads.uid');
    $q = $this->db->get('Laboratories');
    return $this->query_conversion($q);
  }

  public function update($labid = 0, $laboratory_info = NULL){
    $this->db->where('labid', $labid);
    $this->db->update('Laboratories', $laboratory_info);
    return $this->is_rows_affected();
  }

  public function destroy($labid = 0){
    $laboratory_head = $this->get_laboratory_head($labid);
    $this->laboratory_head->destroy($laboratory_head->lid);
    $this->db->where('labid', $labid);
    $this->db->delete('Laboratories');
    return $this->is_rows_affected();
  }
  /* End of CRUD */

  public function get_faculty($labid = 0){
    $this->db->select('Users.*,Faculty.*');
    $this->db->join('faculty_member_of', 'faculty_member_of.fid = Faculty.fid');
    $this->db->join('Users', 'Users.uid = Faculty.uid');
    $this->db->join('Laboratories', 'Laboratories.labid = faculty_member_of.labid');
    $this->db->where('Laboratories.labid', $labid);
    $this->db->where('faculty_member_of.status', 't');
    $q = $this->db->get('Faculty');

    return $this->query_conversion($q);
  }

  public function get_graduates($labid = 0){
    $this->db->select('Users.*,Graduates.*,');
    $this->db->join('graduates_member_of','graduates_member_of.gid = Graduates.gid');
    $this->db->join('Users','Users.uid = Graduates.uid');
    $this->db->join('Laboratories','Laboratories.labid = graduates_member_of.labid');
    $this->db->where('Laboratories.labid',$labid);
    $this->db->where('graduates_member_of.status','t');
    $q = $this->db->get('Graduates');
    return $this->query_conversion($q);
  }

  public function get_experiments($labid = 0){
    $all = array();
    $faculty_exp = $this->all_faculty_experiments($labid);
    $graduates_exp = $this->all_graduate_experiments($labid);
    
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

  public function all_faculty_experiments($labid = 0){
    $this->db->join('faculty_conduct', 'faculty_conduct.eid = Experiments.eid');
    $this->db->join('Faculty','Faculty.fid = faculty_conduct.fid');
    $this->db->join('faculty_member_of', 'faculty_member_of.fid = Faculty.fid');
    $this->db->join('Laboratories', 'Laboratories.labid = faculty_member_of.labid');
    $this->db->where('Laboratories.labid', $labid);
    $this->db->where('Experiments.privacy', 2);
    $this->db->or_where('Experiments.privacy',3);
    $q = $this->db->get('Experiments');

    return $this->query_conversion($q);
  }

  public function all_graduate_experiments($labid = 0){
    $this->db->join('graduates_conduct', 'graduates_conduct.eid = Experiments.eid');
    $this->db->join('Graduates', 'Graduates.gid = graduates_conduct.gid');
    $this->db->join('graduates_member_of', 'graduates_member_of.gid = Graduates.gid');
    $this->db->join('Laboratories', 'Laboratories.labid = graduates_member_of.labid');
    $this->db->where('Laboratories.labid', $labid);
    $this->db->where('Experiments.privacy', 2);
    $this->db->or_where('Experiments.privacy', 3);
    $q = $this->db->get('Experiments');

    return $this->query_conversion($q);
  }

  public function get_laboratory_head($labid = 0){
    $this->db->join('Users', 'Users.uid = LaboratoryHeads.uid');
    $this->db->join('manage', 'manage.lid = LaboratoryHeads.lid');
    $this->db->join('Laboratories', 'Laboratories.labid = manage.labid');
    $this->db->where('Laboratories.labid', $labid);
    $q = $this->db->get('LaboratoryHeads');
    return $this->query_row_conversion($q);
  }

  public function is_graduate_member($gid = 0){
    $this->db->where('gid',$gid);
    $this->db->where('status','true');
    $q = $this->db->get('graduates_member_of');
    if($q->num_rows() > 0){
      return true;
    }
    return false;
  }

  public function is_faculty_member($fid = 0){
    $this->db->where('fid',$fid);
    $this->db->where('status','true');
    $q = $this->db->get('faculty_member_of');
    if($q->num_rows() > 0){
      return true;
    }
    return false;
  }

  public function add_faculty($labid, $fid, $cond = 'false'){
    $info = array('labid'=>$labid,
                  'fid'=>$fid,
                  'status'=>$cond);

    if($this->db->insert('faculty_member_of', $info)){
      $this->increment_member_count($labid);
      return TRUE;
    }

    return FALSE;
  }

  public function add_graduate($labid, $gid, $cond = 'false'){
    $info = array('labid'=>$labid,
                  'gid'=>$gid,
                  'status'=>$cond);

    if($this->db->insert('graduates_member_of', $info)){
      $this->increment_member_count($labid);
      return TRUE;
    }

    return FALSE;
  }

  public function accept_faculty($labid, $fid){
    $this->db->where('labid', $labid);
    $this->db->where('fid', $fid);
    $this->db->update('faculty_member_of',array('status'=>'true'));
    return $this->is_rows_affected();
  }

  public function accept_graduate($labid, $gid){
    $this->db->where('labid', $labid);
    $this->db->where('gid', $gid);
    $this->db->update('graduates_member_of',array('status'=>'true'));
    return $this->is_rows_affected();
  }

  public function reject_faculty($labid, $fid){
    $this->db->where('labid', $labid);
    $this->db->where('fid', $fid);
    $this->db->delete('faculty_member_of');
    return $this->is_rows_affected();
  }

  public function reject_graduate($labid, $gid){
    $this->db->where('labid', $labid);
    $this->db->where('gid',$gid);
    $this->db->delete('graduates_member_of');
    return $this->is_rows_affected();
  }

  public function increment_member_count($labid){
    $this->db->set('members_count', 'members_count+1', FALSE);
    $this->db->where('labid', $labid);
    $this->db->update('Laboratories');
  }

  public function delete_other_faculty_requests($fid){
    $this->db->where('faculty_member_of.fid',$fid);
    $this->db->where('faculty_member_of.status',"false");
    $this->db->delete('faculty_member_of');
  }

  public function delete_other_graduate_requests($gid){
    $this->db->where('graduates_member_of.gid',$gid);
    $this->db->where('graduates_member_of.status',"false");
    $this->db->delete('graduates_member_of');
  }

  public function get_all_faculty_requests($labid){
    $this->db->select('Users.uid,username,first_name,middle_name,last_name,email_ad,Faculty.fid,faculty_num,since,labid');
    $this->db->join('Faculty','Faculty.fid = faculty_member_of.fid');
    $this->db->join('Users','Users.uid = Faculty.uid');
    $this->db->where('labid',$labid);
    $this->db->where('faculty_member_of.status','false');
    $q = $this->db->get('faculty_member_of');
    return $this->query_conversion($q);
  }

  public function get_all_graduates_requests($labid){
    $this->db->select('Users.uid,username,first_name,middle_name,last_name,email_ad,Graduates.gid,student_num,since,labid');
    $this->db->join('Graduates','Graduates.gid = graduates_member_of.gid');
    $this->db->join('Users','Users.uid = Graduates.uid');
    $this->db->where('labid',$labid);
    $this->db->where('graduates_member_of.status','false');
    $q = $this->db->get('graduates_member_of');
    return $this->query_conversion($q);
  }

  public function assign_laboratory_head($labid,$lid){
    return $this->db->insert('manages',array('lid'=>$lid,'labid'=>$labid));
  }
}