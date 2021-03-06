<?php

class MY_Controller extends CI_Controller{

  public function __construct(){
    parent::__construct();
  }

  public function secure_page(){
    if (!$this->session->userdata('loggedin')){
      redirect('');
    }
  }
}

class User_Controller extends MY_Controller{
  
  public function __construct(){
    parent::__construct();
    $this->role = 'admin';
  }

  public function laboratory($username = NULL){
    $researcher_info = $this->user_model->get_researcher($this->role, $username);
    $id = $researcher_info[1];

    if($this->role == 'faculty'){
      $this->load->model('faculty_model', 'faculty');
      $laboratory = $this->faculty->get_laboratory($id);
    }
    else if($this->role == 'graduate'){
      $this->load->model('graduate_model', 'graduate');
      $laboratory = $this->graduate->get_laboratory($id);
    }
    
    if(isset($laboratory)){
      redirect(laboratory_path($laboratory));
    }
    else{
      $msg = "You don't have a laboratory yet. Please join one now.";
      $this->session->set_flashdata('notification', $msg);
      redirect('explore');
    }
  }

  public function authenticate(){
    if(!array_key_exists($this->role, $this->session->userdata('roles'))){
      redirect($this->session->userdata('active_role'));    
    }
  }
}
