<?php 
$dir = dirname(__FILE__);
//echo "<p>Full path to this dir: " . $dir . "</p>";
//$http = $_SERVER['HTTP_HOST'];

define('HTTPPATH', $_SERVER['HTTP_HOST']);

define('ROOTPATH', dirname(__FILE__));


define('epEMAILPATH', ROOTPATH.'/lib/PHPMailer');

define('epPDFPATH', ROOTPATH.'/lib/pdf');

define('epGridPATH', ROOTPATH.'/lib/grid');

//echo ROOTPATH;

mb_internal_encoding("UTF-8");

date_default_timezone_set('Asia/Colombo');


function GetClientIP()
{
//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}
//The value of $ip at this point would look something like: "192.0.34.166"
//$ip = ip2long($ip);
return $ip;
}


function FmfMyTripIdGen(){
$tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ012345678901234567890123456789012345678901234567890123456789';
$serial = '';
    for ($j = 0; $j < 7; $j++) {
        $serial .= $tokens[rand(0, 85)];
    }
return $serial;
}

function FmfMyTripId($ig){
$tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ012345678901234567890123456789012345678901234567890123456789';
$serial = '';
    for ($j = 1; $j <= $ig; $j++) {
        $serial .= $tokens[rand(0, 85)];
    }
return $serial;
}

$epc_Test="FMFEP";

ini_set("display_errors", 0);
ini_set("track_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", ROOTPATH."/logs/pay-error_".date('Y-m-d').".log");

$error_log = ini_get('error_log');

?>