<?php

//require_once '../../../dbcon/sql.php';

$arr = array();

//try {
//    //$dbh = testdb_connect();
//    
//    $name = $_FILES["s_docs"]["name"];
//    $size = $_FILES['s_docs']['size'];
//        
//    if($size<(1024*1024)){
//        $arr[0] = $name." ".$size;
//        echo json_encode($arr);
//    }
//    else{
//        $arr[0] = "files are too large!";
//        echo json_encode($arr);
//    }
//} catch (PDOException $e) {
//    $arr[0] = "internal problem. please try again later!";
//    echo json_encode($arr);
//}
$arr[0] = "internal problem. please try again later!";
    echo json_encode($arr);
?>
