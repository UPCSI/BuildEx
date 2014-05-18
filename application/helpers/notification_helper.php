<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_notification'))
{
    function get_notification()
    {
        $notif = $this->session->flashdata('notification');
        if($notif){
            $data['notification'] = $notif;
        }
    }
}