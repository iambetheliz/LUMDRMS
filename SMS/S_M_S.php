<?php
	$base_url = 'http://url-of-smseagle/index.php/http_api/send_sms';
    $params = array(
        'login' => 'john',           
        'pass' => 'doe',        
        'to'       => '1234567',    
        'message'  => "my message", 
    );
    $data = '?'.http_build_query($params);
    $ret = fopen($base_url.$data,'r');
    $result = fread($ret,1024);
    fclose($ret);
    if (substr($result,0,2) == "OK") {
    echo "Message has been sent successfully!";
    } else {
    echo "
?>