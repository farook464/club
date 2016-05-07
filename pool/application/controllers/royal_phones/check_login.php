<?php

/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 * 
 * @author : Kalana Perera
 * @author Email : kalana.p@findmyfare.com
 * 
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class check_login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        /*
         * Check Session Exist 
         */
        $getSessionId = $this->session->userdata('session_id');
          $getSession = $this->session->userdata('AdmiPrettySess1');
        
        if ($getSession) {
            redirect('royal/panel');
        }

        $this->load->library('form_validation');
    }

    /*
     * Admin Login Page
     */

    public function show_login() {

        $data = array(
            'title' => 'Royal Phones ',
        );

        if ($this->input->post('createSess') == "do") {

            $this->form_validation->set_rules('user', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if (!$this->form_validation->run()) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('royal/login');
            } else {

                $this->load->model('royal_phones/user');


                $userId = $this->input->post('user');
                $userPassword = md5($this->input->post('password'));
                $getUserDetails = $this->user->getUser($userId);

                if ($getUserDetails['user_password'] == $userPassword) {

                    $getSessionId = $this->session->userdata('session_id');

                    $this->session->set_userdata('AdmiPrettySess1', rand(0, 99999));

                    $this->session->set_userdata('userName', $getUserDetails["user_first_name"]);
                    $this->session->set_userdata('rtLogin_userId', $getUserDetails["user_id"]);
                    // $this->session->set_userdata('rtLogin_userRole', $getUserDetails["user_first_name"]);
                    
                    /*
                     * Super Admin
                     */
                    if ($getUserDetails["user_role"] == "100") {
                        $this->session->set_userdata('rtLogin_perm', "admin");
                         $this->session->set_userdata('rtLogin_superAdmin', "super_admin");
						 
						 session_start();
						 $_SESSION["rtLogin_superAdmin"] = "!__";
						 
                    } 
                    
                    /*
                     * Admin
                     */
                    else if ($getUserDetails["user_role"] == "1") {
                        $this->session->set_userdata('rtLogin_perm', "admin");
                    } 

                    /*
                     * Banned Users
                     */
                    
                    else{
                        $this->session->set_userdata('rtLogin_perm', "banned");
                    }

                    $is = $this->session->userdata('AdmiPrettySess');

                    redirect('royal/panel');
                    
                } else {

                    $this->session->set_flashdata('error', "User Name or Passsowrd errror");
                    redirect('royal/login');
                }
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('royal_phones/login/index');
        $this->load->view('template/footer');
    }

}
