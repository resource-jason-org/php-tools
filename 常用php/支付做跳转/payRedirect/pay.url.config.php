<?php

header("Content-type: text/html; charset=utf-8");
    /**
     * 支付接口URL 一般不用修改
     */
    $alipay_gateway_new = 'https://mapi.alipay.com/gateway.do?';
    
    
    /**
     * 支付状态查询  一般不用修改
     */
    $httpverifyUrl='http://notify.alipay.com/trade/notify_query.do?';
    $httpsverifyUrl='https://mapi.alipay.com/gateway.do?service=notify_verify&';
    
    
    /**
     * debug是否开启
     * 开启之后会记录每次请求的log
     */
    $Debug=true;
    
    
    //////////////////////////////////////需要修改的域名START///////////////////////////////////////////
    /**
     * 修改跳转网站
     * 只需要修改当前使用网站的域名即可
     */
    $payDomain="http://www.test.com";
    
    
    //////////////////////////////////////需要修改的域名END///////////////////////////////////////////
    /**
     * 支付状态跳转
     * 只需修改跳转链接即可
     */
    $responseUrl=$payDomain.'/user.php?s=/Alipay_callback';
    
    
    
    
    
    
   
    
    
    
    
    
    

    
    
    
   
   
   
   
   
