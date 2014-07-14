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

function experiment_path($researcher, $experiment = NULL, $action = 'view'){
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

function admin_path($admin = NULL){
    if(isset($admin)){
        return "admin/{$admin->username}";
    }
}

function respond_path($experiment = NULL){
    if(isset($experiment)){
        return "respond/{$experiment->url}";
    }
}
