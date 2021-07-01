<?php

class Landing extends NoAuth_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function index() 
    {
        $this->load->view('landing');
    }

    
}