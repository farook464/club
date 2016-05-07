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

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index() {

        $res = $this->home_model->getReserveData();

        $data = array(
            'title' => 'POOL CLUB ',
        );

        $this->load->view('template/header', $data);
        $this->load->view('mobile_index', $res);
        $this->load->view('template/footer');
    }

    public function searchMember() {
        $searchVal = $this->input->post('searchElem');
        $res = $this->home_model->searchMember($searchVal);
        echo json_encode($res);
    }

    public function playTable() {
        $existCus = $this->input->post('existCus');
        $cusName = $this->input->post('cusName');
        $phone = $this->input->post('phone');
        $OtherNo = $this->input->post('OtherNo');
        $cusID = $this->input->post('cusID');
        $memType = $this->input->post('memType');
        $tableID = $this->input->post('tableID');
               
        $res = $this->home_model->playTable($memType, $cusID, $tableID,$existCus,$cusName,$phone,$OtherNo);
        echo json_encode($res);
    }

}
