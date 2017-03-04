<?php
    header("Content-type: text/html; charset=utf-8");
    require_once 'payTool.php';
    require_once 'pay.url.config.php';
    
    
    /**
     * 提交请求
     */
    if($_REQUEST['requestType']=='https')
       $result = curlRequest($httpsverifyUrl,$_REQUEST,'GET');
    else
       $result = curlRequest($httpverifyUrl,$_REQUEST,'GET');
   
       print_r($result); 
       
   return $result;