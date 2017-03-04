<?php
    /////////////////////function use//////////////////////////
	$msg = "Hello, everyone"; //可以传递预先定义好的$msg
	$callback = function () use (&$msg) {
		print "This is a closure use string value lazy bind, msg is: $msg. <br />/n";
	};
	
	$msg = "Hello, everybody";
	call_user_func($callback);
	/////////////////////function use//////////////////////////    

    ///////////////////数组处理////////////////////////

	$records = array(
	  array(
		'id' => 2135,
		'first_name' => 'John',
		'last_name' => 'Doe',
	  ),
	  array(
		'id' => 3245,
		'first_name' => 'Sally',
		'last_name' => 'Smith',
	  ),
	  array(
		'id' => 5342,
		'first_name' => 'Jane',
		'last_name' => 'Jones',
	  ),
	  array(
		'id' => 5623,
		'first_name' => 'Peter',
		'last_name' => 'Doe',
	  )
	);
	  
	$first_names = array_column($records, 'first_name');                              
	print_r($first_names);
	Array
	(
	  [0] => John
	  [1] => Sally
	  [2] => Jane
	  [3] => Peter
	)
	$last_names = array_column($records, 'last_name', 'id');
    print_r($last_names);
	
	
	$a = array_map(function($element){ 　//$records作为参数传入回调函数
　　return $element['last_name'];　　//返回数组元素值的last_name对应值
       }, $records);　　　　　　　　　　　　//array_map返回数组，相当于把每个$element['last_name']存入新数组，所以是新建的索引

	
	/////////////////////////////////////array_walk////////////////////////////////////
	
	$words=array("l"=>"lemon","o"=>"orange","b"=>"banana","a"=>"apple");
    //定义一个回调函数，输出数组元素
   function words_print($value,$key,$prefix){
       echo "$prefix:$key=>$value<br>\n";
   }
   //定义一个回调函数直接改变元素的值
   function words_alter(&$value,$key){
       $value=ucfirst($value);
       $key=strtoupper(key);
   }
   //输出元素的值
   array_walk($words,'words_print','words');
   //改变元素的值
   array_walk($words,'words_alter');
   echo "<pre>";
   print_r($words);
   echo "</pre>";
   /////////////////////////////////////////////////////////////////////////////////////
	
    ///////////////////数组处理////////////////////////
	
	//////////////////////////////call_user_func////////////////////
	
	
	    call_user_func(array($this,'acceptConnection'));
        
        call_user_func_array(array($this,'acceptConnection'),array());
		
		////////////////////////////////////////////////
	
	
	
	
	
	
	
	/////////////////////// 变量定义 /////////////////
	
	$a=${'_REQUEST'};
    print_r($a);
    //////////////////////////////////////////////////
	
    