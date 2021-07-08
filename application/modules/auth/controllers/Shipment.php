<?php 

class Shipment extends NoAuth_Controller {

    public function __construct()
    {
        $this->load->model('login_model');
        if($this->login_model->isNotLogin()) redirect('auth/login'); 
    }

    public function index()
    {
        $this->load->model('shipment_model');

        $data['judul']  = "Web Test - Shipment Process";
        $data['shipment'] =  $this->shipment_model->getShipment();

        $this->load->view('v_shipment',$data);
    }

    public function create()
    {
        $this->load->model('shipment_model');

        $this->_validation();

        $table = 'tb_shipment';

        $date_shipment          = date('Y-m-d H:i:s');
        $address                = $this->input->post('address');
        $courier_name           = $this->input->post('courier_name');


        $data_shipment = [

            'date_shipment'     => $date_shipment,
            'address'           => $address,
            'courier_name'      => $courier_name,
            
        ];

        if($this->shipment_model->insertShipment($table,$data_shipment)) {

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

        if($this->input->post('date_shipment') == '') {
            $data['inputerror'][] = 'date_shipment';
            $data['error_string'][] = 'Tanggal Pengiriman harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('address') == '') {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Alamat harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('courier_name') == '') {
            $data['inputerror'][] = 'courier_name';
            $data['error_string'][] = 'Nama Kurir harus di isi';
            $data['status'] = FALSE;
        }
        
        if($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

}