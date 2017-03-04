<?php 

define('FILE', dirname(__FILE__).'/');
class daemon{
    public $pidFileLocation= 'daemon.pid';
    
    public $file;
    
   
    public function __construct(){
        
        set_time_limit(0);
        $this->pidFileLocation=FILE.$this->pidFileLocation;
        
        file_put_contents($this->pidFileLocation,'');
        
        $this->_logMessage("DAEMON START ...");
       // if(trim(file_get_contents(FILE.'./daemon.ctrl')) == '1')
          //register_shutdown_function(array(&$this, 'restart'));
    }

    
    
    public function daemon(){
        $this->_logMessage('START FUNCTION START...');
        
        while (trim(file_get_contents(FILE.'daemon.ctrl')) == '1'){
        
          //  ob_start();
            $this->getData();
          //  $text = ob_get_clean();
         //   echo $text;
            file_put_contents('DAEMON_STATUS.S',date("Y-m-d H:i:s").'\n');
            $this->_fork();
            sleep(15);
        }
    }
    
    public function restart(){
        file_put_contents($this->pidFileLocation,'');
        $this->_logMessage('restart... beginPID: '.$this->pidFileLocation.' ');
        $this->daemon();
        
      
        
    }
    
    /**
     * Forks process
     *
     * @return bool
     */
    private function _fork() {
    
        $pid = pcntl_fork();
        if ($pid == -1) {
            register_shutdown_function(array(&$this, 'restart'));
            $this->_logMessage('pcntl_fork Could not start');
            return false;
        } elseif ($pid) {
            $this->_logMessage('pcntl_fork kill this pid');
            exit();
        } else {
            $this->_logMessage('start pcntl_fork this pid');
            $pid=posix_getpid();
            if (!$fp = fopen($this->pidFileLocation, 'w')) {
                $this->_logMessage('Could not write to PID file');
                return false;
            } else {
                fputs($fp,$pid);
                fclose($fp);
            } 
            return true;
        }
    }
    
    
    public function _logMessage($data){
        $time=date("Y-m-d H:i:s");
        $text="\n\n<TIME>$time</TIME>\n";
        file_put_contents(FILE.'deamon.log',$text.$data.'\n \n',8);
    }
    
    
    
    
    
    
    public function getData(){
        echo "======================getdata============================= \n";
        
    /**
     * 特殊处理的游戏名称
     */
    $otherdatas=array(
        'Fruit Fiesta','Lotsaloot','Cash Splash'
    );
    
    /**
     *  设置货币
    */
    
    (empty($argv[1]))?$currencyCode="USD":$currencyCode=$argv[1];
    
    $url = 'https://api2.gameassists.co.uk/casino/progressive/v1/counters?currencyIsoCode='.$currencyCode;
    
    $files=dirname(__FILE__);
    $files=$files."/jackpotsdate.html";
    $json=$this->send_post($url);
    $data =json_decode( $json,true);
    if($data){
        $xmlData=array();
        $oData=array();
        foreach ($data as $key=>$row){
            if($row['gamePayId']==0){
                $xmlData[$key]['jackpotName'] = str_replace( "™", "",$row['friendlyName']);
                $xmlData[$key]['jackpotCValue'] = $row['startAtValue'];
                $xmlData[$key]['jackpotCValue_end'] = $row['endAtValue'];
                if(in_array($xmlData[$key]['jackpotName'], $otherdatas)){
                    $oData[$key]= $xmlData[$key];
                    $oData[$key]['jackpotName'] =  $xmlData[$key]['jackpotName'].' 5 Reel';
                }
            }
        }
        $data= $this->toXml(array_merge($xmlData,$oData)) ;
        echo '\n';
        echo file_put_contents($files,$data);
        print(' GET JACKPOT SUCCESS ! CURRENCY: '.$currencyCode);
        echo $time=date("Y-m-d H:i:s");
        echo '\n';
    }else{
        echo '\n';
        print("GET JACKPOT API ERROR! URL: ". $url );
        echo $time=date("Y-m-d H:i:s");
        echo '\n';
        syslog(LOG_ERR,"GET JACKPOT API ERROR! URL: ". $url );
      }
    }
    
    
    
    
    function send_post($url, $post_data='') {
        $postdata='';
        if($post_data)
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
    
    
    
    
    function curlJson($url,$data='',$H='',$type='GET'){
        // $data_string = json_encode($data);
        //echo $data_string;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        //curl_setopt($ch, CURLOPT_NOSIGNAL,true);//支持毫秒级别超时设置
        //curl_setopt($ch, CURLOPT_TIMEOUT_MS,1);  //超时毫秒，cURL 7.16.2中被加入。从PHP 5.2.3起
        //curl_setopt($ch, CURLOPT_TIMEOUT,1); //设置超时
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $H );
        $result = curl_exec($ch);
    
        return $result;
    }
    
    
    
    function curl_request($url,$post='',$cookie='', $returnCookie=0){
        
        return file_get_contents($url);
        
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://www.baidu.com");
        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if($returnCookie){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        }else{
            return $data;
        }
    }
    
    /**
     * 转xml
     * @param unknown $data
     * @param string $rootNodeName
     * @param number $stand
     * @return mixed
     */
    function toXml($data,$rootNodeName = 'Counters'){
        $xml="<?xml version='1.0' encoding='utf-8'?> \n ";
        $xml.="<Counters> \n ";
        foreach($data as $key => $value){
            $xml.= "<Counter> \n ";
            foreach($data[$key] as $k=>$r){
                $xml.= "<$k>".$r."</$k> \n ";
            }
            $xml.= "</Counter> \n ";
        }
        $xml.="</Counters> \n";
        return $xml;
    }
    
    function xml_parser($str){
        $xml_parser = xml_parser_create();
        if(!xml_parse($xml_parser,$str,true)){
            xml_parser_free($xml_parser);
            return false;
        }else {
            return (json_decode(json_encode(simplexml_load_string($str)),true));
        }
    }
    
    
}
    
    $daemon=new daemon();
    
    $daemon->daemon();
?>