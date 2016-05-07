<?php

/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 * 
 * @author : Mohammed Farook
 * @author Email : farook.m@findmyfare.lk
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

ini_set("pcre.backtrack_limit", "23001337");
ini_set("pcre.recursion_limit", "23001337");

class admin_panel extends CI_Controller {

    public function __construct() {
        parent::__construct();

        /*
         * Check Admin Session 
         */
        $getSessionId = $this->session->userdata('session_id');
        $getSession = $this->session->userdata('AdmiPrettySess1');
        
//        if (!$getSession) {
//            redirect('admin_jsessID/login');
//        }

        //echo $this->session->userdata("rtLogin_perm");
        //die();
    }

    /*
     * @Teting API and Normal Controller Speed.
     */

    public function logout() {

        $this->session->sess_destroy();

        redirect('royal/');
    }

    public function index() {

        $data = array(
            'title' => 'ROYAL PHONES ',
        );

        $this->load->view("template/header", $data);
        $this->load->view("mobile_index");
//        $this->load->view("supplier/panel/index");
        $this->load->view("template/footer");
    }

    


    public function delete_product_v2() {

        $this->load->model("supplier/my_products_model");

        $userid = $this->session->userdata('rtLogin_userId');
        $reason = $this->input->post('reason');
        $req_type_id = $this->input->post('id');
        $comment = "Product Delete:" . $reason;
        $update_description = "Confirm Delete";
        //track update
        $update = array(
            'update_description' => $update_description,
            'comment' => $comment,
            'userid' => $userid
        );
        $this->my_products_model->update_products($update);

        //track product delete
        $request_type = 1;
        $request_for = 100;
        $request = array(
            'request_type' => $request_type,
            'request_by' => $userid,
            'request_for' => $request_for,
            'req_type_id' => $req_type_id,
        );
        $this->my_products_model->request_delete_products($request);
    }
    
     public function sales_by_duration() {
        $data = array(
            'title' => 'Sales Report ',
        );

        $this->load->view("template/header", $data);
        $this->load->view("supplier/panel/sales/sales_by_duration");
        $this->load->view("template/footer");
    }
    
     public function most_sales_of_month() {
        $data = array(
            'title' => 'Sales Report ',
        );

        $this->load->view("template/header", $data);
        $this->load->view("supplier/panel/sales/most_sales_of_month");
        $this->load->view("template/footer");
    }

}
