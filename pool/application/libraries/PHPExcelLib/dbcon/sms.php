<?php

function sendSms($no){
$mes = "Your Hotel booking is confirmed, we have emailed you the voucher, wish you a pleasant holiday, Findmyfare.com";
sendSmsCore($no,$mes);

}

function sendSmsBudgetDetailed($no,$amount,$FlightDetails){
$mes = $FlightDetails." Price : ".$amount."/=, This quote is valid for 4 hours only, We have emailed you the details, Findmyfare.com";
sendSmsCore($no,$mes);

}

function sendSmsflightDetailed($no,$amount,$FlightDetails,$extime){
$mes="Price : ".$amount."/=, payment link : www.fmf.lk/".$FlightDetails.", Quote Expires at ".$extime." . We have also emailed you the details, Findmyfare.com";
sendSmsCore($no,$mes);

}

function sendSmsCore($smsnumber, $smsMeg)
{
 $smsnumber = substr($smsnumber, 1);

$url = "http://api.websms.lk/api/v3/sendsms/xml";
$xmlRequest = "<SMS>
<authentication>
<username>findmyfare</username>
<password>fmf@2014</password>
</authentication>
<message>
<sender>Findymfarecom</sender>
<text>".$smsMeg."</text>
<recipients>
<gsm>94".$smsnumber."</gsm>
</recipients>
</message>
</SMS>";

 //setting the curl parameters.
 $headers = array(
 "Host: api.websms.lk",
  "Content-Type: application/xml",
  "Accept: */*"
 );

        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);

            // send xml request to a server

            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

            curl_setopt($ch, CURLOPT_POSTFIELDS,  $xmlRequest);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $data = curl_exec($ch);

            //convert the XML result into array
            if($data === false){
                $error = curl_error($ch);
                echo $error; 
                die('error occured');
            }else{

                $data = json_decode(json_encode(simplexml_load_string($data)), true);  
            }
            curl_close($ch);

        }catch(Exception  $e){
		error_log($e->getMessage());
            //echo 'Message: ' .$e->getMessage();die("Error");
    }

	//var_dump($data);
}
?>