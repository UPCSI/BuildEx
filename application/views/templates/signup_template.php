<?php

	$this->load->view('templates/main_header',$title);

	if($role == 'student'){
		$this->load->view('forms/graduate_signup_form');
	}
	else if($role == 'faculty'){
		$this->load->view('forms/faculty_signup_form');
	}

	$this->load->view('templates/main_footer');

?>