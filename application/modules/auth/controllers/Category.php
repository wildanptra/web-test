<?php 

class Category extends NoAuth_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        if($this->login_model->isNotLogin()) redirect('auth/login');
    }

    public function index()
    {
        $this->load->model('category_model');

        $data['judul'] = 'Web Test - Category';

        $this->load->view('v_category', $data);
    }

    public function get_json()
    {
        $this->load->library('datatables');
        $this->datatables->select('id_category,name,description');
        $this->datatables->from('tb_category');
        $this->datatables->add_column('no','ID-$1','id_category');
        $this->datatables->add_column(
            'action', 
            '<a href="#" class="btn btn-primary btn-sm" onclick="byid($1,\'edit\')"><i class="fa fa-edit"></i> Edit</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="byid($1,\'delete\')"><i class="fa fa-trash"></i> Delete</a>',
            'id_category'
        );
        return print_r($this->datatables->generate());
    }

    // public function getData()
    // {   
    //     $this->load->model('category_model');

    //     $results = $this->category_model->getDataTable();
    //     $data = [];
    //     $no = $_POST['start'];
    //     foreach( $results as $result ){
    //         $row = array();
    //         $row[] = ++$no;
    //         $row[] = $result->name;
    //         $row[] = $result->description;
    //         $row[] = '
    //             <a href="#" class="btn btn-primary btn-sm" onclick="byid(' . "'" . $result->id_category. "','edit'" . ')"><i class="fa fa-edit"></i> Edit</a> 
    //             <a href="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->id_category. "','delete'" . ')"><i class="fa fa-trash"></i> Delete</a> 
    //         ';
    //         $data[] = $row;
    //     }

    //     $output = array(
    //         'draw' => $_POST['draw'],
    //         'recordsTotal' => $this->category_model->count_all_data(),
    //         'recordsFiltered' => $this->category_model->count_filter_data(),
    //         'data' => $data,
    //     );

    //     $this->output->set_content_type('application/json')->set_output(json_encode($output));

    // }


    public function create()
    {
        $this->load->model('category_model');

        $this->_validation();

        $table = 'tb_category';

        $name                       = $this->input->post('name', true);
        $description                = $this->input->post('description', true);

        $data_category = [

            'name'          => $name,
            'description'   => $description

        ];

        if($this->category_model->insertCategory($table,$data_category)){

            $message['status'] = 'sukses';

        }else {

            $message['status'] = 'gagal';

        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
        
    }

    public function byid($id_category)
    {
        $this->load->model('category_model');
        $data = $this->category_model->getDataById($id_category);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update()
    {
        $this->load->model('category_model');

        $this->_validation();

        $name                       = $this->input->post('name', true);
        $description                = $this->input->post('description', true);

        $data_category = [

            'name'          => $name,
            'description'   => $description

        ];

        if($this->category_model->updateCategory(array('id_category' => $this->input->post('id_category')),$data_category) >= 0){

            $message['status'] = 'sukses';

        }else {

            $message['status'] = 'gagal';

        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function delete($id_category)
    {
        $this->load->model('category_model');

        if($this->category_model->deleteCategory($id_category)) {

            $message['status'] = 'sukses';

        }else {

            $message['status'] = 'gagal';

        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    private function _validation() 
    {

        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['status'] = true;

        if($this->input->post('name') == '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Nama Category harus di isi';
            $data['status'] = false;
        }

        if($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

}