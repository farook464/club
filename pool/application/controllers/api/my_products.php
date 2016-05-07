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

require APPPATH . '/libraries/REST_Controller.php';

class my_products extends REST_Controller {

    public function __construct() {
        parent::__construct();

        /*
         * Check Session Exist 
         */
        $getSessionId = $this->session->userdata('session_id');
        $getSession = $this->session->userdata('AdmiPrettySess');

//        if (!$getSession) {
//            $this->response(array('msg' => 'You Dont have Permission to Access Sorry.'));
//            die();
//        }

        $this->load->model("royal_phones/my_products_model");
    }

    public function retrieve_products_get() {
        
        $col = array("id", "name","brand_name","supplier_name","iemi_number","price","quantity","id");
        $filter = $this->input->get();
        $getUserId = $this->session->userdata('rtLogin_userId');

        $inputs = array(
            "offset" => $filter["start"],
            "limit" => $filter["length"],
            "orderby" => $filter["order"][0]["dir"],
            "orderCol" => $col[$filter["order"][0]["column"]],
            "search" => $filter["search"]["value"],            
        );
        $data = $this->my_products_model->datatables($inputs);
        
        $newData = array();

        for ($i = 0; $i < sizeof($data["data"]); $i++) {

            $id = $data["data"][$i]["id"];
            $name = $data["data"][$i]["name"];
            $brand_name = $data["data"][$i]["brand_name"];
            $supplier_name = $data["data"][$i]["supplier_name"];
            $iemi_number = $data["data"][$i]["iemi_number"];
            $price = $data["data"][$i]["price"];
            $quantity = $data["data"][$i]["quantity"];
            
            
//            $item_edit_link = $item_id;
            $item_edit_link = base_url('admin_jsessID/panel/edit/' . $id);
            $item_delete_link = $id;

        
//           
            $newData[] = array(
                "id" => $id,
                "name" => $name,
                "brand_name" => $brand_name,
                "supplier_name" => $supplier_name,
                "iemi_number" => $iemi_number,
                "price" => $price,
                "quantity" => $quantity,
                
                
//                "item_action" => '<span> <a href="' . $item_edit_link . '"  class="do-edit btn btn-primary"> Edit</a></span> '
//                . '<span  data-product_id="' . $id . '" class="do-delete  hide btn btn-danger"> Delete</span> '
//                . '<span><button class = "btn quick_edit btn-primary" data-toggle = "modal" data-target="#quick_edit_modal" name="'.$i.'" > Quick Edit</button></span> <input value="'.$id.'" type = "hidden" id = "id_'.$i.'" />'
                             );

        }
        $is["data"] = $newData;
        $is["recordsTotal"] = $data["count"];
        $is["recordsFiltered"] = $data["count"];

        $this->response($is);
    }
    
  
  
}
