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
}
