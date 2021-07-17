<?php

class Shipment extends NoAuth_Controller
{

    public function __construct()
    {
        $this->load->model('login_model');
        if ($this->login_model->isNotLogin()) redirect('auth/login');
    }

    public function index()
    {
        $this->load->model('shipment_model');
        $this->load->model('order_model');

        $data['judul']  = "Web Test - Shipment Process";
        $data['shipment'] =  $this->shipment_model->getShipment();
        $data['order']  = $this->order_model->getOrder();

        $this->load->view('v_shipment', $data);
    }

    public function get_json()
    {
        $this->load->library('datatables');
        $this->datatables->select('tb_shipment.*,tb_shipment.id_shipment,tb_shipment.date_shipment,tb_shipment.address,tb_shipment.courier_name,tb_shipment.grandtotal,tb_shipment.status_shipment');
        $this->datatables->from('tb_shipment');
        $this->datatables->where('status_shipment', 'proses');
        $this->datatables->add_column('no', 'ID-$1', 'id_shipment');
        $this->datatables->add_column(
            'action',
            '<a href="#" class="btn btn-primary btn-sm" onclick="byid($1,\'edit\')"><i class="fa fa-edit"></i> Edit</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="byid($1,\'delete\')"><i class="fa fa-trash"></i> Delete</a>',
            'id_shipment'
        );
        return print_r($this->datatables->generate());
    }

    public function create()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');
        $this->load->model('shipment_model');

        $this->_validation();

        if($this->shipment_model->insertShipmentOrder() == false){

            $message['status'] = 'sukses';

        }else{

            $message['status']  = 'gagal';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function update()
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');
        $this->load->model('shipment_model');

        $this->_validation();

        $date_shipment              = $this->input->post('date_shipment',true);
        $address                    = $this->input->post('address',true);
        $courier_name               = $this->input->post('courier_name',true);
        $grandtotal                 = $this->input->post('grandtotal',true);
        $status_shipment            = $this->input->post('status_shipment',true);

        $data_shipment = [

            'date_shipment'     => $date_shipment,
            'address'           => $address,
            'courier_name'      => $courier_name,
            'grandtotal'        => $grandtotal,
            'status_shipment'   => $status_shipment,

        ];

        if ($this->shipment_model->updateShipment(array('id_shipment' => $this->input->post('id_shipment')), $data_shipment) >= 0) {

            $message['status'] = 'sukses';
        } else {

            $message['status'] = 'gagal';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function delete($id_shipment)
    {
        $this->load->model('shipment_model');

        if ($this->shipment_model->deleteShipment($id_shipment)) {

            $message['status'] = 'sukses';
        } else {

            $message['status'] = 'gagal';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function byid($id_shipment)
    {
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('order_model');
        $this->load->model('shipment_model');

        $data = $this->shipment_model->getDataById($id_shipment);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }



    private function _validation()
    {

        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['status'] = true;

        if ($this->input->post('date_shipment') == '') {
            $data['inputerror'][] = 'date_shipment';
            $data['error_string'][] = 'Tanggal Pengiriman harus di pilih';
            $data['status'] = FALSE;
        }

        if ($this->input->post('address') == '') {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Alamat harus di isi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('courier_name') == '') {
            $data['inputerror'][] = 'courier_name';
            $data['error_string'][] = 'Nama Kurir harus di isi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('id_order') == '') {
            $data['inputerror'][] = 'id_order';
            $data['error_string'][] = 'Harus memilih order yang mau di bawa';
            $data['status'] = FALSE;
        }

        if ($this->input->post('grandtotal') == '') {
            $data['inputerror'][] = 'grandtotal';
            $data['error_string'][] = 'Belum ada order yang di pilih untuk di bawa';
            $data['status'] = FALSE;
        }

        if ($this->input->post('status_shipment') == '') {
            $data['inputerror'][] = 'status_shipment';
            $data['error_string'][] = 'Status Pengiriman harus di isi';
            $data['status'] = FALSE;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}
