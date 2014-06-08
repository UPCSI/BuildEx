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