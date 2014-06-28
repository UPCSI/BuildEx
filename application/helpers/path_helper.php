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
        if($action == 'view'){
            $link = "laboratory/{$laboratory->labid}";
        }
        else{
            $link = "laboratory/{$laboratory->labid}/{$action}";
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
        else{
            $link = "faculty/{$faculty->username}/{$action}";
        }
    }
    return $link;
}

function graduate_path($graduate = NULL){
    return "graduate/{$graduate->username}";
}

function experiment_path($experiment = NULL, $action = 'view') {
    $link = NULL;
    if(isset($experiment)){
        $researcher = researcher_path($experiment);
        $link = "{$researcher}/experiment/{$experiment->eid}";
        if($action != 'view'){
            $link = $link.'/'.$action;
        }
    }
    else{
        if($action == 'add' || $action == 'create'){
            $CI =& get_instance();
            $researcher = role().'/'.role_id();
            $link = "{$researcher}/experiment/{$action}";
        }
    }
    return $link;
}

function researcher_path($experiment = NULL){
    if(isset($experiment->fid)){
        return "faculty/{$experiment->fid}";
    }
    else if(isset($experiment->gid)){
        return "graduate/{$experiment->gid}";
    }
}

function admin_path($admin = NULL){
    if(isset($admin)){
        return "admin/{$admin->username}";
    }
}
