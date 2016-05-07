<?php

/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getUser($uid){
        
        $sql = "SELECT * FROM `rt_users` WHERE user_email = ?";
        
         $stmt = $this->db->conn_id->prepare($sql);
         $stmt->bindValue(1,$uid);
         $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    
    
    
    
    
    

}
