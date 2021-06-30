<?php

class Landing extends NoAuth_Controller {


    function index() {

        
        $this->load->view('landing');
    }

    
}