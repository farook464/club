<?php require_once 'sql.php';
require_once('mailP.php');
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

$email=$_GET["emailID"];


$frmMsg=true;

function register()
{

  global $email;
  
 $uuID= uniqid();
  
 $dbh = testdb_connect ();
 
 //$InvoiceMsg=FALSE;
 try {
 $sth = $dbh->prepare ("UPDATE fmf_user SET pwdresetID=?, pwdresetActive=1,fbActive=0 WHERE email=?");
	   $sth->bindValue (1, $uuID);
	   $sth->bindValue (2, $email);	   
	   if ($sth->execute ())
		{
		  sendpasswordmail($uuID,$email);
		  $InvoiceMsg='1';
		  $frmMsg=false;
		}
} catch (PDOException $e) {
		  $InvoiceMsg='0';
  }
	   
	   $dbh = NULL;  
	   return $InvoiceMsg;
}

/*else
{
exit('<a href="index.php">Click here to continue</a>');
} */

$data = array();

$data[0] = register();

echo json_encode($data);

?>