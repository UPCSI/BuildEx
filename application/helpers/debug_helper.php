<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('print_var')) {
    function print_var($var) {
        echo "print_var()";
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}