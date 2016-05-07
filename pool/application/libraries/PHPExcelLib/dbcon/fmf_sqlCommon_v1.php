<?php require_once 'fmf_common_v1.php';
//SQL Common

//PDO
function fmfdb_connect_v1 ($db_host, $db_name, $db_user, $db_pass)
{
$dbh;
   try
   {
	  $dbh = new PDO("mysql:host=".$db_host.";dbname=".$db_name.";charset=utf8", $db_user, $db_pass);
	  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	  $dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  //$dbh->exec("SET NAMES 'utf8'");
	  $dbh->exec("SET time_zone = '+5:30'");
   }
   catch (PDOException $e)
   {
     print ("Could not connect to server, Please Call 011 7 247 365.\n");
	 error_log($e->getMessage());
	 exit();
   }
   
  return ($dbh);
}


?>
