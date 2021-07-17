<?php 

class Shipment_order extends DBBuilder {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        if($this->login_model->isNotLogin()) redirect('auth/landing');
    }

    public function index()
    {

        $this->load->model('category_model');
        $this->load->model('product_model');
        $this->load->model('order_model');
        $this->load->model('shipment_model');

        $data['judul']  = "Web Test - Shipment Order";
        $data['category'] = $this->category_model->getCategory();
        $data['product']    = $this->product_model->getProduct();
        $data['order']  = $this->order_model->getOrder();
        $data['shipment']   = $this->shipment_model->getShipment();

        $this->load->view('v_shipment_order',$data);

    }

    public function get_json() {
        $this->load->library('datatables');
        $this->datatables->select('tb_shipment_order.*,
        tb_shipment_order.id_shipment_order,
        tb_order.id_order,
        tb_order.id_product,
        tb_product.name as name_product,
        tb_order.qty as qty_order,
        tb_order.price as price_order,
        tb_order.total as total_order,
        tb_order.user_id,
        tb_users.username as username_user,
        tb_order.status_order,
        tb_order.tanggal_transaksi,
        tb_shipment.id_shipment,
        tb_shipment.date_shipment,
        tb_shipment.address as address_shipment,
        tb_shipment.courier_name,
        tb_shipment.status_shipment        
        ');
        $this->datatables->from('tb_shipment_order');
        $this->datatables->join('tb_order','tb_shipment_order.id_order = tb_order.id_order');
        $this->datatables->join('tb_shipment','tb_shipment_order.id_shipment = tb_shipment.id_shipment');
        $this->datatables->join('tb_product','tb_order.id_product = tb_product.id_product');
        $this->datatables->join('tb_users','tb_order.user_id = tb_users.user_id');
        $this->datatables->add_column('no','ID-$1','id_shipment_order');
        $this->datatables->add_column(
            'action', 
            '<a href="#" class="btn btn-primary btn-sm" onclick="byid($1,\'edit\')"><i class="fa fa-edit"></i> Edit</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="byid($1,\'delete\')"><i class="fa fa-trash"></i> Delete</a>',
            'id_shipment_order'
        );
        return print_r($this->datatables->generate());
    }

    public function _getData()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');
        $this->load->model('shipment_model');
        $this->load->model('shipment_order_model');

        $results = $this->shipment_order_model->getDataTable();
        $data = [];
        $no = $_POST['start'];
        

        foreach( $results as $result ){
                $row = array();
                $row[] = ++$no;
                $row[] = $result->user_id;
                $row[] = $result->product_order;
                $row[] = $result->date_shipment;
                $row[] = $result->address_shipment;
                $row[] = $result->tanggal_transaksi;
                $row[] = $result->courier_name;
                $row[] = $result->status_shipment;
                $row[] = '
                    <a href="#" class="btn btn-primary btn-sm" onclick="byid(' . "'" . $result->id_shipment_order . "','edit'" . ')"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->id_shipment_order . "','delete'" . ')"><i class="fa fa-trash"></i> Delete</a>
                ';
                $data[] = $row;
        }

        $output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->shipment_order_model->count_all_data(),
            'recordsFiltered' => $this->shipment_order_model->count_filter_data(),
            'data' => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));

    }

    public function create()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');
        $this->load->model('shipment_model');
        $this->load->model('shipment_order_model');

        $this->_validation();

        $table = 'tb_shipment_order';

        $id_order                   = $this->input->post('id_order');
        $id_shipment                = $this->input->post('id_shipment');


        $data_shipment_order = [

            'id_order'              => $id_order,
            'id_shipment'           => $id_shipment,         
        ];

        if($this->shipment_order_model->insertShipmentOrder($table,$data_shipment_order)) {

            $message['status'] = 'sukses';

        }else {
            
            $message['status']  = 'gagal';

        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($message));

    }

    private function _validation() 
    {

        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['status'] = true;

        if($this->input->post('id_order') == '') {
            $data['inputerror'][] = 'id_order';
            $data['error_string'][] = 'Order harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('id_shipment') == '') {
            $data['inputerror'][] = 'id_shipment';
            $data['error_string'][] = 'Shipment harus di pilih';
            $data['status'] = FALSE;
        }
        
        if($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

}