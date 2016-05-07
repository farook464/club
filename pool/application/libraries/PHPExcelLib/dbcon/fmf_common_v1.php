<?php
if ($_SERVER['DOCUMENT_ROOT'] == "")
$_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__);

define('FMFROOTPATH', $_SERVER["DOCUMENT_ROOT"]);
define('FMFSITEPATH', $_SERVER["SERVER_NAME"]);

mb_internal_encoding("UTF-8");

date_default_timezone_set('Asia/Colombo');

ini_set("display_errors", 0);
ini_set("track_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", FMFROOTPATH."/logs/site-error_".date('Y-m-d').".log");

?>
