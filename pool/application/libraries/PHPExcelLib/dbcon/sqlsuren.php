<?php
//PDO
function OldSqlSuren_connect ()
{
$dbh;
   try
   {
	  $dbh = new PDO("mysql:host=sql.pay.findmyfare.com;dbname=fmfpay_v1", "fmfpay2", "jByJ8KPM1hfYV1Cos%C9y1N99^^");
	  //$dbh = new PDO("mysql:host=sql.pay.findmyfare.com;dbname=fmfpay_v1", "fmfpay", "fmf@5757");
	  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	  $dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $dbh->exec("SET NAMES 'utf8'");
	  $dbh->exec("SET time_zone = '+5:30'");
   }
   catch (PDOException $e)
   {
     print ("Could not connect to server, Please Call 011 7 247 365.\n");
	 $date_time = date ('Y-m-d H:i:s');
	 error_log($date_time." ".$e->getMessage());
     //print ("getMessage(): " . $e->getMessage() . "\n");
	 exit();
   }
   
  return ($dbh);
}
?>