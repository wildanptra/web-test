<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Controller extends MY_Controller {

	var $header_page	= array();

    function __construct(){
		parent::__construct();
		$this->tampilan->write_view('header', 'templates/snippets/header', $this->header_page);
    }
}
