<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class AnswerController extends RestController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('answermodel');
    }

    public function create_post()
    {
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('question_id', 'Question ID', 'required');
        $this->form_validation->set_rules('answer_content', 'Answer Content', 'trim|required');

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $this->response(['error' => $errors], 400);
            return;
        }

        $data = [
            'question_id' => $this->post('question_id'),
            'answer_content' => $this->post('answer_content')
        ];
    
        try {
            $result = $this->answermodel->addAnswer($data);
    
            if (!$result) {
                $this->response(['error' => 'Answer creation failed'], 500);
                return;
            }
    
            $this->response($result, 201);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function fetch_get($questionId)
    {
        try {
            $result = $this->answermodel->getAnswers($questionId);

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function update_put()
    {
        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('answer_id', 'Answer ID', 'required');
        $this->form_validation->set_rules('answer_content', 'Answer Content', 'trim|required');

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $this->response(['error' => $errors], 400);
            return;
        }

        $data = [
            'answer_content' => $this->put('answer_content')
        ];

        try {
            $result = $this->answermodel->updateAnswer($this->put('answer_id'), $data);

            if (!$result) {
                $this->response(['error' => 'Answer update not allowed'], 401);
                return;
            }

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function remove_delete($answerId)
    {
        try {
            $result = $this->answermodel->deleteAnswer($answerId);

            if (!$result) {
                $this->response(['error' => 'Answer delete not allowed'], 401);
                return;
            }

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }
}
