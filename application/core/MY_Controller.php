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

    public function laboratory($role = NULL, $id = 0){
        $this->load->model('faculty_model', 'faculty');
        $this->load->model('graduate_model', 'graduate');
        if($role == 'faculty'){
            $laboratory = $this->faculty->get_laboratory($id);
        }
        else if($role == 'graduate'){
            $laboratory = $this->graduate->get_laboratory($id);
        }

        print_var($role);
        print_var($id);
        print_var($laboratory);
        
        if(isset($laboratory)){
            $labid = $laboratory->labid;
            redirect(laboratory_path($labid));
        }
    }

    public function logout(){   
        $this->session->sess_destroy();
        redirect('');
    }
}
