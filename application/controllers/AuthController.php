<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('authmodel');
    }

    public function register()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha');
        $this->form_validation->set_rules('type', 'Student or Teacher', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.user_email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('fname_error', form_error('fname'));
            $this->session->set_flashdata('lname_error', form_error('lname'));
            $this->session->set_flashdata('type_error', form_error('type'));
            $this->session->set_flashdata('email_error', form_error('email'));
            $this->session->set_flashdata('password_error', form_error('password'));
            $this->session->set_flashdata('cpassword_error', form_error('cpassword'));
            
            redirect($this->agent->referrer());
            return;
        }

        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $username = $fname . ' ' . $lname;

        $data = [
            'user_name' => $username,
            'user_type' => $this->input->post('type'),
            'user_email' => $this->input->post('email'),
            'user_password' => $this->input->post('password')
        ];

        if (!$this->authmodel->createUser($data)) {
            redirect($this->agent->referrer());
            return;
        }

        redirect(base_url('login')); 
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('email_error', form_error('email'));
            $this->session->set_flashdata('password_error', form_error('password'));

            redirect($this->agent->referrer());
            return;
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (!$this->authmodel->authenticateUser($email, $password)) {
            redirect($this->agent->referrer());
            return;
        }

        redirect(base_url());  
    }

    public function logout()
    {
        $this->session->sess_destroy();
        
        redirect(base_url());
    }
}
