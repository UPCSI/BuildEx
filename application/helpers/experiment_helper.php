<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function response_ratio($experiment = NULL){
  if(isset($experiment)){
    return $experiment->current_count.'/'.$experiment->target_count;    
  }
}

function researcher($experiment = NULL){
  if(isset($experiment)){
    return $experiment->username;
  }
}

function ongoing_experiments($experiments = NULL){
  $new_experiments = array();

  foreach($experiments as $experiment){
    if($experiment->status == 'f'){
      array_push($new_experiments, $experiment);
    }
  }

  return $new_experiments;
}

function complete_experiments($experiments = NULL){
  $new_experiments = array();

  foreach($experiments as $experiment){
    if($experiment->status == 't'){
      array_push($new_experiments, $experiment);
    }
  }

  return $new_experiments;
}
