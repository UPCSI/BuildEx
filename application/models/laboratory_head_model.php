<?php

class Laboratory_head_model extends MY_Model{

  public function __construct(){
    parent::__construct();
  }

  /* CRUD Methods */
  public function create($labhead_info = NULL){
    $this->db->insert('LaboratoryHeads', $labhead_info);
    return $this->db->insert_id();
  }

  public function get($lid = 0, $username = NULL){
    $this->db->join('Users', 'Users.uid = LaboratoryHeads.uid');
    $this->db->join('Faculty', 'Faculty.uid = Users.uid');

    if($lid > 0){
      $this->db->where('LaboratoryHeads.lid', $lid);
    }
    else if(!is_null($username)){
      $this->db->where('Users.username', $username);
    }
    
    $q = $this->db->get('LaboratoryHeads');
    return $this->query_row_conversion($q);
  }

  public function update($lid = 0, $labhead_info = NULL){
    $this->db->where('lid', $lid);
    $this->db->update('LaboratoryHeads', $labhead_info);
    return $this->is_rows_affected();
  }

  public function destroy($lid = 0, $username = NULL){

    if($lid > 0){
      $this->db->where('lid', $lid);
      $this->db->delete('LaboratoryHeads');
    }
    else{
      $q = "DELETE FROM \"LaboratoryHeads\" AS l
            USING \"Users\" AS u
            WHERE l.uid = u.uid AND
            u.username = ?";
      $this->db->query($q,array($username));
    }

    return $this->is_rows_affected();
  }
  /* End of CRUD */

  public function assign_to($lid = 0, $labid = 0){
    return $this->db->insert('manage',array('lid'=>$lid, 'labid'=>$labid));
  }

  public function get_laboratory($lid = 0){
    $this->db->select('Laboratories.*');
    $this->db->join('manage', 'manage.labid = Laboratories.labid');
    $this->db->where('manage.lid', $lid);
    $q = $this->db->get('Laboratories');
    return $this->query_row_conversion($q);
  }

  public function get_laboratory_head_of_lab($labid = 0){
    $this->db->select('*');
    $this->db->join('Users','Users.uid = LaboratoryHeads.uid');
    $this->db->join('manage','manage.lid = LaboratoryHeads.lid');
    $this->db->join('Laboratories','Laboratories.labid = manage.labid');
    $this->db->where('Laboratories.labid',$labid);
    $q = $this->db->get('LaboratoryHeads');
    return $this->query_row_conversion($q);
  }

  /* Admin Functionalities*/
  public function get_all_laboratory_heads(){
    $this->db->select('LaboratoryHeads.*');
    $q = $this->db->get('LaboratoryHeads');
    return $this->query_conversion($q);
  }
}