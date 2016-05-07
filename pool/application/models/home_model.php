<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getReserveData() {

        $sql1 = "SELECT id, phone, other_no FROM customers";
        $stmt1 = $this->db->conn_id->prepare($sql1);
        $stmt1->execute();
        $res1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $sql2 = "SELECT id, name, hours, minutes, price FROM membership_types";
        $stmt2 = $this->db->conn_id->prepare($sql2);
        $stmt2->execute();
        $res2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $sql3 = "SELECT id, name FROM tables";
        $stmt3 = $this->db->conn_id->prepare($sql3);
        $stmt3->execute();
        $res3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        $res = array(
            "customers" => $res1,
            "mem_types" => $res2,
            "tables" => $res3,
        );

        return $res;
    }

    function searchMember($searchVal) {
        $sql1 = "SELECT id,name, phone, other_no FROM customers WHERE phone = ? OR other_no = ?";
        $stmt1 = $this->db->conn_id->prepare($sql1);
        $stmt1->bindparam(1, $searchVal);
        $stmt1->bindparam(2, $searchVal);
        $stmt1->execute();
        return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

    function playTable($memType, $cusID, $tableID, $existCus, $cusName, $phone, $OtherNo) {

        if ($existCus === '0') {
            
            if($OtherNo===""){
                $OtherNo = NULL;
            }

            $sql = "INSERT INTO customers (name,phone,other_no) values(?,?,?)";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->bindparam(1, $cusName);
            $stmt->bindparam(2, $phone);
            $stmt->bindparam(3, $OtherNo);
            $stmt->execute();
            $cusID = $this->db->insert_id();
        }


        $sql1 = "INSERT INTO play (customer_id,membership_id,table_id) values(?,?,?)";
        $stmt1 = $this->db->conn_id->prepare($sql1);
        $stmt1->bindparam(1, $cusID);
        $stmt1->bindparam(2, $memType);
        $stmt1->bindparam(3, $tableID);
        $stmt1->execute();
        $lstTableID = $this->db->insert_id();

        if ($existCus === '0') {
            $arr = array(
                'cusID' => $cusID,
                'tblID' => $lstTableID
            );
            return $arr;
        } else {
            return $lstTableID;
        }
    }

}
