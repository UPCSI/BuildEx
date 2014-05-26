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
            $this->load->view('main_layout',$data);
        }
        else{
            redirect($this->session->userdata('active_role'));
        }
    }

    public function profile(){
        $this->load->model('user_model','user');
        $username = $this->session->userdata('username');
        $data['user'] = $this->user->get_user_profile(0,$username);
        $data['roles'] = array_keys($this->session->userdata('roles'));
        $data['title'] = ucfirst($this->role);
        $data['main_content'] = 'users/index';
        $data['page'] = 'profile';
        $this->load->view('main_layout',$data);
    }

    public function logout(){   
        $this->session->sess_destroy();
        redirect('');
    }
}
