<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class QuestionController extends RestController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('questionmodel');
    }

    public function create_post()
    {
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('question_title', 'Question Title', 'trim|required');
        $this->form_validation->set_rules('question_content', 'Question Content', 'trim|required');

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $this->response(['error' => $errors], 400);
            return;
        }

        $data = [
            'question_title' => $this->post('question_title'),
            'question_content' => $this->post('question_content')
        ];
    
        try {
            $result = $this->questionmodel->addQuestion($data);
    
            if (!$result) {
                $this->response(['error' => 'Question creation failed'], 500);
                return;
            }
    
            $this->response($result, 201);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function user_get()
    {
        try {
            $result = $this->questionmodel->getQuestions();

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function all_get()
    {
        try {
            $result = $this->questionmodel->getAllQuestions();

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function update_put()
    {
        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('question_id', 'Question ID', 'required');
        $this->form_validation->set_rules('question_title', 'Question Title', 'trim|required');
        $this->form_validation->set_rules('question_content', 'Question Content', 'trim|required');

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $this->response(['error' => $errors], 400);
            return;
        }

        $data = [
            'question_title' => $this->put('question_title'),
            'question_content' => $this->put('question_content')
        ];

        try {
            $result = $this->questionmodel->updateQuestion($this->put('question_id'), $data);

            if (!$result) {
                $this->response(['error' => 'Question update not allowed'], 401);
                return;
            }

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function remove_delete($questionId)
    {
        try {
            $result = $this->questionmodel->deleteQuestion($questionId);

            if (!$result) {
                $this->response(['error' => 'Question delete not allowed'], 401);
                return;
            }

            $this->response($result, 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }
}
