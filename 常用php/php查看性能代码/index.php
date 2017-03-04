<?php 

//////////测试php性能的代码////////

   $list=array();
   for($i=0;$i<10000;$i++){
       $list[]=$i;
   }

  echo $sM=memory_get_usage(); echo '<br>';
  $stime = microtime(true);
 
  $r=serialize($list);
  $etime = microtime(true);
  echo  $eM=memory_get_usage();
  
  
  echo "unserialize :", ($etime - $stime),'<br/>';
  echo "unserialize momory :", ($eM - $sM)/1024,'<br/>';
  
  
  $sM=memory_get_usage();
  $stime = microtime(true);
  
  $r=unserialize($r);
  
  $etime = microtime(true);
  $eM=memory_get_usage();
  echo "serialize :", ($etime - $stime) ,'<br/>';
  echo "serialize momory :", ($eM - $sM)/1024,'<br/>';
  
  
  
  
  
  
  ////////////////////////////////////////////////
  
    $sM=memory_get_usage();
  
  
    $eM=memory_get_usage();
  
  
  echo ($eM - $sM)/1024,'<br/>';
  
  ////////////////////////////////////////////////
  
  
  
  
    ////////////////////////////////////////////////
  
  $stime = microtime(true);

  
  
  $etime = microtime(true);
  echo  $etime - $stime;
  
    ////////////////////////////////////////////////
	
	
	
	
	
	
	
	
	//////////////////////////////////////////////////
	
	    declare(ticks=1);
	    $tics_stime = microtime(true);
	    $tics_sM=memory_get_usage();
	    $tics_dlimit=0.009;
	    define('tics_sM', $tics_sM);
	    define('tics_dlimit', $tics_dlimit);
	    define('tics_stime', $tics_stime);
	    $GLOBALS['tics_Times']=0;
	    function ticks_checkTimeout(){
	        static $tics_c=0,$tics_time=0,$tics_mem=0;
	        $ticks_bt = debug_backtrace();
	        $tics_hight=0;
	        $tics_etime = microtime(true);
	        $tics_eM=memory_get_usage();
	        $tics_limitTime=($tics_etime - tics_stime - $tics_time);
	        $tics_time=$tics_limitTime + $tics_time;
	        $tics_limitMem=(($tics_eM - tics_sM - $tics_mem)/1024);
	        $tics_mem=$tics_mem + $tics_limitMem;
	        $debug="&nbsp; File: ".$ticks_bt[0]['file']." Line: ".$ticks_bt[0]['line'];
	        $tics_console="&nbsp;<font color='red'>---></font>&nbspMem: ".$tics_limitMem." TIMES: ". $tics_limitTime."s";
	        if($tics_limitTime>tics_dlimit):
	        $tics_console.= '&nbspExecute:<font color="red"> Timeout:'. $tics_c++.'</font>'.$debug.'<br/>';
	        $tics_hight=1;
	        else:
	        $tics_console.= '&nbspExecute:<font color="#3eaf1b">'. $tics_c++.'</font>'.$debug.'<br/>';
	        endif;
	        if($tics_hight>0)echo $tics_console;
	        //  if($tics_c>1)echo $tics_console;
	    }
	    register_tick_function('ticks_checkTimeout');
	    
	
	/////////////////////////////////////////////////////////////////////
	
	
	
	   /**
	     * $tics_hight 是否启用时间限制
	     * $tics_dlimit 设置时间
	     */
	    declare(ticks=1);
	    $tics_stime = microtime(true);
	    $tics_sM=memory_get_usage();
	    
	    //设置执行多久打印
	    $tics_dlimit=0.009;
	    
	    define('tics_sM', $tics_sM);
	    define('tics_dlimit', $tics_dlimit);
	    define('tics_stime', $tics_stime);
	    $GLOBALS['tics_Times']=0;
	    function ticks_checkTimeout(){
	        static $tics_c=0,$tics_time=0,$tics_mem=0;
	        $ticks_bt = debug_backtrace();
	        $tics_hight=0;
	        $tics_etime = microtime(true);
	        $tics_eM=memory_get_usage();
	        $tics_limitTime=($tics_etime - tics_stime - $tics_time);
	        $tics_time=$tics_limitTime + $tics_time;
	        $tics_limitMem=(($tics_eM - tics_sM - $tics_mem)/1024);
	        $tics_mem=$tics_mem + $tics_limitMem;
	    
	        $debug=" &nbsp; File: ".$ticks_bt[0]['file']." Line: ".$ticks_bt[0]['line'];
	        $tics_console=" &nbsp;<font color='red'>---></font>&nbspMem: ".$tics_limitMem." TIMES: ". $tics_limitTime."s";
	        if($tics_limitTime>tics_dlimit):
	        $tics_console.= ' &nbspExecute:<font color="red"> Timeout:'. $tics_c++.'</font>'.$debug.'<br/> \n ';
	        $tics_hight=1;
	        else:
	        $tics_console.= ' &nbspExecute:<font color="#3eaf1b">'. $tics_c++.'</font>'.$debug.'<br/> \n ';
	        endif;
	    
	        $tics_console.="\n";
	        // if($tics_hight>0)
	        putTo($tics_console);
	        //  if($tics_c>1)echo $tics_console;
	        //  file_put_contents('./serverDebug',$tics_console, FILE_APPEND);
	    
	    }
	    
	    function putTo($data){
	        //echo $data;
	        file_put_contents('./serverDebug.xml',$data, FILE_APPEND);
	    }
	    
	    putTo("\n <br/>=======================================================================<br/> \n");
	    register_tick_function('ticks_checkTimeout');
	
	
	
	
	
?>



