<?php
class Questions_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_questions()
    {
        $query = $this->db->get('question');
        // $query->order_by("publish_date", "DESC");
        return $query->result_array();
    }

    public function checknextquestion($slug)
    {
        //validate
        $this->db->where("slug='$slug'");
        $result = $this->db->get('question');

        //verify the user row exists
        if ($result->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_question($slug = FALSE)
    {
        //slug+1 maybe to increment through the questions in the database
        $this->db->select('*');
        $this->db->from('question');
        //if the slug has a value then the where clause is executed
        if ($slug != FALSE) {
            $this->db->where("slug='$slug'");
        }
        $this->db->order_by("slug", "ASC");
        $this->db->order_by("publish_date", "DESC");


        $query = $this->db->get();
        $result = $query->result_array();
        // print_r($result);
        // if (count($result) > 1) {
        //     print_r('loop and return the first row');
        // }

        //return the latest question
        return $result[0];
    }

    public function update_question()
    {
        $data = array(
            'question' => $this->input->post('question')
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('question', $data);
    }

    public function insert_anwsers($question_id)
    {
        $data = array(
            'answer' => $this->input->post('anwser'),
            'dummy_answer' => $this->input->post('dummy-anwser'),
            'dummy_answer2' => $this->input->post('dummy-anwser2'),
            'dummy_answer3' => $this->input->post('dummy-anwser3'),
            'question_id' => $question_id
        );
        return $this->db->insert('answer', $data);
    }

    public function get_last_question_index()
    {
        $this->db->select('*');
        $this->db->from('question');
        $query = $this->db->get();
        $result = $query->result_array();
        return $index = count($result);
        // $index = intval($index)-1;
        // // print_r($result[count($result)]['question_id']);
        // return intval($result[$index]['id']);
    }

    public function insert_question($id)
    {
        $next_row = $id + 1;
        $slug = 'q-' . $next_row;
        $data = array(
            'id' => $next_row,
            'question' => $this->input->post('question'),
            'slug' => $slug,
            'publish_date' => null
        );
        $insert_id = $this->db->insert('question', $data);
        echo $this->db->last_query();

        return $next_row;
    }


    public function update_anwsers()
    {
        //check if any of the inputs are string.empty
        //if they are don't include them in the query
        $data = array(
            'answer' => $this->input->post('anwser'),
            'dummy_answer' => $this->input->post('dummy-anwser'),
            'dummy_answer2' => $this->input->post('dummy-anwser2'),
            'dummy_answer3' => $this->input->post('dummy-anwser3'),
            'question_id' => $this->input->post('id')
        );
        $this->db->where('question_id', $this->input->post('id'));
        return $this->db->update('answer', $data);
    }


    public function delete_question($id)
    {
        $this->db->delete('user_answer', array('question_id' => $id));
        $this->db->delete('answer', array('question_id' => $id));
        $this->db->delete('question', array('id' => $id));
        return;
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
    // saves the user answer 
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
        $this->db->select("answer.answer, user_answer.answer as 'user_answer', question.question, question.id");
        $this->db->from('user_answer');
        $this->db->join('question', "user_answer.question_id = question.id");
        $this->db->join('answer', 'answer.question_id = question.id');
        $this->db->where("user_answer.user_id='$userId'");
        $query = $this->db->get();
        $arr = $query->result();

        $newArray = array();
        $index = 0;
        for ($index2 = 1; $index2 <= count($arr); $index2++) {

            print_r('checking second loop is looping index : ' . count($arr) . $index . " index 2: " . $index2);
            echo '<br/>';
            echo '<br/>';

            $row = array(
                'id' => $arr[$index]->id,
                'question' =>  $arr[$index]->question,
                'user_answer' => $arr[$index]->user_answer,
                'answer' => $arr[$index]->answer,
            );
            if ($index2 == count($arr)) {
                print_r('adding to array: [id->' . $arr[$index]->id . ' question->' .  $arr[$index]->question . ' user_anwser->' . $arr[$index]->user_answer . ' anwser->' . $arr[$index]->answer . ']' . $index . " index 2: " . $index2);
                echo '<br/>';
                echo '<br/>';
                array_push($newArray, $row);
                break;
            }
            //ifquestion id  notequal to question id +1(the next question) and 
            else if ($arr[$index]->id != $arr[$index2]->id) {
                print_r("question id  notequal to question id +1");
                echo '<br/>';

                if ($arr[$index]->question !== $arr[$index2]->question) {
                    print_r('adding to array: [id->' . $arr[$index]->id . ' question->' .  $arr[$index]->question . ' user_anwser->' . $arr[$index]->user_answer . ' anwser->' . $arr[$index]->answer . ']' . $index . " index 2: " . $index2);
                    echo '<br/>';
                    echo '<br/>';
                    array_push($newArray, $row);
                }
            }
            $index++;
            print_r($index);
        }
        //the line below is taken from https://stackoverflow.com/a/1869147
        //this is converting the array into an object
        $object = json_decode(json_encode($newArray), FALSE);
        print_r($object);
        return $object;
    }
}
