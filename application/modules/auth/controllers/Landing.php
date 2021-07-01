<?php

class Landing extends NoAuth_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        if($this->login_model->isNotLogin()) redirect('auth/login');
    }


    public function index() 
    {
        $data['judul'] = 'Web Test - Dashboard';
        
        $this->load->view('v_landing', $data);
    }

    
}