<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    function createUser($data)
    {
        $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);

        return $this->db->insert('user', $data);
    }

    function authenticateUser($email, $password)
    {
        $res = $this->db->get_where('user', array('user_email' => $email), 1);

        if ($res->num_rows() != 1) {
            return false;
        }

        $row = $res->row();
        $hashedPassword = $row->user_password;

        if (password_verify($password, $hashedPassword)) {
            $this->session->is_logged_in = true;
            $this->session->user_type = $row->user_type;
            return true;
        }
        else {
            return false;
        }
    }
}
