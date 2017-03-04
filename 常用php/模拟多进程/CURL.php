<?php

header('Content-Type: text/html; charset=UTF-8');



 function curlJson($url,$data='',$type='POST'){
    $data_string = json_encode($data);
    //echo $data_string;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
    curl_setopt($ch, CURLOPT_NOSIGNAL,true);//支持毫秒级别超时设置
    curl_setopt($ch, CURLOPT_TIMEOUT_MS,1);  //超时毫秒，cURL 7.16.2中被加入。从PHP 5.2.3起
    //curl_setopt($ch, CURLOPT_TIMEOUT,1);
    curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $H );
    $result = curl_exec($ch);
    
    return $result;
}


$stime = microtime(true);



curlJson("http://localhost/20151208/1.php");


$etime = microtime(true);
echo  $etime - $stime;
echo '</br/>';
echo '11111';
//ignore_user_abort(true); // 忽略客户端断开  
//set_time_limit(0);       // 设置执行不超时 