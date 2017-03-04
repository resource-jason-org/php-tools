<?php 
    if(@empty($_GET['s'])){
        header('HTTP/1.1 404 Not Found'); header('status: 404 Not Found'); exit();
    }
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<!-- en bro edit 1127-->
	<title>提示信息</title>
	<style type="text/css">
		#loading{text-align:center;margin:20px auto 0 auto;color:#00192d;margin:8% auto 0 auto;font-family:"Hiragino Kaku Gothic Pro", "MS PGothic", "MS UI Gothic",verdana, Arial, tahoma;max-width:450px;padding:15px;}
		#loading h1 {font-size:16px;color:#666;font-weight:100;line-height:30px;}
		#loading a {color:#fff;background:#37b1e0;background:-moz-linear-gradient(top,#37b1e0 0,#1da8ed 49%,#1a98d5 50%,#017fb9 100%);background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#37b1e0),color-stop(49%,#1da8ed),color-stop(50%,#1a98d5),color-stop(100%,#017fb9));background:-webkit-linear-gradient(top,#37b1e0 0,#1da8ed 49%,#1a98d5 50%,#017fb9 100%);background:-o-linear-gradient(top,#37b1e0 0,#1da8ed 49%,#1a98d5 50%,#017fb9 100%);background:-ms-linear-gradient(top,#37b1e0 0,#1da8ed 49%,#1a98d5 50%,#017fb9 100%);background:linear-gradient(to bottom,#37b1e0 0,#1da8ed 49%,#1a98d5 50%,#017fb9 100%);padding:8px 25px;border-radius:8px;font-size:18px;text-decoration:none;}
		#loading h1 b {color:#d51e1b;padding:0 5px;font-size:22px;}
	</style>
</head>

<body>
	<div id="loading" >
		<img class="loadingImg" alt="loading" src="./paw-loader-large.gif">
			<br><br>
		<h1>提示信息 ：
		<?php 
		 if(@$_GET['s'] == '1') {   
             echo "交易成功！";
		  }else{
		     echo "交易失败！";
		  }
		?>
		</h1>
		<!-- 
	
		<h1>
			
			页面在
			<b id="time"> 
				5
			</b>
			后关闭
			
		</h1><br>
		<a href="javascript:window.opener=null;window.open('','_self');window.close();">关闭</a>
		
		 -->
		<br><br>
	</div>
	<!-- 
	<script type="text/javascript" src="./jquery-1.8.0.min.js"></script>
	
	
	<script type="text/javascript">
	var demo = [];
	demo.loading=function(){//定义显示loading的js方法
		$("#loading").css("left",($(window).width()-$("#loading").outerWidth())/2+$(window).scrollLeft()+"px");
		$("#whiteOverlay").css("height",document.body.clientHeight+"px");
		$("#whiteOverlay").css("width",document.body.clientWidth+"px");
		$("#loading").css("top",($(window).height()-$("#loading").outerHeight())/2+$(window).scrollTop()+"px");
		$("#loading").show();
		$("#whiteOverlay").show();
	};
	demo.hiding=function(){//定义隐藏loading的就是方法
		//$("#loading").hide();
		//$("#whiteOverlay").hide();
		//window.open('about:blank','_self'); window.close();

		open(location, '_self').close();

		
	};
	$(document).ready(function(){
		demo.loading();//页面加载的时候调用显示loading框。
	});
	
	
	$(window).load(function () {
		setTimeout("demo.hiding()",5*1000);
		window.setInterval('doUpdate()', 1000); 
		//这里我为了给大家展示清楚 特意 在页面正常加载后 5秒才关闭loading。
		// 大家到时应用到项目中的时候 可以去掉延迟  ，使用下面一行代码
		// demo.hiding();  //这样可以在页面加载完毕后 立马关闭loading状态
	});
	</script>
	<script type="text/javascript">
		var secs = 5;
		function doUpdate() { 
			if(secs>0){
			secs--;
			document.getElementById('time').innerHTML = secs+""; 
			}
		}
	</script>
	
	 -->
</body>
</html>