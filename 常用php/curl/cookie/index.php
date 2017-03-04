<?php

header('Content-Type: text/html; charset=UTF-8');


echo $cookie_file = dirname(__FILE__)."\\tmp.cookie";

$login_url = "http://www.ho168.com/user.php?s=/Deposit_executeTransfer.html";

//$login_url='http://www.ho168.com';

$curl = curl_init();
$post=array(
    'mode'=>'in',
    'target'=>'ag',
    'money'=>'1',
    'platform_from'=>'system',
    'platform_to'=>'ag', 
    
);

$timeout = 5;

curl_setopt($curl, CURLOPT_URL, $login_url);

curl_setopt($curl, CURLOPT_HEADER, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);


//curl_setopt($curl,CURLOPT_COOKIEJAR,$cookie_file);
//curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);


echo '123';
echo $contents = curl_exec($curl);
curl_close($curl);




?>
