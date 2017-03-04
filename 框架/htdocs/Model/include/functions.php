<?php
/**
 * 系统函数
 * @author jason
 *
 */
class functions{
   public function __construct(){
       $tmp=$this->Get_config(Home.'_tpl');
       if(empty($tmp)){
           $tmp='default';
       }
       $GLOBALS=array(
            'db'=>$this->Conn(),
            'tmp'=>new template(),
            'tpl'=>Home.'/Views/'.$tmp.'/Tpl/',
            'catch'=>Home.'/Views/'.$tmp.'/Tpl/',
            'USE_CATCH'=>USE_CATCH
        );
       if(LANG != 0){
           $_SESSION['lang']=LANG;
       }
    }
    /**
     * 显示模板
     */
    public function display($tmp=''){
       $template= new template();
       $template->display($tmp);
    }
    
    /**
     * 获取配置文件
     */
    public function Get_config($key){
        //相对于网站根目录
        require 'Config/config.php';
        @$value=$result[$key];
        return $value;
    }
    
    /**
     * 链接数据库
     * @return mysql
     */
    public function Conn(){
       $host=   $this->Get_config('dbhost');
       $user=   $this->Get_config('dbuser');
       $pwd=    $this->Get_config('dbpwd');
       $dbName= $this->Get_config('dbName');
       $charset=$this->Get_config('dbcharset');
       $mysql=new mysql($host, $user, $pwd, $dbName, $charset);
       return $mysql;
    }
    /**
     * 向服务端发送xml数据
     * @param unknown $xml_data
     * @param unknown $url
     * @return number|unknown
     */
    public function Curl_post_xml($xml_data,$url){
        if(empty($xml_data) || empty($url)){
            return 0;
        }
        $header[] = "Content-type: text/xml";//定义content-type为xml
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//设置链接
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//设置HTTP头
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);//POST数据
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
        $response = curl_exec($ch);//接收返回信息
        echo curl_multi_getcontent($ch);
        if(curl_errno($ch)){//出错则显示错误信息
            print curl_error($ch);
        }
        curl_close($ch); //关闭curl链接
        return $response;
    }
    
    /**
     * curl接收xml
     */
    public function Curl_receive_xml(){
        //$xml = $HTTP_RAW_POST_DATA;
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        //$handle  = fopen('a.xml','a+');
        //fwrite($handle,$xml);
        return $xml;
    }
    /**
     * ajax定时刷新
     * $url 刷新的路径
     * $time 刷新时间
     * $path jquery的路径
     */
    public function task_Ajax($url,$time='6000',$path=''){
        if(empty($path)){
           $path='../Public/jquery/jquery.js';
        }
        echo "<html>
        <head>
        <script type='text/javascript' src='$path'></script>
        </head>
        <script type='text/javascript'>
        $(document).ready(function(){
        var subject=1;
        var data={subject:subject};
        setInterval(function() { Push(data); },$time);
        });
        /*请求函数的ajax*/
        function Push(data) {
        $.ajax({
        type : 'POST',
        data :data ,
        dataType:'json',
        url  : '$url',
        });
        }
        </script>
        <body>
        </body>
        </html>";
    }
}
?>
