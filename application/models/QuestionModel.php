<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    function addQuestion($data)
    {
        $userId = $this->session->user_id;

        $data["user_id"] = $userId;

        return $this->db->insert('question', $data);
    }

    function getQuestions()
    {
        $userId = $this->session->user_id;

        $this->db->where('user_id', $userId);
        $res = $this->db->get('question');

        if ($res->num_rows() === 0) {
            throw new Exception("Questions not found");
        }

        $questions['questions'] = $res->result_array();

        return $questions;
    }

    function getAllQuestions()
    {
        $res = $this->db->get('question');

        if ($res->num_rows() === 0) {
            throw new Exception("Questions not found");
        }

        $questions['questions'] = $res->result_array();

        return $questions;
    }

    function updateQuestion($questionId, $data)
    {
        $userId = $this->session->user_id;

        $this->db->select('user_id');
        $this->db->from('question');
        $this->db->where('question_id', $questionId);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $question = $query->row();

            if ($question->user_id === $userId) {
                $this->db->where('question_id', $questionId);
                $this->db->update('question', $data);

                if ($this->db->affected_rows() === 1) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function deleteQuestion($questionId)
    {
        $userId = $this->session->user_id;

        $this->db->select('user_id');
        $this->db->from('question');
        $this->db->where('question_id', $questionId);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $question = $query->row();

            if ($question->user_id === $userId) {
                $this->db->where('question_id', $questionId);
                $this->db->delete('question');

                if ($this->db->affected_rows() === 1) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
