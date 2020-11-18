<?php
class Questions_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_questions($slug = FALSE)
    {
        if ($slug === FALSE) {
            $query = $this->db->get('question');
            return $query->result_array();
        }
        //slug+1 maybe to increment through the questions in the database
        $query = $this->db->get_where('question', array('slug' =>
        $slug));

        // return $query->row();
        return $query->row_array();
    }

    public function get_anwsers($id = FALSE)
    {
        if ($id === FALSE) {
            return "get anwsers id = FALSE";
        }
        $query = $this->db->get_where('answer', array('question_id' =>
        $id));

        // return $query->row();
        return $query->row_array();
    }

    public function get_url()
    {
        $uri = $_SERVER['REQUEST_URI'];
        echo $uri; // Outputs: URI

        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    // saves the answers 
    public function save_answer($userId)
    {
        if ($this->input->POST('id') == NULL) {
            return "id is null";
        } else {
            $data = array(
                'answer' => $this->input->post('anwser'),
                'user_id' => $userId,
                'question_id' => $this->input->post('id')
            );
            if ($this->db->insert('user_answer', $data)) {
                return "data inserted";
            } else {
                return "data not inserted";
            }
        }
    }
    
    // returns the users results based on the userid
    public function get_results($userId)
    {
        //     $results= $this->db->query("SELECT
        //     a.answer,
        //     u.answer as 'user_answer',
        //     q.question
        // FROM
        //     `user_answer` u
        // JOIN `question` q ON
        //     u.question_id = q.id
        // JOIN `answer` a ON
        //     a.question_id = q.id
        // WHERE
        //     u.user_id ='?'",$userId)->result();

        // return $this->db->select("answer.answer, user_answer.answer as 'user_answer', question.question")
        // ->from('user_answer')
        // ->join('question', "user_answer.question_id = question.id")
        // ->join('answer', 'answer.question_id = question.id')
        // ->where("user_answer.user_id='$userId'")
        // ->get()
        // ->result();
       
        $userId = $this->session->userdata('user_id');
        $this->db->select("answer.answer, user_answer.answer as 'user_answer', question.question");
        $this->db->from('user_answer');
        $this->db->join('question', "user_answer.question_id = question.id");
        $this->db->join('answer', 'answer.question_id = question.id');
        $this->db->where("user_answer.user_id='$userId'");
        $query = $this->db->get();
        return $query->result();
    }
}
