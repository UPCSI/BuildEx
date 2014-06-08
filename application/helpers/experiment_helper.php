<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function format_experiment_link($role = NULL, $id = 0, $exp = NULL) {
    $link = "{$role}/{$id}/experiment";
    if(isset($exp)){
        $link = $link.'/'.$exp->eid;
    }
    return $link;
}

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