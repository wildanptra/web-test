<?php

class Login extends NoAuth_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        $data['judul'] = 'Web Test - Login';
        
        $this->form_validation->set_rules('username', 'Username','trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required'); 

        if($this->form_validation->run() == true){

            if($this->login_model->doLogin()){
                $this->session->set_flashdata('message','Selamat Anda Berhasil Login');
                redirect(site_url('auth/landing'));
            }else {
                $this->session->set_flashdata('message_error','Username atau Password Salah');
                // redirect(site_url('auth/login'));
            }
        }

        $this->load->view('v_login',$data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('auth/login'));
    }
}