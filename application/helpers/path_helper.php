<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('page_path')) {
    function page_path($page = NULL) {
        $CI =& get_instance();
        $path = role();
        if(isset($page)){
            $path = $path.'/'.$CI->session->userdata('username').'/'.$page;
        }
        return $path;
    }

    function laboratory_path($labid = 0){
        return "laboratory/{$labid}";
    }

    function faculty_path($username = NULL){
        return "faculty/{$username}";
    }
}