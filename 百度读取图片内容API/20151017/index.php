<?php

header('Content-Type: text/html; charset=UTF-8');


$file = "qq.jpg";
$type = getimagesize($file);
$fp = fopen($file,"r") or die("Can't open file");

$file_content = urlencode(base64_encode(fread($fp,filesize($file))));
fclose($fp);
?> 
<?php
    $ch = curl_init();
    $url = 'http://apis.baidu.com/apistore/idlocr/ocr';
    $header = array(
        'Content-Type:application/x-www-form-urlencoded',
        'apikey: e888053c2eb72125af96db6e1dc316e4',
    );
    $data = "fromdevice=pc&clientip=112.199.103.18&detecttype=LocateRecognize&languagetype=CHN_ENG&imagetype=1&image=$file_content";
    // 添加apikey到header
    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
    // 添加参数
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 执行HTTP请求
    curl_setopt($ch , CURLOPT_URL , $url);
    $res = curl_exec($ch);

    print_r(json_decode($res));
?>