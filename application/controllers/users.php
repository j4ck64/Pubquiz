<?php
class Users extends CI_Controller
{

    public function register()
    {
        $data['title'] = 'register';

        $this->form_validation->set_rules('email', 'email', 'required|callback_check_email_contains|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[20]');
        $this->form_validation->set_rules('password2', 'Confirm password', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            //encrypt password
            $enc_password = md5($this->input->post('password'));

            $this->User_model->register($enc_password);

            $this->session->set_flashdata(
                'user_registered',
                'You are now registered! /n you may now log in'
            );

            // return to login page
            redirect('users/login');
        }
    }

    public function check_email_contains($email)
    {
        $this->form_validation->set_message(
            'check_email_contains',
            'make sure the email contains @.
            Please try again'
        );
        if (strpos($email, '@')) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $this->form_validation->set_message(
            'check_email_exists',
            'That email is taken.
            Please choose a different one'
        );
        if ($this->User_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        echo $this->session->userdata('user_id');
        $data['title'] = 'login';

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {
            //get email
            $email = $this->input->post('email');
            //get and encrypt password
            $password = md5($this->input->post('password'));

            //Login user
            $user_id = $this->User_model->login($email, $password);
            // if the user exists then it will create a session
            if ($user_id) {
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'email' => $email,
                    'admin' => $this->User_model->verify_user_privilages($email),
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);

                $this->session->set_flashdata(
                    'user_loggedin',
                    'You are now logged in'
                );
                //If the user is an admin
                if ($this->session->userdata("admin")) {
                    redirect('questions/browse');
                } else {
                    // redirect to questions
                    redirect('questions');
                }
            } else {
                $this->session->set_flashdata(
                    'login_failed',
                    'Login is invalid'
                );
                redirect('users/login');
            }
        }
    }
    // log user out
    public function logout()
    {
        // unset user data

        $array_items = array('user_id' => '', 'username' => '', 'logged_in' => '', 'admin' => '');
        $this->session->unset_userdata($array_items);

        // $this->session->unset_userdata('logged_in');
        // $this->session->unset_userdata('user_id');
        // $this->session->unset_userdata('username');
        $this->session->set_flashdata(
            'user_loggedout',
            'You are now logged out'
        );

        redirect('users/login');
    }

    public function save_user_anwser()
    {
        $this->Questions_model->save_anwser($this->session->userdata('user_id'));
    }
}
