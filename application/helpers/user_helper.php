<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function format_short_name($user) {
    $middle_name = $user->middle_name;
    $format = strtoupper($user->last_name).', ';
    $format = $format.ucwords($user->first_name).' ';
    $format = $format.strtoupper($middle_name[0]);
    $format = $format.'.';
    return $format;
}

function format_full_name($user) {
    $format = strtoupper($user->last_name).', ';
    $format = $format.ucwords($user->first_name).' ';
    $format = $format.ucwords($user->middle_name);
    return $format;
}

function current_namespace() {
    $CI =& get_instance();
    $role = $CI->session->userdata('active_role');
    $username = $CI->session->userdata('username');
    return "{$role}/{$username}";
}

function role_id() {
    $CI =& get_instance();
    $role = $CI->session->userdata('active_role');
    $roles = $CI->session->userdata('roles');
    return intval($roles[$role]);
}

function role() {
    $CI =& get_instance();
    return $CI->session->userdata('active_role');
}

function username() {
    $CI =& get_instance();
    return $CI->session->userdata('username');
}
