<?php


	protected function debug() {
	    if ($this->debug) {
	        $file=C("SWITCH_DB_DEBUG_LOG");$Q=$this->Q ();
	        $runtime = number_format ( microtime ( TRUE ) - $this->beginTime, 6 );
	        if($Q == 1){
	            $logcontent="======END======\n=====START=====[date:".date("Y-m-d H:i:s")."]\n";
	            if(C("SWITCH_DB_DEBUG_TRANCE_SESSION")){
	                $logcontent.='[db'.$this->cNum.']'."[".$Q."]SESSION Trance: [>>>\nCOOKIE: ".
	                    var_export($_COOKIE,TRUE)."\nSESSION: ".var_export($_SESSION,TRUE).
	                    "\n[db$this->cNum][".$Q."]SESSION Trance END [date:".date("Y-m-d H:i:s")."] === <<<]\n";
	            }
    	        if(C("SWITCH_DB_DEBUG_TRANCE_REQUEST")){
    	            $uIP=function (){ $ip="";
    	            if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP");
    	            else if(getenv("HTTP_X_FORWARDED_FOR"))$ip = getenv("HTTP_X_FORWARDED_FOR");
    	            else if(getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR");
    	            else $ip = "Unknow"; return $ip;};
    	            $logcontent.='[db'.$this->cNum.']'."[".$Q."]REQUEST Trance: [>>> \n"."ip :".$uIP()."\nINPUT: ".
    	                var_export(file_get_contents("php://input"),TRUE)."\nREQUEST: ".var_export($_REQUEST,TRUE).
    	                "\n[db$this->cNum][".$Q."]REQUEST Trance END [date:".date("Y-m-d H:i:s")."] === <<<]\n";
    	        }
	        }
	        if(C("SWITCH_DB_SQL_TRANCE")){
	            $logcontent.='[db'.$this->cNum.']'."[".$Q."]".' TIME = '.$runtime . "s SQL = " . $this->queryStr.' [date:'.date("Y-m-d H:i:s")."]\n";
	        }
	        if(C("SWITCH_DB_DEBUG_TRANCE")){
	            $e = new Exception;
	            $logcontent.='[db'.$this->cNum.']'."[".$Q."]Trance: [>>> \n".
	                var_export($e->getTraceAsString(),true)."\n[db$this->cNum][".$Q."]Trance END [date:".date("Y-m-d H:i:s")."] === <<<]\n";
	        }
	       
	        $this->log_put_contents($file,$logcontent.="================================================\n",FILE_APPEND);
	    }
	}
/**
	 * 记录文件日志
	 * (non-PHPdoc)
	 * @see Db::debug()
	 */
	protected function debug() {
	    if ($this->debug) {
	        $file=C("SWITCH_DB_DEBUG_LOG");$Q=$this->Q ();
	        $runtime = number_format ( microtime ( TRUE ) - $this->beginTime, 6 );
	        ($Q == 1)&&$logcontent="======END======\n=====START=====\n";
	        if(C("SWITCH_DB_SQL_TRANCE")){
	            $logcontent.='[db'.$this->cNum.']'."[".$Q."]".' TIME = '.$runtime . "s SQL = " . $this->queryStr.' [date:'.date("Y-m-d H:i:s")."]\n";
	        }
	        if(C("SWITCH_DB_DEBUG_TRANCE")){
	            $e = new Exception;
	            $logcontent.='[db'.$this->cNum.']'."[".$Q."]Trance: [>>> \n".
	                var_export($e->getTraceAsString(),true)."\n[db$this->cNum][".$Q."]Trance END [date:".date("Y-m-d H:i:s")."] === <<<]\n";
	        }
	        if(C("SWITCH_DB_DEBUG_TRANCE_REQUEST")){
	           $uIP=function (){ $ip="";
                    if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP");
                    else if(getenv("HTTP_X_FORWARDED_FOR"))$ip = getenv("HTTP_X_FORWARDED_FOR");
                    else if(getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR");
                    else $ip = "Unknow"; return $ip;};
	            $logcontent.='[db'.$this->cNum.']'."[".$Q."]REQUEST Trance: [>>> \n"."ip :".$uIP()."\nINPUT: ".
	                var_export(file_get_contents("php://input"),TRUE)."\nREQUEST: ".var_export($_REQUEST,TRUE).
	                   "\n[db$this->cNum][".$Q."]REQUEST Trance END [date:".date("Y-m-d H:i:s")."] === <<<]\n";
	        }
	        $this->log_put_contents($file,$logcontent.="================================================\n",FILE_APPEND);
	    }
	}
	
	/**
	 * 备份记录日志
	 * @param unknown $filename
	 * @param unknown $data
	 * @param unknown $flags
	 */
	private function log_put_contents($filename, $data, $flags = null){
	    C("SWITCH_DB_DEBUG_LOG_BAK")&&(date("Ymd") !=date("Ymd",filemtime($filename)))&&rename($filename,$filename."_bak".date("Ymd").".xml");
	     file_put_contents($filename,$data,$flags);
	}
	
