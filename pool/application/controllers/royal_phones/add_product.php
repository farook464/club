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

class add_product extends CI_Controller {

    public function __construct() {
        parent::__construct();
          $getSession = $this->session->userdata('AdmiPrettySess1');
        
        if (!$getSession) {
            redirect('admin_jsessID/login');
        }
//        
        $this->load->model('manage/manage_product');


        //echo $this->session->userdata("rtLogin_perm");
        //die();
    }

    /*
     * @Teting API and Normal Controller Speed.
     */


    public function product_add(){
  
        if (!$this->session->userdata('uniqProd')) {
            $this->session->set_userdata('uniqProd', strtoupper(rand(10000, 999999) . uniqid()));
        }
        
       
        if ($this->input->post()) {
             
//            var_dump($this->input->post());die();
            
            $this->load->library('form_validation');
            
               $this->form_validation->set_rules('product_name', 'product name', 'required');
//        $this->form_validation->set_rules('product_desc[product_details]', 'Product Description', 'required');
        $this->form_validation->set_rules('product_price', 'Product Price ', 'required');
        $this->form_validation->set_rules('product_supplier_note', 'Product Supplier  ', 'required');
        $this->form_validation->set_rules('product_q', ' Product Quantity  ', 'required');
//        $this->form_validation->set_rules('product_category_edit', 'Product Category ', 'required');
//
//        $this->form_validation->set_rules('product_sub_cats', 'Product Sub Catgeory', 'required');
        $this->form_validation->set_rules('product_location', 'Product Location ', 'required');
        $this->form_validation->set_rules('product_delivery', 'Product Delivery ', 'required');
//        $this->form_validation->set_rules('product_payment_option', 'Product Payment Options ', 'required');

            
            if ($this->form_validation->run()) {

//                $productTag_ttl = strtolower($this->input->post("product_name"));
//                $productTag_ttl = preg_replace('/[^a-z0-9 ]+/', '', $productTag_ttl);
//                //$productTag_ttl = str_replace(' ', ' ', $productTag_ttl);
//
//                $createTitleAsTag = $this->manage_products->get_product_tag_or_create($productTag_ttl);
//
//                $getCreatedTagId = $this->session->userdata("TagId");
//
//                $this->load->helper("product");
//
//                $data_description = $this->input->post("product_desc");
//
//                $image_path = $_SERVER['DOCUMENT_ROOT'] . '/product_image_lib/automated/';
//
//
//                $main_description = cloneContentImages($data_description["product_details"], $image_path, 'pdesc_' . uniqid());
//                $tech_details = cloneContentImages($data_description["tech_details"], $image_path, 'tdesc_' . uniqid());
//
//                $setDesc = array("product_details" => $main_description, "tech_details" => $tech_details);

                /*
                 * MARGIN , MARKUP UPDATE
                 */

                $commission_type = 0; // 0 =  undefined
                // 1 = MARGIN
                // 2 = MARKUP

                $commission_type_per = 0;
                $commission_type_value = 0;
                $product_price = 0;

                $MARK_UP = $this->input->post('x_product_price');

                $MARGIN = $this->input->post('y_product_price');

                if (empty($MARK_UP)) {
                    $commission_type = 1;
                    $commission_type_per = $this->input->post('y_margin_1');
                    $commission_type_value = $this->input->post('y_margin_2');
                    $product_price = $this->input->post('y_product_price');
                } else {
                    $commission_type = 2;
                    $commission_type_per = $this->input->post('x_mark_up_1');
                    $commission_type_value = $this->input->post('x_mark_up_2');
                    $product_price = $this->input->post('x_product_price');
                }

                $commission_data = array(
                    'a' => $commission_type,
                    'b' => $commission_type_per,
                    'c' => $commission_type_value,
                    'd' => $product_price
                );

                /*
                 * end margin / markup process
                 */


                /*
                 * Product Insert
                 * 
                 * Return Last Insert Id As Session
                 * 
                 * How To Use
                 * ----------
                 * $this->session->userdata("lastID")
                 */

                   

                $do = $this->manage_product->insert_product($this->input->post(), $commission_data);

//                var_dump($do);die('kosala');
                if ($do) {

                    $productID = (int) $this->session->userdata("lastID");

                    $delivery_options = $this->input->post("product_delivery");


                    

                    for ($z = 0; $z < sizeof($delivery_options); $z++) {
                        //echo $z.'<br/>';
                        $this->manage_product->save_product_to_delivery($productID, $delivery_options[$z]);
                    }

                    //  die();


                    $get_all_versions = $this->input->post("version");
                    
                    

                    for ($j = 0; $j < sizeof($get_all_versions); $j++) {

                        $v_name = $get_all_versions[$j]["name"];
                        $v_price = $get_all_versions[$j]["price"];

                        if ($v_name != "" && $v_price != "") {
                            $this->manage_product->save_product_version($productID, $get_all_versions[$j]);
                        }
                    }


//                    $mainCatID = $this->input->post("product_category");
//                    $this->manage_products->save_product_to_category($productID, $mainCatID);
//
//                    for ($i = 0; $i < sizeof($this->input->post("product_sub_cats")); $i++) {
//
//                        $data = $this->input->post("product_sub_cats")[$i];
//
//                        $this->manage_products->save_product_to_category($productID, $data);
//                    }

//                    $subcats = $this->input->post("product_tags_all");
//
//                    $this->manage_products->save_product_to_tags($productID, $getCreatedTagId);
//
//                    for ($j = 0; $j < sizeof($subcats); $j++) {
//                        $this->manage_products->save_product_to_tags($productID, $subcats[$j]);
//                    }

                    $this->session->unset_userdata('uniqProd');
//                    echo " <pre>";
//                    var_dump($this->input->post("product_tags_all"));
//                    echo "</pre>";
//                    die();
                    $this->session->set_flashdata("process_done", "successfully added");
                    redirect("admin_jsessID/panel/add-product");
                } else {
//
                    $this->session->set_flashdata("process_error", "something went to wrng");
                    redirect("admin_jsessID/panel/add-product");
                }
            } else {

                $this->session->set_flashdata("process_error", validation_errors());
                redirect("admin_jsessID/panel/add-product");
            }
        }
        
        
        
        
        $data = array(
            'title' => 'Royal Phones ',
        );
        
        

        $this->load->view("template/header", $data);
        $this->load->view("royal_phones/panel/add_product");
        $this->load->view("template/footer");
        

        
    }
    
