<?php

header("Content-type: text/html; charset=utf-8");

 /**
    * 建立请求，以表单HTML形式构造（默认）
    * @param $para_temp 请求参数数组
    * @param $method 提交方式。两个值可选：post、get
    * @param $button_name 确认按钮显示文字
    * @return 提交表单HTML文本
    */
   function buildRequestForm($url,$para_temp,$method='POST', $button_name='') {
       $args='==========URL: '.$url.'===METHOD: '.$method.' =====args:'.var_export($para_temp,true).'==============';
       payLog($args);
       $sHtml = "<form id='paysubmit' name='paysubmit' action='".$url."' method='".$method."'>";
       while (list ($key, $val) = each ($para_temp)) {
           $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
       }
        if($button_name)
        $sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";
        $sHtml = $sHtml."<script>document.forms['paysubmit'].submit();</script>";
   
       return $sHtml;
   }
   
   
   
   
    /**
    * 建立请求，以表单HTML形式构造（默认）
    * @param $para_temp 请求参数数组
    * @param $method 提交方式。两个值可选：post、get
    * @param $button_name 确认按钮显示文字
    * @return 提交表单HTML文本
    */
   function buildRequestBody($url,$para_temp,$method='POST') {
       $args='==========URL: '.$url.'===METHOD: '.$method.' =====args:'.var_export($para_temp,true).'==============';
       payLog($args);
       $sHtml="";
       while (list ($key, $val) = each ($para_temp)) {
           $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
       }
        $html=<<<HTML
	    <html>
		<head>
		<title>To PAY Page</title>
		</head>
	    <body onLoad="document.returnfunc.submit();">
	    <form id='returnfunc' name='returnfunc' action='$url' method='$method'>
	        $sHtml
		</form>
		</body>
		</html>
HTML;
   
       return $html;
   }
   
   
    /**
    * 建立请求，以表单HTML形式构造（默认）
    * @param $para_temp 请求参数数组
    * @param $method 提交方式。两个值可选：post、get
    * @param $button_name 确认按钮显示文字
    * @return 提交表单HTML文本
    */
   function buildRequestBody($url,$para_temp,$method='POST') {
       $args='==========URL: '.$url.'===METHOD: '.$method.' =====args:'.var_export($para_temp,true).'==============';
       payLog($args);
       $sHtml="";
       while (list ($key, $val) = each ($para_temp)) {
           $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
       }
        $html=<<<HTML
	    <html>
		<head>
		<title>To PAY Page</title>
		</head>
	    <body onLoad="document.returnfunc.submit();">
	    <form id='returnfunc' name='returnfunc' action='$url' method='$method'>
	        $sHtml
		</form>
		</body>
		</html>
HTML;
   
       return $html;
   }
   
   
   /**
    * curl
    * @param unknown $url
    * @param unknown $data
    * @param unknown $H
    * @return mixed
    */
    function curlRequest($url,$data,$type='POST'){
        if($type=='GET')
            $url=$url.http_build_query($data);
        else if($type=='GET?')
            $url=$url.'?'.http_build_query($data);
       $ch = curl_init($url);
       
      // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
       
       curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       //curl_setopt($ch, CURLOPT_HTTPHEADER, $H );
       $result = curl_exec($ch);
       $args='==========URL: '.$url.'=====METHOD: '.$type.' ===args:'.var_export($data,true).'=======RESULT: '.$result.'=======';
       payLog($args);
       return $result;
   }
   
   
   /**
    * 记录 neteller 文件日志
    * @param string $logName
    * @param string $context
    */
    function payLog($context='',$logName='./log/requestLog.xml'){
       if(!$GLOBALS['Debug']) return false;
       $time=date("Y-m-d H:i:s");
       $text="\n\n<TIME>$time</TIME>\n";
       $context=$text.'<DATA>'.$context.'</DATA>';
       file_put_contents($logName, $context, FILE_APPEND);
   }
   
   
   
   