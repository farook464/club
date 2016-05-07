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

class My_products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        
          $getSession = $this->session->userdata('AdmiPrettySess1');
        
        if (!$getSession) {
            redirect('admin_jsessID/login');
        }
        
        
//        $this->load->model("reviews/products_reviews");

    }
    
        public function index() {

        $data = array(
            'title' => 'Admin - Retail Genius ',
        );

        $this->load->view("template/header", $data);
        $this->load->view("royal_phones/panel/my_product/index");
        $this->load->view("template/footer");
    
    }
    
      public function stock() {
        
        $data = array(
            'title' => 'Admin - Retail Genius ',
        );
        $this->load->view("template/header", $data);
        $this->load->view("supplier/panel/my_product/stock");
        $this->load->view("template/footer");
    
    }
    
    public function no_item_viewed() {
        
        $data = array(
            'title' => 'Admin - Retail Genius ',
        );
        $this->load->view("template/header", $data);
        $this->load->view("supplier/panel/my_product/no_item_viewed");
        $this->load->view("template/footer");
    
    }
    
    
    
    
     
}