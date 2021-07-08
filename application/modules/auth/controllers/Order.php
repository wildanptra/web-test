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

    public function data_transaksi()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');

        $data['judul'] = 'Web Test - Data Transaksi';
        $data['product'] = $this->product_model->getProduct();
        $data['category'] = $this->category_model->getCategory();
        $data['order']  = $this->order_model->getOrder();

        $this->load->view('v_data_transaksi', $data);
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
                $row[] = number_format($result->total,0,',','.');
                $row[] = $result->username_user;
                $row[] = '
                    <a href="#" class="btn btn-primary btn-sm" onclick="byid(' . "'" . $result->id_order. "','edit'" . ')"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->id_order. "','delete'" . ')"><i class="fa fa-trash"></i> Delete</a>
                    <a href="#" class="btn btn-success btn-sm" onclick="byid(' . "'" . $result->id_order. "','bayar'" . ')" value="id_order"><i class="fa fa-money-bill-alt"></i> Exchange</a>
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


    public function getDataTransaksi()
    {   
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');

        $results = $this->order_model->getDataTable();
        $data = [];
        $no = $_POST['start'];
        

        foreach( $results as $result ){
            if($result->status_order == 'selesai') {
                $row = array();
                $row[] = ++$no;
                $row[] = $result->username_user;
                $row[] = $result->name_product;
                $row[] = $result->tanggal_transaksi;
                $row[] = $result->qty;
                $row[] = number_format($result->price,0,',','.');
                $row[] = number_format($result->total,0,',','.');
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

        $this->_validation();

        $table = 'tb_order';

        $id_product                     = $this->input->post('id_product',true);
        $qty                            = $this->input->post('qty',true);
        $price                          = $this->input->post('price',true);
        $total                          = $this->input->post('total',true);
        $user                           = $this->db->get('tb_users')->row();

        $data_order = [

            'id_product'                => $id_product,
            'qty'                       => $qty,
            'price'                     => $price,
            'total'                     => $total,
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

        $data = $this->order_model->getDataById($id_order);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');

        $this->_validation();

        $id_product                     = $this->input->post('id_product',true);
        $qty                            = $this->input->post('qty',true);
        $price                          = $this->input->post('price',true);
        $total                          = $this->input->post('total',true);
        $user                           = $this->db->get('tb_users')->row();

        $data_order = [

            'id_product'                => $id_product,
            'qty'                       => $qty,
            'price'                     => $price,
            'total'                     => $total,
            'user_id'                   => $user->user_id,

        ];

        if($this->order_model->updateOrder(array('id_order' => $this->input->post('id_order')),$data_order) >= 0){

            $message['status'] = 'sukses';

        }else {

            $message['status'] = 'gagal';

        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function delete($id_order)
    {
        $this->load->model('order_model');

        if($this->order_model->deleteOrder($id_order)) {

            $message['status'] = 'sukses';

        }else {

            $message['status'] = 'gagal';

        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function bayar($id_order)
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');


        if($this->order_model->bayarOrder($id_order) >= 0){

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

        if($this->input->post('id_product') == '') {
            $data['inputerror'][] = 'id_product';
            $data['error_string'][] = 'Product harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('qty') == '') {
            $data['inputerror'][] = 'qty';
            $data['error_string'][] = 'Quantity harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('price') == '') {
            $data['inputerror'][] = 'price';
            $data['error_string'][] = 'Harga harus ada';
            $data['status'] = FALSE;
        }

        if($this->input->post('total') == '') {
            $data['inputerror'][] = 'total';
            $data['error_string'][] = 'Total harus ada';
            $data['status'] = FALSE;
        }
        

        if($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

}