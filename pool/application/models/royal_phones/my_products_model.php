<?php

/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_products_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function datatables($data) {
    
        
        $limit = intval(htmlspecialchars($data["limit"]));
        $offset = intval(htmlspecialchars($data["offset"]));
        $orderBy = htmlspecialchars(strtolower($data["orderby"]));
        $orderByCol = htmlspecialchars(strtolower($data["orderCol"]));
        $search = htmlspecialchars(strtolower($data["search"]));

//        var_dump($search);die('search');

        $sql = "SELECT p.id, b.brand_name, p.name, s.supplier_name, p.iemi_number, p.price, p.quantity
FROM products p, brands b, supplier s
WHERE b.id = p.brand_id AND p.supplier_id = s.id "
                . "AND (b.brand_name LIKE '%" . $search . "%' or p.name LIKE '%" . $search . "%' or s.supplier_name LIKE '%" . $search . "%'or p.iemi_number LIKE '%" . $search . "%') "
                . "ORDER BY p." . $orderByCol . " " . $orderBy . " LIMIT :limit OFFSET :offset ";


        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
        $stmt->execute();

        $count = $this->db->conn_id->prepare("SELECT count(p.id)  "
                . "FROM products p, brands b, supplier s
WHERE b.id = p.brand_id AND p.supplier_id =s.id  "
                . "and (b.brand_name LIKE '%" . $search . "%' or p.name LIKE '%" . $search . "%' or s.supplier_name LIKE '%" . $search . "%'or p.iemi_number LIKE '%" . $search . "%') "
                . "ORDER BY p." . $orderByCol . " " . $orderBy . " LIMIT :limit OFFSET :offset ");

         $count->bindParam("limit", $limit, PDO::PARAM_INT);
        $count->bindParam("offset", $offset, PDO::PARAM_INT);

        if ($count->execute()) {
            $getthis = false;
            $countRows = $count->fetchAll()[0][0];
        } else {
            $getthis = true;
            $countRows = 0;
        }
        $arr = array(
            "data" => $stmt->fetchAll(PDO::FETCH_ASSOC),
            "count" => $countRows,
            "responed" => $getthis
        );

               return $arr;
    }

    function update_products($update) {
        $sql = "INSERT INTO rt_update_history (user_id,update_des,comment) values(?,?,?) ";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindValue(1, $update['userid']);
        $stmt->bindValue(2, $update['update_description']);
        $stmt->bindValue(3, $update['comment']);
        return $stmt->execute();
    }

    function request_delete_products($request) {
        $sql = "INSERT INTO rt_requests (req_type,req_type_id,req_by,req_for) values(?,?,?,?) ";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindValue(1, $request['request_type']);
        $stmt->bindValue(2, $request['req_type_id']);
        $stmt->bindValue(3, $request['request_by']);
        $stmt->bindValue(4, $request['request_for']);
        return $stmt->execute();
    }

}
