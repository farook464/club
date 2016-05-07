<?php
 session_start();
 
  
function isLoggedIn()
{
    if(isset($_SESSION['id']) && $_SESSION['id'])
        return true;
    return false;
}

 // rest of code
 if(!isLoggedIn())
{
    header('Location: https://pay.findmyfare.com/payv2/login.php');
    die();
}


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
	header('Location: https://pay.findmyfare.com/payv2/login.php');
	exit();
    // last request was more than 30 minutes ago
    //session_unset();     // unset $_SESSION variable for the run-time 
    //session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
?>