    public function product_details() {
        $id = $this->input->post('product_id');
        if (!($id == 0)) {
            $product_desc = $this->manage_product->product_details_get($id);

            $data_json = json_decode($product_desc[0]["description"], TRUE);
        }
        echo json_encode($data_json);
    }
    public function city_name() {

        $dis_id = $this->input->post('dis_id');
        if ($dis_id) {
            $city = $this->manage_product->get_cities($dis_id);
        }
        echo json_encode($city);
    }
    
    public function product_edit($id){
        
        $data = array(
            'title' => 'Admin - Retail Genius ',
        );
        
        $get_product_id = $id;
        
        $product_data = $this->manage_product->get_product_details($get_product_id);
        $product_id = $product_data[0]["item_description"];
        $product_details_data = $this->manage_product->get_product($product_id);
        $get_versions = $this->manage_product->get_product_version_by_id($get_product_id);
//        
        $tab_all = array('id'=>$get_product_id,'product_data' => $product_details_data , 'other_tab' => $product_data,'version' => $get_versions);
        
       
//        $get_details = $this->manage_product->product_by_id($get_product_id);
//
//        $get_versions = $this->manage_product->get_product_version_by_id($get_product_id);
//         var_dump($get_details);die();
//        var_dump($get_versions);die();
        
        $this->load->view("template/header", $data);
        $this->load->view("supplier/panel/edit_product",$tab_all);
//        $this->load->view("supplier/panel/edit_product",array("data" => $get_details, "get_id" => $get_product_id, "version_data" => $get_versions));
        $this->load->view("template/footer");
        
    }
    
//    public function product_update(){
//        
////        var_dump($this->input->post('id'));die('kosala');
//        
//        if($this->input->post()){
//            
//            $this->load->library('form_validation');
//            
//            $this->form_validation->set_rules('product_name', 'product name', 'required');
////            $this->form_validation->set_rules('product_desc[product_details]', 'Product Description', 'required');
//            $this->form_validation->set_rules('product_price', 'Product Price ', 'required');
////            $this->form_validation->set_rules('product_supplier', 'Product Supplier  ', 'required');
////            $this->form_validation->set_rules('product_manufacture', ' Product Manufacture ', 'required');
////            $this->form_validation->set_rules('product_category', 'Product Category ', 'required');
//
////            $this->form_validation->set_rules('product_sub_cats', 'Product Sub Catgeory', 'required');
////            $this->form_validation->set_rules('product_tags_all', 'Product Tags ', 'required');
//            $this->form_validation->set_rules('product_delivery', 'Product Delivery ', 'required');
//            $this->form_validation->set_rules('product_payment_option', 'Product Payment Options ', 'required');
//            
//            
//            if ($this->form_validation->run()) {
//
////                $productTag_ttl = strtolower($this->input->post("product_name"));
////                $productTag_ttl = preg_replace('/[^a-z0-9 ]+/', '', $productTag_ttl);
////                //$productTag_ttl = str_replace(' ', ' ', $productTag_ttl);
////
////                $createTitleAsTag = $this->manage_products->get_product_tag_or_create($productTag_ttl);
////
////                $getCreatedTagId = $this->session->userdata("TagId");
////
////                $this->load->helper("product");
////
////                $data_description = $this->input->post("product_desc");
////
////                $image_path = $_SERVER['DOCUMENT_ROOT'] . '/product_image_lib/automated/';
////
////
////                $main_description = cloneContentImages($data_description["product_details"], $image_path, 'pdesc_' . uniqid());
////                $tech_details = cloneContentImages($data_description["tech_details"], $image_path, 'tdesc_' . uniqid());
////
////                $setDesc = array("product_details" => $main_description, "tech_details" => $tech_details);
//
//                /*
//                 * MARGIN , MARKUP UPDATE
//                 */
//
//                $commission_type = 0; // 0 =  undefined
//                // 1 = MARGIN
//                // 2 = MARKUP
//
//                $commission_type_per = 0;
//                $commission_type_value = 0;
//                $product_price = 0;
//
//                $MARK_UP = $this->input->post('x_product_price');
//
//                $MARGIN = $this->input->post('y_product_price');
//
//                if (empty($MARK_UP)) {
//                    $commission_type = 1;
//                    $commission_type_per = $this->input->post('y_margin_1');
//                    $commission_type_value = $this->input->post('y_margin_2');
//                    $product_price = $this->input->post('y_product_price');
//                } else {
//                    $commission_type = 2;
//                    $commission_type_per = $this->input->post('x_mark_up_1');
//                    $commission_type_value = $this->input->post('x_mark_up_2');
//                    $product_price = $this->input->post('x_product_price');
//                }
//
//                $commission_data = array(
//                    'a' => $commission_type,
//                    'b' => $commission_type_per,
//                    'c' => $commission_type_value,
//                    'd' => $product_price
//                );
//
//                /*
//                 * end margin / markup process
//                 */
//
//
//                /*
//                 * Product Insert
//                 * 
//                 * Return Last Insert Id As Session
//                 * 
//                 * How To Use
//                 * ----------
//                 * $this->session->userdata("lastID")
//                 */
//
//                   
//
//                $do = $this->manage_product->update_product($this->input->post(), $commission_data);
//
////                var_dump($do);die('kosala');
//                if ($do) {
//
//                    $productID = (int) $this->session->userdata("lastID");
//
//                    $delivery_options = $this->input->post("product_delivery");
//
//
//                    
//
//                    for ($z = 0; $z < sizeof($delivery_options); $z++) {
//                        //echo $z.'<br/>';
//                        $this->manage_product->save_product_to_delivery($productID, $delivery_options[$z]);
//                    }
//
//                    //  die();
//
//
//                    $get_all_versions = $this->input->post("version");
//
//                    for ($j = 0; $j < sizeof($get_all_versions); $j++) {
//
//                        $v_name = $get_all_versions[$j]["name"];
//                        $v_price = $get_all_versions[$j]["price"];
//
//                        if ($v_name != "" && $v_price != "") {
//                            $this->manage_product->save_product_version($productID, $get_all_versions[$j]);
//                        }
//                    }
//
//
////                    $mainCatID = $this->input->post("product_category");
////                    $this->manage_products->save_product_to_category($productID, $mainCatID);
////
////                    for ($i = 0; $i < sizeof($this->input->post("product_sub_cats")); $i++) {
////
////                        $data = $this->input->post("product_sub_cats")[$i];
////
////                        $this->manage_products->save_product_to_category($productID, $data);
////                    }
//
////                    $subcats = $this->input->post("product_tags_all");
////
////                    $this->manage_products->save_product_to_tags($productID, $getCreatedTagId);
////
////                    for ($j = 0; $j < sizeof($subcats); $j++) {
////                        $this->manage_products->save_product_to_tags($productID, $subcats[$j]);
////                    }
//
//                    $this->session->unset_userdata('uniqProd');
////                    echo " <pre>";
////                    var_dump($this->input->post("product_tags_all"));
////                    echo "</pre>";
////                    die();
//                    $this->session->set_flashdata("process_done", "successfully added");
//                    redirect("admin_jsessID/panel/add-product");
//                } else {
////
//                    $this->session->set_flashdata("process_error", "something went to wrng");
//                    redirect("admin_jsessID/panel/add-product");
//                }
//            } else {
//
//                $this->session->set_flashdata("process_error", validation_errors());
//                redirect("admin_jsessID/panel/add-product");
//            }
//            
//            
//            
//        }
//        
//    }
    
