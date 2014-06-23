<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('render_styles')) {
    function render_styles($other_css) {
        foreach ($other_css as $css) {
            $this->load->view("includes/stylesheets/".$css)
        }
    }
}

if ( ! function_exists('render_scripts')) {
    function render_scripts($other_js) {
        foreach ($other_js as $js) {
            $this->load->view("includes/javscripts/".$js)
        }
    }
}