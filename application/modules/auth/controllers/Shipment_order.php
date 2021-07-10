<?php 

class Shipment_order extends NoAuth_Controller {

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

}