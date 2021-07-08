<?php 

class Order extends NoAuth_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        if($this->login_model->isNotLogin()) redirect('auth/login');
    }

    public function index()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');

        $data['judul'] = 'Web Test - Order Product';
        $data['product'] = $this->product_model->getProduct();
        $data['category'] = $this->category_model->getCategory();
        $data['order']  = $this->order_model->getOrder();

        $this->load->view('v_order', $data);
    }

    public function getData()
    {   
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');

        $results = $this->order_model->getDataTable();
        $data = [];
        $no = $_POST['start'];
        

        foreach( $results as $result ){
            if($result->status_order == 'proses') {
                $row = array();
                $row[] = ++$no;
                $row[] = $result->name_product;
                $row[] = $result->qty;
                $row[] = number_format($result->price,0,',','.');
                $row[] = number_format($result->price * $result->qty,0,',','.');
                $row[] = '
                    <a href="#" class="btn btn-primary btn-sm" onclick="byid(' . "'" . $result->id_order. "','edit'" . ')"><i class="fa fa-edit"></i> Edit</a> 
                    <a href="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->id_order. "','delete'" . ')"><i class="fa fa-trash"></i> Delete</a> 
                ';
                $data[] = $row;
            }
        }

        $output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->order_model->count_all_data(),
            'recordsFiltered' => $this->order_model->count_filter_data(),
            'data' => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));


    }


    public function create()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');

        // $this->_validation();

        $table = 'tb_order';

        $id_product                     = $this->input->post('id_product',true);
        $qty                            = $this->input->post('qty',true);
        $price                          = $this->input->post('price',true);
        $subtotal                       = $this->input->post('subtotal',true);
        $user                           = $this->db->get('tb_users')->row();

        $data_order = [

            'id_product'                => $id_product,
            'qty'                       => $qty,
            'price'                     => $price,
            'subtotal'                  => $subtotal,
            'user_id'                   => $user->user_id,

        ];

        if($this->order_model->insertOrder($table,$data_order)){

            $message['status'] = 'sukses';

        }else {

            $message['status'] = 'gagal';

        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
        
    }

    public function byid($id_order)
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');

        $data = $this->product_model->getDataById($id_order);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');

        $this->_validation();

        $name                           = $this->input->post('name', true);
        $description                    = $this->input->post('description', true);
        $id_category                    = $this->input->post('id_category',true);
        $stock                          = $this->input->post('stock',true);
        $price                          = $this->input->post('price',true);

        $data_product = [

            'name'          => $name,
            'description'   => $description,
            'id_category'   => $id_category,
            'stock'         => $stock,
            'price'         => $price

        ];

        if($this->product_model->updateProduct(array('id_product' => $this->input->post('id_product')),$data_product) >= 0){

            $message['status'] = 'sukses';

        }else {

            $message['status'] = 'gagal';

        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function delete($id_product)
    {
        $this->load->model('product_model');

        if($this->product_model->deleteProduct($id_product)) {

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
            $data['error_string'][] = 'Nama Product harus di isi';
            $data['status'] = false;
        }

        if($this->input->post('id_category') == '') {
            $data['inputerror'][] = 'id_category';
            $data['error_string'][] = 'Kategori Product harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('stock') == '') {
            $data['inputerror'][] = 'stock';
            $data['error_string'][] = 'Stock Product harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('price') == '') {
            $data['inputerror'][] = 'price';
            $data['error_string'][] = 'Harga Product harus di isi';
            $data['status'] = FALSE;
        }
        

        if($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

}