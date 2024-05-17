<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class UserController extends RestController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usermodel');
    }

    public function status_get()
    {
        try {
            $status = $this->usermodel->is_logged_in();

            $result = array('is_logged_in' => $status);

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function details_get()
    {
        try {
            $result = $this->usermodel->getUserDetails();

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function update_put ()
    {
        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha');

        $email = $this->put('user_email');

        $userData = $this->usermodel->getUserDetails();

        $storedEmail = $userData['user_email'];

        if ($email && $email !== $storedEmail
        ) {
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[user.user_email]');
        }

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $this->response(['error' => $errors], 400);
            return;
        }

        $fname = $this->put('first_name');
        $lname = $this->put('last_name');
        $username = $fname . ' ' . $lname;

        $data = [
            'user_name' => $username,
            'user_email' => $email
        ];

        try {
            $result = $this->usermodel->updateUserDetails($data);

            if (!$result) {
                $this->response(['error' => 'User details not found'], 404);
                return;
            }

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }
}
