<?php

$ch = curl_init();
//Header
curl_setopt($ch, CURLOPT_URL, "https://www.paypal.com/pl/cgi-bin/webscr?cmd=_login-submit&dispatch=5885d80a13c0db1f8e263663d3faee8de62a88b92df045c56447d40d60b23a7c");
//curl_setopt($ch, CURLOPT_PROXY, $proxy); 
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return server response
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6');
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: 127.0.0.1", "HTTP_X_FORWARDED_FOR: 127.0.0.1")); 


curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookieJar.txt'); // save cookie file 
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_REFERER, 'https://www.paypal.com');
curl_setopt ($ch, CURLOPT_COOKIESESSION, TRUE);
curl_setopt($ch, CURLOPT_POST, 1); // use post data

$post = array(
    "login_cmd" => null,
    "login_params" => null,
    "login_email" => "meetvora2018@gmail.com",
    "login_password" => "paypal#123",
    "submit.x" => "login",
    //"auth" => "AOeCYVv0IxkugC2Pyz2AhTaW2P7hWuy5w9FoeuyB48gjjJZN3mTtuL79Tzs9dY.CF",
    "form_charset" => "UTF-8",
    "browser_name" => "Chrome",
    "browser_version" => "537.36",
    //"browser_version_full" => "40.0.2214.115",
    //"operating_system" => "Windows",
);

$post = http_build_query($post);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$data = curl_exec($ch);
if(curl_errno($ch))
{
echo 'error:' . curl_error($ch);
}
curl_close($ch);

print_r($data);


?>