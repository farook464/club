<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  // by Trystan Lea : openenergymonitor.org : GNU GPL
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "";

  $databaseName = "fmf_crm";
  $tableName = "flights";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  //include 'DB.php';
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysql_query("SELECT * FROM $tableName");            //query
 //$array = mysql_fetch_array($result);  
  
  $data = array();
while ( $row = mysql_fetch_row($result) )
{
  $data[] = $row;
}
echo json_encode( $data );                        //fetch result    

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  //echo json_encode($array);

?>
