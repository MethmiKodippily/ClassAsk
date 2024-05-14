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
}
