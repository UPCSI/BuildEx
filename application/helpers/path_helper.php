<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function page_path($page = NULL) {
    $CI =& get_instance();
    $path = role();
    if(isset($page)){
        $path = $path.'/'.$CI->session->userdata('username').'/'.$page;
    }
    return $path;
}

function laboratory_path($laboratory = NULL){
    return "laboratory/{$laboratory->labid}";
}

function faculty_path($faculty = NULL){
    return "faculty/{$faculty->username}";
}

function graduate_path($graduate = NULL){
    return "graduate/{$graduate->username}";
}

function experiment_path($experiment = NULL) {
    $link = NULL;
    if(isset($experiment)){
        $researcher = researcher_path($experiment);
        $link = "{$researcher}/experiment/{$experiment->eid}";
    }
    return $link;
}

function researcher_path($experiment = NULL){
    if(isset($experiment->fid)){
        return "faculty/{$experiment->fid}";
    }
    else if(isset($experiment->gid)){
        return "graduate/{$experiment->fid}";
    }
}

function admin_path($admin = NULL){
    if(isset($admin)){
        return "admin/{$admin->username}";
    }
}