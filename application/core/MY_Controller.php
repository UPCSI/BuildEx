<?php

class MY_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

    public function secure_page(){
        if (!$this->session->userdata('loggedin')){
            redirect('');
        }
    }
}

class User_Controller extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->role = 'admin';
    }

    public function index(){
        if (array_key_exists($this->role, $this->session->userdata('roles'))){
            $data['title'] = ucfirst($this->role);
            $data['main_content'] = 'users/index';
            $data['page'] = 'home';
            $this->load->view('main_layout', $data);
        }
        else{
            redirect($this->session->userdata('active_role'));
        }
    }

    public function laboratory($id = 0){
        if($this->role == 'faculty'){
            $this->load->model('faculty_model', 'faculty');
            $laboratory = $this->faculty->get_laboratory($id);
        }
        else if($this->role == 'graduate'){
            $this->load->model('graduate_model', 'graduate');
            $laboratory = $this->graduate->get_laboratory($id);
        }

        if(isset($laboratory)){
            redirect(laboratory_path($laboratory));
        }

        $msg = 'You have no laboratory yet. Please join one.';
        $this->session->set_flashdata('notification', $msg);
        redirect('explore');
    }

    public function logout(){   
        $this->session->sess_destroy();
        redirect('');
    }
}
