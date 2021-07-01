<?php 

class Category extends NoAuth_Controller {

    public function __constuct()
    {
        parent::__construct();
        $this->load->model('login_model');
        if($this->login_model->isNotLogin()) redirect('auth/login');
    }

    public function index()
    {
        $this->load->model('category_model');

        $data['judul'] = 'Web Test - Category';
        $data['category'] = $this->category_model->getAllCategory();

        $this->load->view('v_category', $data);
    }

    public function get_json()
    {
        $this->load->library('datatables');
        $this->datatables->add_column('no','ID-$1','id_category');
        $this->datatables->select('id_category','name','description');
        $this->datatables->add_column('action', anchor(site_url('auth/category/edit/$1')),'Update', array('class' => 'btn btn-sm btn-success')) ." ". anchor(site_url('auth/category/delete/$1','Delete', array('class' => 'btn btn-sm btn-danger','onclick' => 'return confirm(\' Data Yakin di Hapus? \')')),'id_category');
        $this->datatables->from('tb_category');
        return print_r($this->datatables->generate());
    }

    public function create()
    {
        $this->load->model('category_model');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description');

        $table = 'tb_category';

        $name                       = $this->input->post('name');
        $description                = $this->input->post('description');

        $data_category = [

            'name'          => $name,
            'description'   => $description

        ];

        if($this->category_model->insertCategory($table,$data_category)){

            $this->session->set_flashdata('message','Data Berhasil di Tambah');
            redirect(site_url('auth/category'));

        }
    }

}