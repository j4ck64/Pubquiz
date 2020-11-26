<?php
class Questions extends CI_Controller
{
    public function index()
    {
        //Check user is logged in 
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $data['question'] = $this->Questions_model->get_question();
        //insert this in checknextquestion
        //remove the q- and return the number
        $current_slug = str_replace("q-", "", $data['question']['slug']);
        $num = intval($current_slug) + 1;
        $possible_slug = 'q-' . $num;
        ///
        //check if their is  more than 1 question
        if ($this->Questions_model->checknextquestion($possible_slug)) {
            print_r("there's a question after this one.");
            $data['slug'] = $possible_slug;
        } else {
            print_r("there's no question after this one.");
            $data['slug'] = 'result';
        }
        print_r($data['question']);
        $data['anwsers'] = $this->Questions_model->get_anwsers($data['question']['id']);
        // print_r($data['anwsers']);

        $this->load->view('questions/index', $data);
        $this->load->view('templates/header');
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        //Check user is logged in 
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        if ($slug != null) {
            $data['question'] = $this->Questions_model->get_question($slug);
            //remove 'q-'
            $slug = str_replace("q-", "", $slug);
            // check if there's another question if not set the slug to next page
            if ($this->Questions_model->checknextquestion($slug . 1)) {
                $data['slug'] = $slug + 1;
            } else {
                $data['slug'] = 'result';
            }
            $data['anwsers'] = $this->Questions_model->get_anwsers($data['question']['id']);

            $this->load->view('questions/index', $data);
            $this->load->view('templates/header');
            // loads the corresponding posts view
            $this->load->view('templates/footer');
        }
    }

    public function result()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        print_r($this->session->userdata('user_id'));
        $data['questions'] = $this->Questions_model->get_results($this->session->userdata('user_id'));
        $this->load->view('templates/header');
        $this->load->view('questions/result', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    public function delete_question()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        if (!$this->session->userdata('admin')) {
            redirect('users/login');
        }
        $id = $this->input->get("id");
        $slug = $this->input->get("slug");

        $this->Questions_model->delete_question($id);
        print_r('question deleted id:' . $id . " slug: " . $slug);
    }

    public function browse()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        if (!$this->session->userdata('admin')) {
            redirect('users/login');
        }
        $data['title'] = "Edit Questions";
        $data['questions'] = $this->Questions_model->get_questions();

        if ($this->delete_question()) {
        }

        $this->load->view('templates/header');
        $this->load->view('questions/browse', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }



    public function edit($slug = null)
    {
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('users/login');
        // }
        // if (!$this->session->userdata('admin')) {
        //     redirect('users/login');
        // }
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
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('users/login');
        // }
        // if (!$this->session->userdata('admin')) {
        //     redirect('users/login');
        // }
        // $anwser = $this->input->get('anwser');
        // $dummy_anwser = $this->input->get('dummy_anwser');
        // $dummy_anwser2 = $this->input->get('dummy_anwser2');
        // $dummy_anwser3 = $this->input->get('dummy_anwser3');
        $this->Questions_model->update_question();
        $this->Questions_model->update_anwsers();
        redirect("questions/browse");
        // echo $this->db->last_query();
    }

    public function create()
    {
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('users/login');
        // }
        // if (!$this->session->userdata('admin')) {
        //     redirect('users/login');
        // }
        $data['title'] = "Create Question";

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
        }
    }

    public function insert()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        // if (!$this->session->userdata('admin')) {
        //     redirect('users/login');
        // }
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
