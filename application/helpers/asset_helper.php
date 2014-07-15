<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function render_styles($other_css) {
  foreach ($other_css as $css) {
    $CI =& get_instance();
    $CI->load->view("includes/stylesheets/".$css);
  }
}

function render_scripts($other_js) {
  foreach ($other_js as $js) {
    $CI =& get_instance();
    $CI->load->view("includes/javascripts/".$js);
  }
}
