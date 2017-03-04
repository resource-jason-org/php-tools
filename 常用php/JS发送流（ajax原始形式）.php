<?php
/**
 * php 发送http post get 请求
 */
header("Content-type:text/html;charset=utf-8");
function send_post($url, $post_data) {
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'GET',//or GET
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}
//使用方法
$post_data = array(
    'username' => 'stclair2201',
  'password' => 'handan'
  );
  $result=send_post('http://www.ddf.com', $post_data);
  
  print_r($result);
  //PHP接收方法
  /**
   * $input=file_get_contents("php://input");
		file_put_contents("java.xml",$input);
		print_r($input);
   */
   
   
   
   
   
   
?>


<script>
//javascript发送流

function createXmlObj(){ 
	  var signatures = ["Msxml2.DOMDocument.5.0","Msxml2.DOMDocument.4.0","Msxml2.DOMDocument.3.0","Msxml2.DOMDocument","Microsoft.XmlDom"];
	  for(var i = 0;i<signatures.length;i++){ 
	   try{ 
	    var xmlDom = new ActiveXObject(signatures[i]); 
	   }catch(e){ 
	    //忽略错误,继续测试下一个版本 
	   } 
	  } 
	  return xmlDom.xml; 
	} 

	/* 
	创建XMLHttpRequest请求对象 
	*/ 
	function createXMLhttp(){ 
	  var xmlhttp; 
	  try{ 
	   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
	  }catch(e){ 
	   try{ 
	    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
	   }catch(e){ 
	    try{ 
	     xmlhttp = new XMLHttpRequest(); 
	    }catch(e){} 
	   } 
	  } 
	  return xmlhttp; 
	} 

	function sendInfor(){ 
	//var XmlObj = createXmlObj(); 
	//alert(XmlObj); 
	//根据不同的浏览器创建不同的XMLHttpRequest对象 
	var xmlhttp = createXMLhttp(); 
	xmlhttp.open("post",'/index.php?s=/Index_ceshi',false); 
	//设置请求的HTTP头 
	//xmlhttp.setRequestHeader("Content-Type"," application/utf-8 ");   
	     xmlhttp.setRequestHeader("Content-Type","text/html;charset=UTF-8");    
         xmlhttp.send("ceshiyixia"); 		
         //xmlhttp.send(JSON.stringify(objects)); 	//发送json		 
	     xmlhttp.onreadystatechange=function(){ 
	     if (xmlhttp.readyState==4){ 
	          alert("发送成功!"); 
			  var aa = xmlhttp.responseText;
			  alert(aa);
	     } 
	   }   
	    //发送请求 
	  
	   // var aa = xmlhttp.ResponseText;//得到后台传递过来的text文本信息 
	
	
	//var test =xmlhttp.responseStream;//得到后台传递过来的输入流信息--一般不用 
	//alert(aa); 
	//把后台传递过来的信息aa用js放到页面中指定的位置 
	} 
</script>