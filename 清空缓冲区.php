<?php

header('Content-Type: text/html; charset=UTF-8');
for($i=0;$i<10;$i++){

    echo 'test';
     
    flush();
    ob_flush();

    sleep(2);
}


 set_time_limit(0);
    echo "<br/>";
	
	
	//需要定义 header('Content-Type: text/html; charset=UTF-8');
	ob_flush();//数据从PHP的缓冲中释放出来
  	flush();//被释放出来的数据发送到浏览器
	sleep(5);
 
 
 
    ob_start();
	            var_dump($find);
	$text = ob_get_clean();
	
	
	
	