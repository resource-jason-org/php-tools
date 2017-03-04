<?php

header('Content-Type: text/html; charset=UTF-8');

set_time_limit(0);
$urls = array('http://localhost/20151208/1.php','http://localhost/20151208/2.php',);


$handle = curl_multi_init();
$curls = array();
foreach ($urls as $k=>$url)
{
    $curls[$k] = add_handle($handle, $url);
}
function add_handle(& $handle, $url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, '');
    curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_multi_add_handle($handle, $curl);
    return $curl;
}

$flag = null;
do {
    curl_multi_exec($handle, $flag);
} while ($flag > 0);

foreach($urls as $k=>$url){
    if(200 != curl_getinfo($curls[$k], CURLINFO_HTTP_CODE))
    {
        curl_multi_remove_handle($handle, $curls[$k]);
        continue;
    }
    $content = curl_multi_getcontent ($curls[$k]) ;
    //echo $content;
  file_put_contents('111', $content,FILE_APPEND);
    curl_multi_remove_handle($handle, $curls[$k]);
}
curl_multi_close($handle);




?>
