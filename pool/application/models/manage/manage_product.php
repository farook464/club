<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class manage_product extends CI_MODEL{
    
    
      public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function product_type() {
        $sql = "SELECT * FROM type ";
        $stmt = $this->db->conn_id->prepare($sql);
        
         $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function product_brand() {
        $sql = "SELECT * FROM brands ";
        $stmt = $this->db->conn_id->prepare($sql);
        
         $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function product_categories() {
        $sql = "SELECT * FROM categories ";
        $stmt = $this->db->conn_id->prepare($sql);
        
         $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function product_supplier() {
        $sql = "SELECT id, supplier_name FROM supplier ";
        $stmt = $this->db->conn_id->prepare($sql);
        
         $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    
     public function product_title($data) {

        $sql = "SELECT title,id FROM `rt_product_details` WHERE `title` LIKE '%" . $data . "%'";
        $stmt = $this->db->conn_id->prepare($sql);

        $stmt->execute();
//var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));die("kosala");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function product_details_get($id) {
        $data = $id;
        $select = "select description from  rt_product_details where id = ?";
        $stmt = $this->db->conn_id->prepare($select);
        $stmt->bindParam(1, $data);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_districts($dist) {
//        var_dump($dist);die('kosala');
        $sql = "SELECT district_name, district_id FROM districts where district_name like '%".$dist."%'";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->execute();
        $districtArr = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        return $districtArr;
    }
    public function get_cities($data1) {
        $stmtGetCity = $this->db->conn_id->prepare("SELECT c.city_name,c.city_id FROM cities c,districts d WHERE c.district_id=d.district_id AND d.district_id=?");
        $stmtGetCity->bindValue(1, $data1);
        $stmtGetCity->execute();
        $cityArr = $stmtGetCity->fetchAll(PDO::FETCH_ASSOC);
        
        return $cityArr;
    }
    
    public function insert_product($input_data,$comm_data){
     
        $item_dis = $input_data["product_location"];
        $item_city = $input_data["select_city"];
        $item_loc = $item_city.','.$item_dis;//for item location
        $item_descri = $input_data["product_id"];
        
        
        $sql = "INSERT INTO `rt_products`"
                . " (unique_id,item_name,item_description,"
                
                . "item_isbn,"
                . "item_location,item_delivery_option,item_payment_options,item_price,item_discount,"
                . "item_qty,item_max_qty,item_stock_status,item_sort_order,status,views,created_by,item_commission,"
                . "commission_type,commission_type_per,commission_type_value,product_price,item_supplier_note,item_supplier) "
                . " VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
				
	$ISBN_CODE = "ISBN-".strtoupper(rand(100, 999999) . uniqid());
                
        $PROD_NAME = trim($input_data["product_name"]);
        
        $CREATED_BY = $this->session->userdata("rtLogin_userId");
                 
       // $trim = trim($PROD_NAME);
        //$clean_product_name = preg_replace('/[^A-Za-z0-9 ]/', '', $PROD_NAME);

        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindValue(1, $this->session->userdata('uniqProd'));  // uniq id
        $stmt->bindValue(2,'');                             // item name
        $stmt->bindValue(3,$input_data['description_id']);             // item_description
//        $stmt->bindValue(4, $data["product_supplier"]);             // item_supplier
//        $stmt->bindValue(5, $data["product_supplier_note"]);        // item supplier note
//        $stmt->bindValue(6, $data["product_manufacture"]);          // item_manufacture
        $stmt->bindValue(4, $ISBN_CODE);                            // item_isbn
//        $stmt->bindValue(8, $data["product_serial"]);               // item_serial
        $stmt->bindValue(5, $item_loc);             // item_location
        $stmt->bindValue(6, "");                                   // item_delivery_option
        $stmt->bindValue(7, $input_data["product_payment_option"]);      // item_payment_options
        $stmt->bindValue(8, $input_data["product_price"]);               // item_price
        $stmt->bindValue(9, $input_data["product_discount"]);            // item_discount
        $stmt->bindValue(10, $input_data["product_q"]);                   // item_qty
        $stmt->bindValue(11, $input_data["product_max_q"]);               // item_max_qty
        $stmt->bindValue(12, $input_data["product_stock_status"]);        // item_stock_status
        $stmt->bindValue(13, $input_data["product_sort_order"]);          // item_sort_order
        $stmt->bindValue(14, 16);                                    // status
        $stmt->bindValue(15, 0);                                    // views
        $stmt->bindValue(16, $CREATED_BY);                          // created by
        $stmt->bindValue(17, $input_data["commission"]);                  // item_commission
        // $stmt->bindValue(20, $data["product_tags"]);             // product_tags
        $stmt->bindValue(18, $comm_data['a']);                  // item_commission_type
        $stmt->bindValue(19,$comm_data['b']);                  // item_commission_per
        $stmt->bindValue(20, $comm_data['c']);                  // item_commission_val
        $stmt->bindValue(21, $comm_data['d']);                  // item_commission_val
        $stmt->bindValue(22, $input_data["product_supplier_note"]);        // item supplier note
                $stmt->bindValue(23, $this->session->userdata('rtLogin_userId'));  // uniq id


        $do = $stmt->execute();
        $this->session->set_userdata("lastID", "");
        $this->session->set_userdata("lastID", $this->db->insert_id());
        

        return $do;
        
    
        
    }
    
     public function save_product_to_delivery($productId,$tagId){
        
          $sql = "INSERT INTO `rt_products_to_delivery_options` (product_id,option_id) VALUES (?, ?)";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $productId);
        $stmt->bindParam(2, $tagId);

        return $stmt->execute();
        
    }
    
    public function save_product_version($product_id, $data) {
        $version_name = $data["name"];
        $version_price = $data["price"];
        $version_diz = $data["discount"];
        $version_qty = $data["qty"];

        $sql = "INSERT INTO rt_products_versions "
                . " (product_id, version_name, version_price, version_discount , version_qty) "
                . " VALUES ( ?, ?, ?, ?,?);";

        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, intval($product_id), PDO::PARAM_STR);
        $stmt->bindParam(2, $version_name, PDO::PARAM_STR);
        $stmt->bindParam(3, $version_price, PDO::PARAM_STR);
        $stmt->bindParam(4, $version_diz, PDO::PARAM_STR);
        $stmt->bindParam(5, $version_qty, PDO::PARAM_STR);


        return $stmt->execute();
    }
    
    
    
//    public function download_order_histroy($sql){
//        
//        // query session
//        
//        $stmt = $this->db->conn_id->prepare($sql);
//        
//        $stmt->execute();
//        
//        return $stmt->fetchAll();
//        
//        
//        
//    }
    
    
//    function update_products ($update) {
//               
//         $sql = "INSERT INTO rt_update_history (user_id,update_des,comment) values(?,?,?) "; 
//         $stmt = $this->db->conn_id->prepare($sql);
//         $stmt->bindValue(1,$update['userid']);
//         $stmt->bindValue(2,$update['update_description']);
//         $stmt->bindValue(3,$update['comment']);
//         return $stmt->execute();
//    }
    
    public function get_product_details($pro_id){

        $id = $pro_id;
        $sql = "select * from rt_products where item_id = ?";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function get_product($pro_id){
        
        $sql = "select * from rt_product_details where id = ?";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $pro_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    public function get_product_version_by_id($id) {

        $sql = "SELECT version_name,version_price,version_discount,version_qty FROM `rt_products_versions` WHERE `product_id` = ? ";

        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function product_by_id($id) {
//        var_dump($id);die();

//        $sql = "SELECT rt_users.user_email, rt_manufactures.brand_name ,  rt_products.item_id ,
//            rt_products.unique_id, rt_products.item_commission, rt_products.`item_name`,rt_products.`item_description`,
//            rt_products.`item_supplier`,rt_products.`item_supplier_note`,rt_products.`item_manufacture`,
//            rt_products.`item_isbn`,rt_products.`item_serial`,rt_products.`item_location`,rt_products.`item_price`,
//            rt_products.`item_delivery_option` , rt_products.`item_payment_options`,
//            rt_products.`item_discount`,rt_products.`item_qty`,rt_products.`item_max_qty`,rt_products.`item_stock_status`,
//            rt_products.`item_sort_order`,rt_products.`status`,rt_products.`meta_title`,rt_products.`meta_description`,
//            rt_products.`meta_keywords`,rt_products.`views`,rt_products.`date_created`,rt_products.commission_type,
//            rt_products.commission_type_per,rt_products.commission_type_value,rt_products.product_price
//            from rt_users INNER JOIN 
//            rt_products ON rt_products.item_id = ? and rt_users.user_id = rt_products.item_supplier 
//            JOIN rt_manufactures ON rt_manufactures.brand_id = rt_products.item_manufacture  limit 1";
        $sql = "SELECT rt_products.item_id , rt_products.unique_id, rt_products.item_commission, "
                . "rt_products.`item_name`,rt_products.`item_description`, rt_products.`item_supplier_note`,"
                . " rt_products.`item_isbn`,rt_products.`item_location`,rt_products.`item_price`, "
                . "rt_products.`item_delivery_option` , rt_products.`item_payment_options`, rt_products.`item_discount`"
                . ",rt_products.`item_qty`,rt_products.`item_max_qty`,rt_products.`item_stock_status`,"
                . " rt_products.`item_sort_order`,rt_products.`status`,rt_products.commission_type, "
                . "rt_products.commission_type_per,rt_products.commission_type_value,"
                . "rt_products.product_price from rt_products WHERE rt_products.item_id = ? limit 1 ";

        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
//        var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));die();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function delivery_option_by_id($id){
        
         $sql = "SELECT o.option_id,op.option_name FROM rt_products_to_delivery_options o,"
                 . "rt_product_delivery_options op where o.option_id = op.option_id and o.product_id = ?";

        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        
    }
    
     public function main_categories() {
        $sql = "SELECT * FROM `rt_categories` WHERE `is_main` = 1 ";
        $stmt = $this->db->conn_id->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_product_to_category($prodId, $getMain) {

        $sql = "SELECT * FROM `rt_products_to_categories` where product_id = ?";

        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $prodId, PDO::PARAM_STR);

        $stmt->execute();

        if ($getMain == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    public function update_product($input_data,$comm_data){
     
        $item_dis = $input_data["product_location"];
        $item_city = $input_data["select_city"];
        $item_loc = $item_city.','.$item_dis;//for item location
        $id = $input_data["id"];
        
        
        
        $sql = "INSERT INTO `rt_products`"
                . " (unique_id,item_name,item_description,"
                
                . "item_isbn,"
                . "item_location,item_delivery_option,item_payment_options,item_price,item_discount,"
                . "item_qty,item_max_qty,item_stock_status,item_sort_order,status,views,created_by,item_commission,"
                . "commission_type,commission_type_per,commission_type_value,product_price) "
                . " VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
				
	$ISBN_CODE = "ISBN-".strtoupper(rand(100, 999999) . uniqid());
                
        $PROD_NAME = trim($input_data["product_name"]);
        
        $CREATED_BY = $this->session->userdata("rtLogin_userId");
                 
       // $trim = trim($PROD_NAME);
        //$clean_product_name = preg_replace('/[^A-Za-z0-9 ]/', '', $PROD_NAME);

        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindValue(1, $this->session->userdata('uniqProd'));  // uniq id
        $stmt->bindValue(2,$PROD_NAME);                             // item name
        $stmt->bindValue(3, $item_descri);             // item_description
//        $stmt->bindValue(4, $data["product_supplier"]);             // item_supplier
//        $stmt->bindValue(5, $data["product_supplier_note"]);        // item supplier note
//        $stmt->bindValue(6, $data["product_manufacture"]);          // item_manufacture
        $stmt->bindValue(4, $ISBN_CODE);                            // item_isbn
//        $stmt->bindValue(8, $data["product_serial"]);               // item_serial
        $stmt->bindValue(5, $item_loc);             // item_location
        $stmt->bindValue(6, "");                                   // item_delivery_option
        $stmt->bindValue(7, $input_data["product_payment_option"]);      // item_payment_options
        $stmt->bindValue(8, $input_data["product_price"]);               // item_price
        $stmt->bindValue(9, $input_data["product_discount"]);            // item_discount
        $stmt->bindValue(10, $input_data["product_q"]);                   // item_qty
        $stmt->bindValue(11, $input_data["product_max_q"]);               // item_max_qty
        $stmt->bindValue(12, $input_data["product_stock_status"]);        // item_stock_status
        $stmt->bindValue(13, $input_data["product_sort_order"]);          // item_sort_order
        $stmt->bindValue(14, 0);                                    // status
        $stmt->bindValue(15, 0);                                    // views
        $stmt->bindValue(16, $CREATED_BY);                          // created by
        $stmt->bindValue(17, $input_data["commission"]);                  // item_commission
        // $stmt->bindValue(20, $data["product_tags"]);             // product_tags
        $stmt->bindValue(18, $comm_data['a']);                  // item_commission_type
        $stmt->bindValue(19,$comm_data['b']);                  // item_commission_per
        $stmt->bindValue(20, $comm_data['c']);                  // item_commission_val
        $stmt->bindValue(21, $comm_data['d']);                  // item_commission_val

        $do = $stmt->execute();
        $this->session->set_userdata("lastID", "");
        $this->session->set_userdata("lastID", $this->db->insert_id());
        

        return $do;
        
    
        
    }
    
    
    public function edit_product($data, $id ,$commission_data) {
        
        $item_dis = $data["product_location"];
        $item_city = $data["select_city"];
        $item_loc = $item_city.','.$item_dis;//for item location
                
//        $sql = "UPDATE `rt_products` SET "
//                . "`item_name` = ?, `item_description` = ?, `item_supplier` = ?, "
//                . "`item_supplier_note` = ?, `item_manufacture` = ?, `item_isbn` = ?,"
//                . " `item_serial` = ?, `item_location` = ?, `item_delivery_option` = ?, "
//                . " `item_payment_options` = ?, `item_price` = ?, `item_discount` = ?, "
//                . "`item_qty` = ?, `item_max_qty` = ?, `item_stock_status` = ?,  `item_sort_order` = ?, `status` = ?, "
//                . "`meta_title` = ?, `meta_description` = ?, `meta_keywords` = ? , item_commission = ? ," 
//                . " commission_type = ? , commission_type_per = ? , commission_type_value = ? , product_price = ? WHERE "
//                . " `item_id` = ? ";
        $sql = "UPDATE `rt_products` SET "
                . "`item_supplier_note` = ?,  `item_isbn` = ?,"
                . "  `item_location` = ?, `item_delivery_option` = ?, "
                . " `item_payment_options` = ?, `item_price` = ?, `item_discount` = ?, "
                . "`item_qty` = ?, `item_max_qty` = ?, `item_stock_status` = ?,  "
                . "`meta_title` = ?, `meta_description` = ?, `meta_keywords` = ? , item_commission = ? ," 
                . " commission_type = ? , commission_type_per = ? , commission_type_value = ? , product_price = ? WHERE "
                . " `item_id` = ? ";

        $stmt = $this->db->conn_id->prepare($sql);
//        $stmt->bindValue(1, $data["product_name"]); // item name
//        $stmt->bindValue(2, json_encode($desc)); // item_description
//        $stmt->bindValue(3, $data["product_supplier"]); // item_supplier
        $stmt->bindValue(1, $data["product_supplier_note"]); // item supplier note
//        $stmt->bindValue(5, $data["product_manufacture"]); // item_manufacture
        $stmt->bindValue(2, $data["product_isbn"]); // item_isbn
//        $stmt->bindValue(7, $data["product_serial"]); // item_serial
        $stmt->bindValue(3, $item_loc); // item_location
        $stmt->bindValue(4, ""); // item_delivery_option
        $stmt->bindValue(5, $data["product_payment_option"]); // item_payment_options
        $stmt->bindValue(6, $data["product_price"]); // item_price
        $stmt->bindValue(7, $data["product_discount"]); // item_discount
        $stmt->bindValue(8, $data["product_q"]); // item_qty
        $stmt->bindValue(9, $data["product_max_q"]); // item_max_qty
        $stmt->bindValue(10, $data["product_stock_status"]); // item_stock_status
//        $stmt->bindValue(16, $data["product_sort_order"]); // item_sort_order
//        $stmt->bindValue(17, $data["product_status"]); // status
        $stmt->bindValue(11, ""); // meta_title
        $stmt->bindValue(12, ""); // meta_description
        $stmt->bindValue(13, ""); // meta_keywords
        $stmt->bindValue(14, $data["commission"]); // item_commission
        $stmt->bindValue(15, $commission_data['a']); // item_commission type
        $stmt->bindValue(16, $commission_data['b']); // item_commission per
        $stmt->bindValue(17, $commission_data['c']); // item_commission val
        $stmt->bindValue(18, $commission_data['d']); // product pure price
//        $stmt->bindValue(23, $data['product_supplier_note']); // product pure price
        // $stmt->bindValue(20, 0); // views
        $stmt->bindValue(19, $id); // meta_keywords
        // $stmt->bindValue(20, $data["product_tags"]); // product_tags


        return $stmt->execute();
    }
    
    public function delete_all_versions_by_id($id) {

        $sql = "DELETE FROM `rt_products_versions` WHERE `product_id` =  ? ";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $id);

        $stmt->execute();
    }
    
//    public function save_product_version($product_id, $data) {
//        $version_name = $data["name"];
//        $version_price = $data["price"];
//        $version_diz = $data["discount"];
//        $version_qty = $data["qty"];
//
//        $sql = "INSERT INTO rt_products_versions "
//                . " (product_id, version_name, version_price, version_discount , version_qty) "
//                . " VALUES ( ?, ?, ?, ?,?);";
//
//        $stmt = $this->db->conn_id->prepare($sql);
//        $stmt->bindParam(1, intval($product_id), PDO::PARAM_STR);
//        $stmt->bindParam(2, $version_name, PDO::PARAM_STR);
//        $stmt->bindParam(3, $version_price, PDO::PARAM_STR);
//        $stmt->bindParam(4, $version_diz, PDO::PARAM_STR);
//        $stmt->bindParam(5, $version_qty, PDO::PARAM_STR);
//
//
//        return $stmt->execute();
//    }
    
    public function delete_all_product_to_delivery($id) {

        $sql = "DELETE FROM `rt_products_to_delivery_options` WHERE `product_id` =  ? ";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1, $id);

        $stmt->execute();
    }
    
    public function quick_product_update($update_vaiue){
        
        if($update_vaiue["status"] === "none"){
            
            
               
        $sql = "update rt_products set item_qty =?,item_stock_status = ? where item_id = ? ";
        
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1,$update_vaiue["item_qty"]);
        $stmt->bindParam(2,$update_vaiue["stock"]);
        $stmt->bindParam(3,$update_vaiue["id"]);
        $do = $stmt->execute();
        return $do;
            
            
            
            
        }else{
        
        $sql = "update rt_products set item_qty =? , item_stock_status = ? ,status = ? where item_id = ? ";
        
       
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(1,$update_vaiue["item_qty"]);
        $stmt->bindParam(2,$update_vaiue["stock"]);
        $stmt->bindParam(3,$update_vaiue["status"]);
        $stmt->bindParam(4,$update_vaiue["id"]);
        $do = $stmt->execute();
        return $do;
        
        }
    }
    
   
   
    
    
}