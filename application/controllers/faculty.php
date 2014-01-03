<?php

class Faculty extends MY_Controller{
	
	public function index() {
		$data['title'] = 'Admin';
		$data['main_content'] = 'contents/faculty_body';
		$this->load->view('_main_layout', $data);
	}
}