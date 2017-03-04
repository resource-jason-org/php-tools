<?php
require 'Model/include/defined.php';
require  InModel.'template.php';
require  Action;
require  Mysql;
require  Page;
require  Install;
header("Content-type: text/html; charset=utf-8");
/**
 * 
 * @author Jason 2015.1.20
 *
 */
/**
//                            _ooOoo_
//                           o8888888o
//                           88" . "88
//                           (| -_- |)
//                            O\ = /O
//                        ____/`---'\____
//                      .   ' \\| |// `.
//                       / \\||| : |||// \
//                     / _||||| -:- |||||- \
//                       | | \\\ - /// | |
//                     | \_| ''\---/'' | |
//                      \ .-\__ `-` ___/-. /
//                   ___`. .' /--.--\ `. . __
//                ."" '< `.___\_<|>_/___.' >'"".
//               | | : `- \`.;`\ _ /`;.`/ - ` : | |
//                 \ \ `-. \_ __\ /__ _/ .-` / /
//         ======`-.____`-.___\_____/___.-`____.-'======
//                            `=---='
//
//         .............................................
//                  佛祖镇楼                  BUG辟易
//          佛曰:
//                  写字楼里写字间，写字间里程序员；
//                  程序人员写程序，又拿程序换酒钱。
//                  酒醒只在网上坐，酒醉还来网下眠；
//                  酒醉酒醒日复日，网上网下年复年。
//                  但愿老死电脑间，不愿鞠躬老板前；
//                  奔驰宝马贵者趣，公交自行程序员。
//                  别人笑我忒疯癫，我笑自己命太贱；
//                  不见满街漂亮妹，哪个归得程序员？
 */
class G 
{
    static function start_session(){
        require InModel.'session_start.php';
        $session=new session();
        //$countUser=$session->getCountUser();
        $sessionid=$session->getSessionId();
    }
    /**
     * MVC start
     */
    static function start_mvc(){
        G::start_session();
        //获取url
        $controller = G::get_url();
        $action_name = $controller['action'];
        if ($action_name) {
            if(!is_dir(URL)){
               $install=new install(Home);
               $install->start_install();
            }
            $action_file=URL . $action_name . PHP;
            if (!file_exists($action_file)) {
                echo "<div style='width:100%;height:100px;'><span style='color:red;font-weight:900;'>非法操作!<span></div>";
                exit();
            }
            // 引入文件
            require $action_file;
            // 获取class名称
            $action = $action_name . Model;
            // 实例化类
            $new = new $action();
            $function = $controller['function'];
            //设置global的action和function的值
            G::Set_global('action',$action_name);
            G::Set_global('function',$function);
            $new->$function();
        }
    }
    
    /**
     * url加密
     * @param string $s
     * @return string
     */
    static function set_url($s=''){
        if(ENCORD_URL==1){
            if(empty($s)){
                $s='/index_index';
            }
            $s=G::authcode($s,'ENCODE');
            $s=urlencode($s);
        }
        $host=$_SERVER['HTTP_HOST'];
        $self=$_SERVER['PHP_SELF'];
        if($self=='/index.php'){
            $s="http://$host/?s=".$s;
        }else{
            $s="http://$host$self?s=".$s;
        }
        return $s;
    }
    /**
     * @return multitype:string Ambigous <string, unknown>
     */
    static function get_url(){
        $action='index';
        $function='index';
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, "index.php")) {
            $url = str_replace("index.php/", "", $url);
            @header("Location: $url ");
        }
        if (@$_REQUEST['s']) {
            $s = $_REQUEST['s'];
            //URL解密部分
            if(ENCORD_URL==1){
                $s= G::authcode($s);
                //当url解密为空时 重新抛出加密url
                if(empty($s)){
                    $ss=$_REQUEST['s'];
                    $rurls=G::set_url($ss);
                    @header("Location: $rurls");
                }
            }
            if(strstr($s,".shtml")){
                $s = str_replace(".shtml", "", $s);
            }
            $s = explode("_", $s);
            $action = str_replace("/", "", $s['0']);
            unset($s['0']);
            @$function = $s['1'];
            unset($s['1']);
            $count = count($s);
            if ($count % 2 != 0) {
                $s[$count + 2] = '';
            }
            foreach ($s as $k => $r) {
                $key = $k % 2;
                if ($key == 0) {
                    $keys = $r;
                } else 
                    if ($key == 1) {
                        $rows = $r;
                    }
                @$rurl[$keys] = $rows;
            }
            @$_GET = $rurl;
            @$_REQUEST = array_merge($_REQUEST, $rurl);
        }
            $global_url = array(
                'action' => $action,
                'function' => $function
            );
        return $global_url;
    }
   /**
    *  参数解释
    *  $string： 明文 或 密文
    *  $operation：DECODE表示解密,ENCODE其它表示加密
    *  $key： 密匙
    *  $expiry：密文有效期
    */ 
   static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
        // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
        $ckey_length = 4;
        // 密匙
        $key = md5($key ? $key : 'jason');
        // 密匙a会参与加解密
        $keya = md5(substr($key, 0, 16));
        // 密匙b会用来做数据完整性验证
        $keyb = md5(substr($key, 16, 16));
        // 密匙c用于变化生成的密文
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()),-$ckey_length)) : '';
        // 参与运算的密匙
        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);
        // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
        // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);
        $rndkey = array();
        // 产生密匙簿
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }
        // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        // 核心加解密部分
        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            // 从密匙簿得出密匙进行异或，再转成字符
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if($operation == 'DECODE') {
            // substr($result, 0, 10) == 0 验证数据有效性
            // substr($result, 0, 10) - time() > 0 验证数据有效性
            // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
            // 验证数据有效性，请看未加密明文的格式
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
            // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
            return $keyc.str_replace('=', '', base64_encode($result));
        }
    }
    /**
     * 设置global值
     * @param unknown $string
     */
    static function Set_global($key,$value) {
        $GLOBALS[$key]=$value;
    }
    /**
     * 记录系统日志
     */
    static function Write_log($text,$name=''){
        if(empty($name)){
            $location='System.log';
        }
        //记录定时任务日志
        chmod(dirname(__FILE__), 0777);
        $file = @fopen("./Log/$location", 'a+');
        if (!$file){
            mkdir ("./Log/");
            $file = fopen("./Log/$location", 'a+');
        }
        // 获取需要写入的内容
        $text .= "\r\n";
        fwrite($file,$text );
        fclose($file);
        // 销毁文件资源句柄变量
        unset($file);
    }
    /**
     * 设置语言
     */
    static function Set_lang($l=''){
        $file=$_SESSION['lang'];
        require 'Lang/'.'lang_'.$file.'.php';
        @$lang=$lang[$l];
        return $lang;
    }
}
?>
