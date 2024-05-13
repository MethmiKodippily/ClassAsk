<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index()
	{
		$this->load->view('home');
	}

    public function account()
	{
		$this->load->view('account');
	}
}
