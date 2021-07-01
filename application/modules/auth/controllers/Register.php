<?php 

class Register extends NoAuth_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Web Test - Register';

        $this->form_validation->set_rules('username', 'Username','trim|required|min_length[1]|max_length[255]|is_unique[tb_users.username]');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|min_length[5]|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('name', 'Name','trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('address','Address');

        $table = 'tb_users';

        $username               = $this->input->post('username');
        $password               = $this->input->post('password'); 
        $email                  = $this->input->post('email');
        $name                   = $this->input->post('name');
        $address                = $this->input->post('address');

        $data_input = [
            'username'          => $username,
            'password'          => password_hash($password, PASSWORD_BCRYPT),
            'email'             => $email,
            'name'              => $name,
            'address'           => $address,
        ];
        
        if($this->form_validation->run() == true){
            if($this->register_model->register($table,$data_input)){
                $this->session->set_flashdata('message','Data Berhasil di Registrasi');
                redirect(site_url('auth/register'));
            }
        }

        $this->load->view('v_register',$data);
    }

}