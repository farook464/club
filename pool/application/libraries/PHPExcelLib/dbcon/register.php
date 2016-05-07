<?php

require_once 'sql.php';
require_once('../lib/phpass/PasswordHash.php');
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

/* if(!isset($_POST['emailSub'])){
  header('Location: index.php');
  exit();
  }
  else if ((isset($_POST['emailSub'])) && ($_SESSION['reload_page'] == FALSE)){
  header('Location: index.php');
  exit();
  } */

$fname = $_GET["firstName"];
$lname = $_GET["lastName"];
$email = $_GET["emailID"];
$mobile = $_GET["mobile"];
$password = $_GET["password1"];
$UserName = $_GET["UserName"];

$phpass = new PasswordHash(12, false);
$encrypt_password = $phpass->HashPassword($password);

function register() {
    global $UserName;
    global $email;
    global $fname;
    global $lname;
    global $mobile;
    global $encrypt_password;

    $uuID = uniqid();

    $dbh = testdb_connect();

    //$InvoiceMsg=FALSE;
    try {
        $sth = $dbh->prepare("INSERT INTO fmf_user(uuid,email,password,FirstName,LastName,mobile,username)
							  VALUES (?,?,?,?,?,?,?)");
        $sth->bindValue(1, $uuID);
        $sth->bindValue(2, $email);
        $sth->bindValue(3, $encrypt_password);
        $sth->bindValue(4, $fname);
        $sth->bindValue(5, $lname);
        $sth->bindValue(6, $mobile);
        $sth->bindValue(7, $UserName);
        if ($sth->execute()) {
            $InvoiceMsg = '0';
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062 /* ER_DUP_ENTRY */)
            $InvoiceMsg = '1';
        else
            $InvoiceMsg = '2';
    }

    $dbh = NULL;
    return $InvoiceMsg;
}

//if (isset($_POST['emailSub'])) {
//    if ($frmMsg) {
//        $regmsg = register();
//    }
//}
/* else
  {
  exit('<a href="index.php">Click here to continue</a>');
  } */

$data = array();

$data[0] = register();

echo json_encode($data);
?>