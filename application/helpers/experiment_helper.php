<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_experiment_link')) {
    function format_experiment_link($role = NULL, $id = 0, $exp = NULL) {
      $link = "{$role}/{$id}/experiment";
      if(isset($exp)){
          $link = $link.'/'.$exp->eid;
      }
      return $link;
    }
}