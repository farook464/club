<?php






function send_sms($number, $message) {
    
    
    $status = FALSE;
    
    $cleaned = preg_replace('/[^0-9\-]/', '', $number);


    if (strlen($cleaned) >= 9) {
        $number = '0094' . substr($cleaned, -9);
    
    $durl = 'https://core.retailgenius.com/smssender.php';

    $fields = array(
        'no' => ("$number"),
        'message' => ($message)
    );


    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $durl);
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_VERBOSE, 0);

        $data = curl_exec($ch);
        
        $status = TRUE;
        
        
    } catch (Exception $ex) {
        $status = FALSE;
    }
    }
    return $status;
}










?>