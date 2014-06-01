<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_experiment_link'))
{
    function format_experiment_link($role = NULL, $id = 0, $exp = NULL)
    {
        return "{$role}/{$id}/experiment/{$exp->eid}";
    }
}