<?php
class Questions extends CI_Controller
{

    //functions
    //Check user is logged in 
    private function verify_user_signin()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        } else {
            return;
        }
    }
    //check user is an admin
    private function verify_user_privilages()
    {
        if (!$this->session->userdata('admin')) {
            redirect('users/login');
        } else {
            return;
        }
    }

    private function check_for_next_question($slug)
    {
        ///
        //check if there's more than 1 question
        if (!empty($this->Questions_model->checknextquestion($slug))) {
            print_r("there's a question after this one.");
            return $slug;
        } else {
            print_r("there's no question after this one.");
            return 'result';
        }
        // print_r($data['question']);
    }

    public function index()
    {
        $this->verify_user_signin();
        $data['question'] = $this->Questions_model->get_question();

        $data['anwsers'] = $this->Questions_model->get_anwsers($data['question']['id']);
        //check next question
        $slug = $data['question']['slug'];
        print_r('before' . $data['question']['slug']);

        $data['question']['slug'] =  $this->Questions_model->checknextquestion($slug);
        print_r('after' . $data['question']['slug']);
        $this->load->view('questions/index', $data);
        $this->load->view('templates/header');
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $this->verify_user_signin();
        if ($slug != null) {
            $data['question'] = $this->Questions_model->get_question($slug);
            //remove 'q-'
            $slug = str_replace("q-", "", $slug);
            // // check if there's another question if not set the slug to next page

            $data['question']['slug'] =  $this->Questions_model->checknextquestion($slug);

            // if ($this->Questions_model->checknextquestion($slug . 1)) {
            //     $data['slug'] = $slug + 1;
            // } else {
            //     $data['slug'] = 'result';
            // }
            $data['anwsers'] = $this->Questions_model->get_anwsers($data['question']['id']);

            $this->load->view('questions/index', $data);
            $this->load->view('templates/header');
            // loads the corresponding posts view
            $this->load->view('templates/footer');
        }
    }

    public function result()
    {
        $this->verify_user_signin();
        // print_r($this->session->userdata('user_id'));
        $data['questions'] = $this->Questions_model->get_results($this->session->userdata('user_id'));
        $this->load->view('templates/header');
        $this->load->view('questions/result', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    //admin pages

    public function browse()
    {
        $this->verify_user_signin();
        $this->verify_user_privilages();
        $data['title'] = "Edit Questions";
        $data['questions'] = $this->Questions_model->get_questions();

        $this->Questions_model->delete_question();

        $this->load->view('templates/header');
        $this->load->view('questions/browse', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    public function edit($slug = null)
    {
        $this->verify_user_signin();
        $this->verify_user_privilages();
        $data['title'] = "Edit Questions";
        $data['question'] = $this->Questions_model->get_question($slug);
        $data['anwsers'] = $this->Questions_model->get_anwsers($data['question']['id']);

        $this->form_validation->set_rules('question', 'question', 'required');
        // $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() === FALSE) {

            $this->load->view('templates/header');
            $this->load->view('questions/edit', $data);
            // loads the corresponding posts view
            $this->load->view('templates/footer');
        } else {
        }
    }

    public function update()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        if (!$this->session->userdata('admin')) {
            redirect('users/login');
        }
        $this->Questions_model->update_question();
        $this->Questions_model->update_anwsers();
        redirect("questions/browse");
        // echo $this->db->last_query();
    }

    public function create()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        if (!$this->session->userdata('admin')) {
            redirect('users/login');
        }

        $data['title'] = "Create Question";

        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('anwser', 'anwser', 'required');
        $this->form_validation->set_rules('dummy-anwser', 'dummy-anwser', 'required');
        $this->form_validation->set_rules('dummy-anwser2', 'dummy-anwser2', 'required');
        $this->form_validation->set_rules('dummy-anwser3', 'dummy-anwser3', 'required');

        if ($this->form_validation->run() === FALSE) {
            $id = $this->Questions_model->get_last_question_index();
            print_r($id);
            $id = $id++;
            $slug = 'q-' . $id;
            $this->load->view('templates/header');
            $this->load->view('questions/create', $data);
            // loads the corresponding posts view
            $this->load->view('templates/footer');
        } else {
            $last_row = $this->Questions_model->get_last_question_index();
            // $id = $id++;
            $next_row = $last_row + 1;
            $slug = 'q-' . $next_row;
            $question_id = $this->Questions_model->insert_question($last_row);
            //echo $this->db->last_query();
            $this->Questions_model->insert_anwsers($question_id);
            redirect("questions/browse");
        }
    }
}
