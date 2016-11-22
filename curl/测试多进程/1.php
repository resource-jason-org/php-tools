<?php

header('Content-Type: text/html; charset=UTF-8');


// // $data='12353';
// // $H=array('HEHEH');



// // $url="http://www.ddf.com/index.php?s=/Index_ceshi";
// // echo curlJson($url,$data,$H);

// // 	     function curlJson($url,$data,$H,$type='POST'){
// // 	        $ch = curl_init($url);
// // 	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
// // 	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
// // 	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
// // 	        curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
// // 	        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// // 	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// // 	        curl_setopt($ch, CURLOPT_HTTPHEADER, $H );
// // 	        $result = curl_exec($ch);
// // 	        return $result;
// // 	    }

// //echo 'php11111111';
// 	    $url = 'http://www.ddf.com/index.php?s=/Index_ceshi';
	    
// 	    $header = array('token:JxRaZezavm3HXM3d9pWnYiqqQC1SJbsU','language:zh','region:GZ');
// 	    $content = array(
// 	        'name' => 'fdipzone'
// 	    );
	    
// 	 ECHO    $response = tocurl($url, $header, $content);
// 	   // $data = json_decode($response, true);
	    
// // 	    echo 'POST data:';
// // 	    echo '<pre>';
// // 	    print_r($data['post']);
// // 	    echo '</pre>';
// // 	    echo 'Header data:';
// // 	    echo '<pre>';
// // 	    print_r($data['header']);
// // 	    echo '</pre>';
	    
// 	    /**
// 	     * 发送数据
// 	     * @param String $url     请求的地址
// 	     * @param Array  $header  自定义的header数据
// 	     * @param Array  $content POST的数据
// 	     * @return String
// 	     */
// 	    function tocurl($url, $header, $content){
// 	        $ch = curl_init();
// 	        if(substr($url,0,5)=='https'){
// 	            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
// 	            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
// 	        }
// 	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	        curl_setopt($ch, CURLOPT_URL, $url);
// 	        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
// 	        curl_setopt($ch, CURLOPT_POST, true);
// 	        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($content));
// 	        $response = curl_exec($ch);
// 	        if($error=curl_error($ch)){
// 	            die($error);
// 	        }
// 	        curl_close($ch);
// 	        return $response;
// 	    }


file_put_contents('ceshi.log', time().'     START=====      ', FILE_APPEND);
sleep(100);
file_put_contents('ceshi.log', time().'     END=====      ', FILE_APPEND);


