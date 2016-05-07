<?php 
session_start();
require_once 'sql.php';
require_once '../lib/phpass/PasswordHash.php';

//echo $_SERVER['REQUEST_URI']; 

function LoginTime($uuid,$useragent,$ipaddrein){
 $dbh = testdb_connect ();
 $sth = $dbh->prepare ("CALL InsertLogin(?,?,?,@Pid)");
	   $sth->bindValue (1, $uuid);
	   $sth->bindValue (2, $useragent);
	   $sth->bindValue (3, $ipaddrein);
	   
	  // $sth->bindParam(4, $logid, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT); 
	   $sth->execute();
	   
	   $logid = $dbh->query("select @Pid")->fetch(PDO::FETCH_ASSOC);

return $logid["@Pid"];
}

function getIP() {
$ip;
if (getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else
$ip = "0";
return $ip;

}
function Login($uname,$password){
	$funmsg=0;
	/* $userID= $user_profile['id'];
	$name= $user_profile['name'];
	$firstname= $user_profile['first_name'];
	$lastname= $user_profile['last_name'];
	$username= $user_profile['username'];
	$email= $user_profile['email']; */

	$dbh = testdb_connect ();
	//$sth = $dbh->prepare("SELECT fbId,fbActive FROM fmf_user WHERE fbId=?"); AND password=?
	$sth = $dbh->prepare("SELECT id,fbActive,FirstName,LastName,password FROM fmf_user WHERE username=? ");
	$sth->bindParam (1, $uname);
	//$sth->bindParam (2, $password);
	$sth->execute ();
	if ($sth->rowCount () == 0)
	   {
	   return 0;
		/* $sth = $dbh->prepare ("INSERT INTO fmf_user (fbId, email, name,username,FirstName,LastName)
							  VALUES (?, ?,?,?,?,?)");
	   $sth->bindValue (1, $userID);
	   $sth->bindValue (2, $email);
	   $sth->bindValue (3, $name);
	   $sth->bindValue (4, $username);
	   $sth->bindValue (5, $firstname);
	   $sth->bindValue (6, $lastname);
	   $sth->execute ();
	   $dbh = NULL;
	   exit("<h3>you have been registered to the system, please inform Thushan/Suren to activate your account.</h3><br><br><a href='index.php'>Click here to try again</a>"); */
	   }
	else{   
	$res = $sth->fetch ();
	 $dbh = NULL;
	 
	$fbActive=$res['fbActive'];
	$iduser=$res['id'];
	$fname=$res['FirstName'].' '.$res['LastName'] ;
	$newpass= $res['password'] ;
	$phpass = new PasswordHash(12, false);
	
	$funmsg=1;
	
	if ($phpass->CheckPassword($password, $newpass)) {

		if ($fbActive == 0){
		return 0;
		}
		else{
        $sid = session_id();
		session_regenerate_id();
		$_SESSION['id'] = $iduser;
		$_SESSION['name'] = $fname;
		$_SESSION['olsSid'] =$sid;
		$_SESSION['LAST_ACTIVITY'] = time();
		$_SESSION['syslogid']=LoginTime($iduser,$_SERVER['HTTP_USER_AGENT'],getIP());
		//header('Location: index.php');
		return 1;
		exit();
		}
    } else {
		return 0;
    }

	}
	return $funmsg;
}


if(isset($_POST['emailSub']))
{
 if(Login($name,$password)){
	$InvoiceFunMsg= '<font color="#FF0000"><b>your account is still not activated, please inform Suren to activate your account.</b></font>';
	}
	else{
	$InvoiceFunMsg='<font color="#FF0000"><b>Invalid username or password.</b><br>Please try again</font>';
	} 

}
  

  $name= $_GET["id"];
  $password= $_GET["pas"];

  $data = array();

  $data[0] = Login($name,$password);

  echo json_encode( $data );                        //fetch result    

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  //echo json_encode($array);

?>
