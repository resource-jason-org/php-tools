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

<?php
/**
 * php 发送http post get 请求
 */
header('Content-Type: text/html; charset=UTF-8');

function send_post($url, $post_data) {
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',//or GET
            'header' => array('Content-type:application/x-www-form-urlencoded',
            'Cookie:adminUserId=10; Hm_lvt_7b1919221e89d2aa5711e4deb935debd=1458710012; CNZZDATA1000310955=821610460-1444729678-%7C1462155006; CNZZDATA5517574=cnzz_eid%3D1611205201-1444729374-%26ntime%3D1462437670; PHPSESSID=3a62f5485732929620cf3; CNZZDATA1000493589=1225702284-1444701670-%7C1462936498'
            ), 
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
$result=send_post('http://www.ddf.com/user.php', $post_data);

print_r($result);
  //PHP接收方法
  /**
   * $input=file_get_contents("php://input");
		file_put_contents("java.xml",$input);
		print_r($input);
   */
   
   
   
   
   
   
?>

<?php
/**
 * 使用PHP Socket 编程模拟Http post和get请求
 * @author koma
 */

header("Content-type: text/html; charset=utf-8");
class Http{
    private $sp = "\r\n"; //这里必须要写成双引号
    private $protocol = 'HTTP/1.1';
    private $requestLine = "";
    private $requestHeader = "";
    private $requestBody = "";
    private $requestInfo = "";
    private $fp = null;
    private $urlinfo = null;
    private $header = array();
    private $body = "";
    private $responseInfo = "";
    private static $http = null; //Http对象单例
     
    private function __construct() {}
     
    public static function create() {
        if ( self::$http === null ) { 
            self::$http = new Http();
        }
        return self::$http;
    }
     
    public function init($url) {
        $this->parseurl($url);
        $this->header['Host'] = $this->urlinfo['host'];
        return $this;
    }
     
    public function get($header = array()) {
        $this->header = array_merge($this->header, $header);
        return $this->request('GET');
    }
     
    public function post($header = array(), $body = array()) {
        $this->header = array_merge($this->header, $header);
        if ( !empty($body) ) {
            $this->body = http_build_query($body);
            $this->header['Content-Type'] = 'application/x-www-form-urlencoded';
            $this->header['Content-Length'] = strlen($this->body);
        }
        return $this->request('POST');
    }
     
    private function request($method) {
        $header = "";
        $this->requestLine = $method.' '.$this->urlinfo['path'].'?'.$this->urlinfo['query'].' '.$this->protocol;
        foreach ( $this->header as $key => $value ) {
            $header .= $header == "" ? $key.':'.$value : $this->sp.$key.':'.$value;
        }
        $this->requestHeader = $header.$this->sp.$this->sp;
        $this->requestInfo = $this->requestLine.$this->sp.$this->requestHeader;
        if ( $this->body != "" ) {
            $this->requestInfo .= $this->body;
        }
        /*
         * 注意：这里的fsockopen中的url参数形式为"www.xxx.com"
         * 不能够带"http://"这种
         */
        $port = isset($this->urlinfo['port']) ? isset($this->urlinfo['port']) : '80';
        $this->fp = fsockopen($this->urlinfo['host'], $port, $errno, $errstr);
        if ( !$this->fp ) {
            echo $errstr.'('.$errno.')';
            return false;
        }
        if ( fwrite($this->fp, $this->requestInfo) ) {
            $str = "";
            while ( !feof($this->fp) ) {
                $str .= fread($this->fp, 1024);
            }
            $this->responseInfo = $str;
        }
        fclose($this->fp);
        return $this->responseInfo;
    }
     
    private function parseurl($url) {
        $this->urlinfo = parse_url($url);
    }
}
// $url = "http://news.163.com/14/1102/01/AA0PFA7Q00014AED.html";
$url = "http://localhost/20160323/response.php";
$http = Http::create()->init($url);
/* 发送get请求 
echo $http->get(array(
    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',
));
*/
 
/* 发送post请求 */
echo $http->post(array(
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',
), array('username'=>'发一个中文', 'age'=>22));

?>
<?php


   
   /**
    * curl
    * @param unknown $url
    * @param unknown $data
    * @param unknown $H
    * @return mixed
    */
    function curlRequest($url,$data,$type='POST'){
        if($type=='GET')
          ECHO $url=$url.'?'.http_build_query($data);
       $ch = curl_init($url);
      // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
       curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       //curl_setopt($ch, CURLOPT_HTTPHEADER, $H );
       $result = curl_exec($ch);
       
       print_r($result);
       
       return $result;
   }
	
	
	
	
	 /**
    * 建立请求，以表单HTML形式构造（默认）
    * @param $para_temp 请求参数数组
    * @param $method 提交方式。两个值可选：post、get
    * @param $button_name 确认按钮显示文字
    * @return 提交表单HTML文本
    */
   function buildRequestForm($url,$para_temp,$method='POST', $button_name='') {
   
       $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$url."' method='".$method."'>";
       while (list ($key, $val) = each ($para_temp)) {
           $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
       }
        if($button_name)
        $sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";
        $sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";
   
       return $sHtml;
   }



	function doRequest($url, $param=array()){

		$urlinfo = parse_url($url);

		$host = $urlinfo['host'];
		$path = $urlinfo['path'];
		$query = isset($param)? http_build_query($param) : '';

		$port = 80;
		$errno = 0;
		$errstr = '';
		$timeout = 10;

		$fp = fsockopen($host, $port, $errno, $errstr, $timeout);

		$out = "POST ".$path." HTTP/1.1\r\n";
		$out .= "host:".$host."\r\n";
		$out .= "content-length:".strlen($query)."\r\n";
		$out .= "content-type:application/x-www-form-urlencoded\r\n";
		$out .= "connection:close\r\n\r\n";
		$out .= $query;

		fputs($fp, $out);
		fclose($fp);
	}
	doRequest("http://localhost/20160525/1.php",array('bbb'=>'test'));



