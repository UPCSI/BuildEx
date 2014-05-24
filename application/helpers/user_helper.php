<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_short_name'))
{
    function format_short_name($user)
    {
        $middle_initial = $user->middle_name;
        $format = strtoupper($user->last_name).', ';
        $format = $format.ucwords($user->first_name).' ';
        $format = $format.strtoupper($middle_initial[0]);
        $format = $format.'.';
        return $format;
    }
}

if ( ! function_exists('format_full_name'))
{
    function format_full_name($user)
    {
        $format = strtoupper($user->last_name).', ';
        $format = $format.ucwords($user->first_name).' ';
        $format = $format.ucwords($user->middle_name);
        return $format;
    }
}