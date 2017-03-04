<?php
header("Content-type: text/html; charset=utf-8");
    require_once 'payTool.php';
    require_once 'pay.url.config.php';
    
    
    /**
     * 提交请求
     */
    echo buildRequestForm($alipay_gateway_new,$_GET,'GET');
   
   
   
   