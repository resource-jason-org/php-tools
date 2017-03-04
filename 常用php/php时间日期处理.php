<?php   
     date("Y-m-d H:i:s")
	
	 echo strtotime(date("Y-m-d")); //时间戳
	
  	 $today=date("Y-m-d H:i:s"); 
	 
     $todays=date("Y-m-d",strtotime('+1 day'));//明天

     $Lstart=date("Ym01",strtotime("$create_time -1 month")); //上个月第一天
	 
	  $Lend=date("Ymd",strtotime("$Lstart +1 month -1 day"));//本月最后一天

     $today=strtotime($today);
     $todays=strtotime($todays);