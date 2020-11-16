<?php
class Users extends CI_Controller
{

    public function register()
    {
        $data['title'] = 'register';

        $this->form_validation->set_rules('email', 'email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm password', 'matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            // die('continue');
            //encrypt password
            $enc_password = md5($this->input->post('password'));

            $this->User_model->register($enc_password);

            $this->session->set_flashdata(
                'user_registered',
                'You are now registered! /n you may now log in'
            );

            // return to login page
            redirect(base_url());
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
            // if their is a user id then it will create a session
            if ($user_id) {
                // die('Success');
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'email' => $email,
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);

                $this->session->set_flashdata(
                    'user_loggedin',
                    'You are now logged in'
                );
                // redirect to questions
                redirect('questions');
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
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->set_flashdata(
            'user_loggedout',
            'You are now logged out'
        );

        redirect('users/login');
    }

    public function save()
    {
        if ($this->Questions_model->save_answer($this->session->userdata('user_id')) == "data inserted") {
            // $this->load->helper('url');
        }
    }
}
