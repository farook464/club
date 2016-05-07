<?php session_start();
$uuid=$_SESSION['id'];
$syslogid=$_SESSION['syslogid'];
echo $_SERVER['REQUEST_URI']; 
session_destroy();
require 'sql.php';
echo $_SERVER['REQUEST_URI']; 
function LogOutTime($uuid,$syslogid){
 $dbh = testdb_connect ();
 $sth = $dbh->prepare ("UPDATE fmf_userLoginLog SET logout=now(),outType=? WHERE logid= ?");
	   $sth->bindValue (1, $uuid);
	   $sth->bindValue (2, $syslogid);
	   $sth->execute ();


}

$msg=htmlspecialchars($_GET["id"]);

LogOutTime($msg,$syslogid);



?>


<!DOCTYPE html>
<html>
<head>
<title>FMF Payment Gateway</title>
<?php include 'include/headerHead.php'; ?>
</head>
<body>
<?php include 'include/header.php'; ?>
<div class="subheader" style="margin-top: 100px; background-color: #3978c8;">
	<div class="left">
		<span class="page-title">EasyPay Login Out</span>
		<span class="page-desc"></span>			</div>
</div>
<div id="content">
<?php 
if($msg == 2){
echo '<h3><font color="#FF0000"> you have been logged out due to inactivity, please log back in to continue</font></h3><br><b>';
}
else{
echo '<h3> you have been successfully logged out </h3><br><b>';
}
echo '<a href="index.php">click here to login again</a>';
?>

</div>
<?php include 'include/footer.php'; ?>
	</body>
	</html>