    public function product_update() {

        
        $data = $this->input->post();
        $id = $this->input->post("id");

//        echo "<pre>";
//        var_dump($data["version"]);
//        echo "</pre>";
//        

        $this->load->library('form_validation');

        $this->form_validation->set_rules('product_name', 'product name', 'required');
//        $this->form_validation->set_rules('product_desc[product_details]', 'Product Description', 'required');
        $this->form_validation->set_rules('product_price', 'Product Price ', 'required');
        $this->form_validation->set_rules('product_supplier_note', 'Product Supplier  ', 'required');
        $this->form_validation->set_rules('product_q', ' Product Quantity  ', 'required');
//        $this->form_validation->set_rules('product_category_edit', 'Product Category ', 'required');
//
//        $this->form_validation->set_rules('product_sub_cats', 'Product Sub Catgeory', 'required');
        $this->form_validation->set_rules('product_location', 'Product Location ', 'required');
        $this->form_validation->set_rules('product_delivery', 'Product Delivery ', 'required');
//        $this->form_validation->set_rules('product_payment_option', 'Product Payment Options ', 'required');

        if ($this->form_validation->run()) {
            
            $this->load->helper("product");
            
//            $data_description = $this->input->post("product_desc");
//            
//             $image_path = $_SERVER['DOCUMENT_ROOT'].'/product_image_lib/automated/';
//             
//            
//            $main_description = cloneContentImages($data_description["product_details"],$image_path, 'pdesc_'.uniqid());
//           $tech_details = cloneContentImages($data_description["tech_details"],$image_path,'tdesc_'.uniqid());
//           
//           $setDesc = array("product_details"=>$main_description,"tech_details"=>$tech_details);
//            
//            //echo $main_description;
//            
//            
//           // die();
//
//            $productTag_ttl = strtolower($this->input->post("product_name"));
//            $productTag_ttl = preg_replace('/[^a-z0-9 ]+/', '', $productTag_ttl);
//            //$productTag_ttl = str_replace(' ', ' ', $productTag_ttl);
//
//            $createTitleAsTag = $this->manage_products->get_product_tag_or_create($productTag_ttl);
//            $getCreatedTagId = $this->session->userdata("TagId");
//
//            $this->manage_products->save_product_to_tags($id, $getCreatedTagId);
            
            /*
                 * MARGIN , MARKUP UPDATE
                 */

                $commission_type = 0; // 0 =  undefined
                                      // 1 = MARGIN
                                      // 2 = MARKUP
                
                $commission_type_per = 0;
                $commission_type_value = 0;
                $product_price = 0;

                $MARK_UP = $this->input->post('x_product_price');

                $MARGIN = $this->input->post('y_product_price');
                
                if(empty($MARK_UP)){
                    $commission_type = 1;
                    $commission_type_per = $this->input->post('y_margin_1');
                    $commission_type_value = $this->input->post('y_margin_2'); 
                    $product_price = $this->input->post('y_product_price');
                }else{
                    $commission_type = 2;
                     $commission_type_per = $this->input->post('x_mark_up_1');
                    $commission_type_value = $this->input->post('x_mark_up_2'); 
                    $product_price = $this->input->post('x_product_price');
                }
                
                $commission_data = array(
                    'a' => $commission_type,
                    'b' => $commission_type_per,
                    'c' => $commission_type_value,
                    'd' => $product_price
                );
                
                /*
                 * end margin / markup process
                 */
                
                



            $do = $this->manage_product->edit_product($data,$id,$commission_data);
            
//        
//        echo "-------------------------------------------------";
//        
//        var_dump($do);
//        
//        die();

            if ($do) {

                $productID = $id;

                if ($this->input->post("version")) {

                    $get_all_versions = $this->input->post("version");

//             

                    $this->manage_product->delete_all_versions_by_id($id);

                    $count = sizeof($get_all_versions);
                    $break = 0;

                    for ($j = 0; $j < $count; $j++) {
                        if (isset($get_all_versions[$j])) {
                            $v_name = $get_all_versions[$j]["name"];
                            $v_price = $get_all_versions[$j]["price"];

                            if ($v_name != "" && $v_price != "") {
                                $this->manage_product->save_product_version($productID, $get_all_versions[$j]);
                            }
                            $break++;
                        } else {
                            $count++;
                        }
                        if ($break == sizeof($get_all_versions)) {
                            break;
                        }
                    }



//                    echo "<pre>";
//                    var_dump($get_all_versions);
//                    echo "</pre>";
//                    die();
//                    
                } else {
                    $this->manage_product->delete_all_versions_by_id($id);
                }


                $delivery_options = $this->input->post("product_delivery");
                $delete_delivery_options = $this->manage_product->delete_all_product_to_delivery($id);

//                     var_dump($delivery_options);
//                     die();

                for ($z = 0; $z < sizeof($delivery_options); $z++) {
                    //echo $z.'<br/>';
                    $this->manage_product->save_product_to_delivery($productID, $delivery_options[$z]);
                }





////                $mainCatID = $this->post("product_category_edit");//
//
//                $this->manage_products->remove_product_to_category_by_id($productID);
//
//                $this->manage_products->save_product_to_category($productID, $mainCatID);
//
//                for ($i = 0; $i < sizeof($this->post("product_sub_cats")); $i++) {
//
//                    $data = $this->post("product_sub_cats")[$i];
//
//                    $this->manage_products->save_product_to_category($productID, $data);
//                }
//
//                $this->manage_products->remove_product_to_tags_by_id($productID);
//
//                for ($i = 0; $i < sizeof($this->post("product_tags_all")); $i++) {
//
//                    $data = $this->post("product_tags_all")[$i];
//
//                    $this->manage_products->save_product_to_tags($productID, $data);
//                }
                
                
                
               // $durl = 'https://preview.retailgenius.com/products/update-history';

//                $fields = array(
//                    'id' => "1",
//                    'json' => "test curl rq",
//                    "des" => " product updated ",
//                    "csrf_rt_cookie" => $this->security->get_csrf_hash(),
//                    $this->security->get_csrf_token_name() => $this->security->get_csrf_hash()
//                );

//                $ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL, $durl);
//                curl_setopt($ch, CURLOPT_POST, 1);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                curl_setopt($ch, CURLOPT_VERBOSE, 0);
//                $dataxx = curl_exec($ch);
//                $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//                curl_close($ch);



//                $this->session->set_flashdata("process_done", "product successfully edited - ".$httpcode.' json'.  json_encode($dataxx));
                $this->session->set_flashdata("process_done", "product successfully edited - ");
                redirect("admin_jsessID/panel/edit/".$id);
            }
        } else {
            
            $this->session->set_flashdata("process_error", validation_errors());
            redirect("admin_jsessID/panel/edit/" . $id);//admin_jsessID/panel/product-update
        }
    }
    
    public function quick_select(){
        $id = $this->input->post('item_id');
        $result = $this->manage_product->get_product_details($id);
        $reply = array();
        $reply["qty"] = $result[0]["item_qty"];
        $reply["status"] = $result[0]["item_stock_status"];
        
//        var_dump($reply);
//        die();
        echo json_encode($reply);
    }
    
    public function quick_update(){
//        var_dump($this->input->post());die();
        $result = $this->manage_product->quick_product_update($this->input->post());
        
        echo $result;                
    }
    
    
   


}
