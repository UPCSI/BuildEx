<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function page_path($page = NULL) {
  $CI =& get_instance();
  $path = role();

  if(isset($page)){
    $path = $path.'/'.$CI->session->userdata('username').'/'.$page;
  }

  return $path;
}

function laboratory_path($laboratory = NULL, $action = 'view'){
  $link = NULL;

  if(isset($laboratory)){
    $link = "laboratory/{$laboratory->name}";

    if($action != 'view'){
      $link = "{$link}/{$action}";
    }
  }

  return $link;
}

function faculty_path($faculty = NULL, $action = 'view'){
  $link = NULL;

  if(isset($faculty)){
    if($action == 'view'){
      $link = "faculty/{$faculty->username}";
    }
  }

  return $link;
}

function graduate_path($graduate = NULL){
  return "graduate/{$graduate->username}";
}

function experiments_path($researcher = NULL){
  $link = NULL;

  if(isset($researcher)){
    $link = researcher_path($researcher);
    $link = $link.'/experiments';
  }

  return $link;
}

function experiment_path($researcher = NULL, $experiment = NULL, $action = 'view'){
  $link = NULL;

  if(isset($experiment)){
    $researcher = researcher_path($researcher);
    $link = "{$researcher}/experiment/{$experiment->eid}";
    if($action != 'view'){
      $link = $link.'/'.$action;
    }
  }
  else{
    if($action == 'add' || $action == 'create'){
      $researcher = role().'/'.username();
      $link = "{$researcher}/experiment/{$action}";
    }
  }

  return $link;
}

function researcher_path($researcher = NULL){
  if(isset($researcher->fid)){
    return "faculty/{$researcher->username}";
  }
  else if(isset($researcher->gid)){
    return "graduate/{$researcher->username}";
  }
}

function admin_path($admin = NULL, $action = 'view'){
  $link = NULL;

  if(isset($admin)){
    $link = 'admin';

    if($action == 'destroy'){
      $link = "{$link}/{$action}";
    }

    $link = "{$link}/{$admin->username}";
  }

  return $link;
}

function download_path() {
    $link = NULL;
}

function respond_path($experiment = NULL, $action = 'view'){
  $link = NULL;

  if(isset($experiment)){
    $link = "respond/{$experiment->url}";
    if($action != 'view'){
      $link = "{$link}/{$action}";
    }
  }

  return $link;
}

function respondent_path($respondent = NULL, $action = 'view'){
  $link = NULL;

  if(isset($respondent)){
    $link = experiment_path($respondent, $respondent);
    $link = "{$link}/respondent/{$respondent->rid}";

    if($action != 'view'){
      $link = "{$link}/{$action}";
    }
  }

  return $link;
}
