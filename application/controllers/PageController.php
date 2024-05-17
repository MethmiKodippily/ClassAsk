<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('usermodel');
    }

	public function index()
	{
		$data['title'] = "Home";

		$this->load->view('templates/header', $data);
		$this->load->view('home');
		$this->load->view('templates/footer');
	}

	public function login()
	{
		if ($this->usermodel->is_logged_in()) {
			redirect(base_url()); 
			return;
		}

		$data['title'] = "Login";

		$this->load->view('login_view', $data);
	}

	public function register()
	{
		if ($this->usermodel->is_logged_in()) {
			redirect(base_url()); 
			return;
		}
		
		$data['title'] = "Register";

		$this->load->view('register_view', $data);
	}

    public function account()
	{
		if (!$this->usermodel->is_logged_in()) {
			redirect(base_url()); 
			return;
		}

		$data['title'] = "Account";

		$this->load->view('templates/header', $data);
		$this->load->view('account');
		$this->load->view('templates/footer');
	}
}
