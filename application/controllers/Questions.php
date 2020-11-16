<?php
class Questions extends CI_Controller
{
    public function index()
    {
        //Check user is logged in 
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $data['question'] = $this->Questions_model->get_questions('q-1');
        // print_r($data['question']['id']);     
        //    echo '<br/>';

        // print('count'.count($data['question']));

        //check if their is  more than 1 question
        if (count($data['question']) > 1) {

            $data['slug'] = 'q-2';
        } else {
            $data['slug'] = 'result';
        }

        // print_r($this->Questions_model->get_url());
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
            $data['question'] = $this->Questions_model->get_questions($slug);
            //remove 'q-'
            $slug = str_replace("q-", "", $slug);
            // check if there's another question if not set the slug to next page
            if ($slug + 1 > count($data['question'])) {
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
        $this->load->view('templates/header');
        $this->load->view('questions/result');
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }
 
}
