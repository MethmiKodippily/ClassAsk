<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    function is_logged_in()
    {
        if (isset($this->session->is_logged_in) && $this->session->is_logged_in == True) {
            return True;
        }
        else {
            return False;
        }
    }

    function getUserDetails()
    {
        $userId = $this->session->user_id;

        $this->db->select('user_name, user_email, user_type, created_at');
        $this->db->where('user_id', $userId);
        $res = $this->db->get('user');

        if ($res->num_rows() != 1) {
            throw new Exception("User details not found");
        }

        $row = $res->row();

        $nameParts = explode(' ', $row->user_name);
        $userData['first_name'] = isset($nameParts[0]) ? $nameParts[0] : '';
        $userData['last_name'] = isset($nameParts[1]) ? $nameParts[1] : '';

        $userData['user_email'] = $row->user_email;

        $userData['created_at'] = date("F j, Y, g:i A", strtotime($row->created_at));

        $userData['user_type'] = ($row->user_type == 's') ? 'Student' : 'Teacher';

        return $userData;
    }

    function updateUserDetails($data)
    {
        $userId = $this->session->user_id;

        $this->db->where('user_id', $userId);
        $this->db->update('user', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
