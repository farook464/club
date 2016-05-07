<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['olsSid']);
unset($_SESSION['LAST_ACTIVITY']);
unset($_SESSION['syslogid']);

header("Location: https://pay.findmyfare.com/payv2");
die();

?>