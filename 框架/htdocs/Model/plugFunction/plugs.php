<?php

    /**
	 * 获取指定月份从起始到结束的的循环
	 */
	public function time_day_tody(){
		 $time=time();
		//echo $time;
		//echo date("Y-m-d H:i:s" ,$time); echo "<br>";
		 $days = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
		 $days=$days-date("d");
		for($D=1;$D<$days;$D++){
			 $day=date("Y-m-d",strtotime("+$D day")); echo "<br>";
			 $xq=date("w",strtotime("+$D day"));
			 strtotime($day);echo "<br>";
			 $t=$D+1;
			 $tday=date("Y-m-d",strtotime("+$t day"));echo "<br>";
			 $xqt=date("w",strtotime("+$t day"));
			 strtotime($tday);echo "<br>";
			 echo "范围从".$day.'星期'.$xq."到".$tday."减一秒星期".$xqt;
        }
	}
		/**
  	 * 递归获取
  	 */
  	private function getsSonAgentid($aid){
  	    $allPid=M('Agent')->where ( array('parent_id'=>$aid) )->field('id')->select();
  	    foreach($allPid as $k=>$r){
  	        $son=$this->getsSonAgentid($r['id']);
  	        if($son){
  	            $allPid[$k][$r['id']]=$son;
  	        }
  	    }
  	    return $allPid;
  	}
  	/**
  	 * 递归获取
  	 */
  	public function getsSonAgentids($aid){
  	    $aid = Session::get('agent_id');
  	    $allPid=$this->getsSonAgentid($aid);
  	    return $allPid;
  	}
	/**
	 *  抓取网页内容
	 */
    public function getNetContent(){
		header("Content-type: text/html; charset=utf-8");
		$url = 'http://blog.sina.com.cn/s/blog_5be180e60101bxzb.html';  //这儿填页面地址
		$info=file_get_contents($url);
		preg_match_all('/<font color="#464646">(.*?)<\/font>/si',$info,$m);
		//print_r(trim($m[1][1]));
		print_r($m);
	}

?>