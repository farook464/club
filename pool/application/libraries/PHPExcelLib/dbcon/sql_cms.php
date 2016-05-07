<?php
//PDO
function fmf_cms_dbconnect ()
{
$dbh;
   try
   {
	  $dbh = new PDO("mysql:host=cms.findmyfare.com;dbname=cms_fmf", "fmfsite2", "wUsKc*BT4fwn%qH%L02Xdf904pK");
	  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	  $dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $dbh->exec("SET NAMES 'utf8'");
	  $dbh->exec("SET time_zone = '+5:30'");
   }
   catch (PDOException $e)
   {
     print ("Could not connect to server, Please Call 011 7 24 7 365.\n");
	 $date_time = date ('Y-m-d H:i:s');
	 error_log($date_time." ".$e->getMessage());
     print ("getMessage(): " . $e->getMessage() . "\n");
	 exit();
   }
   
  return ($dbh);
}
?>