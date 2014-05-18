<?php

class MY_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('loggedin') == FALSE){
			redirect('');
		}
        $this->role = 'admin';
	}
}

class User_Controller extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->role = 'admin';
    }

    public function index(){
        if (in_array($this->role,$this->session->userdata('role'))){
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
        $data['roles'] = $this->session->userdata('role');
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
