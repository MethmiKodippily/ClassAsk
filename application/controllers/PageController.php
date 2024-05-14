<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data['title'] = "Home";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/side_panel');
		$this->load->view('templates/top_panel');
		$this->load->view('home');
		$this->load->view('templates/footer');
	}

	public function login()
	{
		$data['title'] = "Login";

		$this->load->view('login_view', $data);
	}

	public function register()
	{
		$data['title'] = "Register";

		$this->load->view('register_view', $data);
	}

    public function account()
	{
		$this->load->view('templates/header');
		$this->load->view('account');
		$this->load->view('templates/footer');
	}
}
