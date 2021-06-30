<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends NoAuth_Controller {

	public function index()
	{
		redirect('auth/login');
		$this->load->view('welcome_message');
	}

	public function not_found() {
		echo "Page Not Found";
	}

	public function home()
	{
		$this->load->view('welcome_message');
	}
}
