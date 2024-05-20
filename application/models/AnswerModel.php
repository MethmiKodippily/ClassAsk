<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnswerModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    function addAnswer($data)
    {
        $userId = $this->session->user_id;

        $data["user_id"] = $userId;

        return $this->db->insert('answer', $data);
    }

    function getAnswers($questionId)
    {
        $this->db->where('question_id', $questionId);
        $res = $this->db->get('answer');

        if ($res->num_rows() === 0) {
            throw new Exception("Answers not found");
        }

        $answers['answers'] = $res->result_array();

        return $answers;
    }

    function updateAnswer($answerId, $data)
    {
        $userId = $this->session->user_id;

        $this->db->select('user_id');
        $this->db->from('answer');
        $this->db->where('answer_id', $answerId);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $answer = $query->row();

            if ($answer->user_id === $userId) {
                $this->db->where('answer_id', $answerId);
                $this->db->update('answer', $data);

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

    function deleteAnswer($answerId)
    {
        $userId = $this->session->user_id;

        $this->db->select('user_id');
        $this->db->from('answer');
        $this->db->where('answer_id', $answerId);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $answer = $query->row();

            if ($answer->user_id === $userId) {
                $this->db->where('answer_id', $answerId);
                $this->db->delete('answer');

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
