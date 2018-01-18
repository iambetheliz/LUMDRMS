<?php
    $arr_post_body = array(
        "message_type" => "SEND",
        "mobile_number" => "639358306457",
        "shortcode" => "29290166",
        "message_id" => "12345678901234567890123456789012",
        "message" => urlencode("Welcome to My Service!"),
        "client_id" => "7650547562ef5cb650c4f5625220fd9fa6833a3a5ed2f28ff8cc369adaa20224",
        "secret_key" => "d4c3a8d32ddc63715a836ac5c8e67a235a04bfc12a148597a77565d0632cbcf4"
    );

    $query_string = "";
    foreach($arr_post_body as $key => $frow)
    {
        $query_string .= '&'.$key.'='.$frow;
    }

    $URL = "https://post.chikka.com/smsapi/request";

    $curl_handler = curl_init();
    curl_setopt($curl_handler, CURLOPT_URL, $URL);
    curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
    curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handler);
    curl_close($curl_handler);

    exit(0);



?>