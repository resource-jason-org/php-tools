<?PHP
/**
* SplFixedArray
*/
$array = new SplFixedArray(5);
$array[0]=0;
print_r($array);
//通常情况下SplFixedArray要比php array快上20%~30%，所以如果你是处理巨大数量的固定长度数组，还是强烈建议使用。



//////////////////
/**
* 二级域名共享session
*/
//////////////////
////////////////////
//使用session_set_cookie_params()方法：
session_set_cookie_params(0, $path,'abc.com');
//2. 使用ini_set或修改php.ini，修改session.cookie_domain的值：
ini_set('session.cookie_domain','abc.com')
//////////未测试////////////



//////////////////
/**
* 二级域名共享session
*/
//////////////////


/////////////array_reduce///////////
$arr = array('1','2','3'); //计算数组中数字的和
$sum = 0;
foreach($arr as $v){  //使用 foreach循环计算
    $sum  += $v;// echo $sum
}
// echo array_reduce($arr , function($result , $v){ //使用array_reduce()迭代求和
//     Return $result+$v;
// });
    $arr = array(
        array("id"=>1,'name'=>"a"),
        array("id"=>2,"name"=>"c"),
        array("id"=>3,"name"=>"d")
    );
   echo  array_reduce($arr , function($result , $v){
       $z=$v['id']+1; 
        Return $result.$z;
    });

/////////////array_map//////////
$arr = array('2','3','4','5');

array_map('intval' , $arr);//在拼接sql查询的时候，很有用

array_map('htmlspecialchars' , $arr);


//下载文件
   function downfile($filename){
        header( "Content-type:   application/octet-stream ");
        header( "Accept-Ranges:   bytes ");
        header( "Content-Disposition:   attachment;   filename=$filename");
        header( "Expires:   0 ");
        header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ");
        header( "Pragma:   public ");
        echo  file_get_contents($filename);
       readfile($filename);
   }

   //获取客户端ip
   	function get_client_ip() {
		if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
			$ip = getenv ( "HTTP_CLIENT_IP" );
		else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
			$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
		else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
			$ip = getenv ( "REMOTE_ADDR" );
		else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
			$ip = $_SERVER ['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return ($ip);
	}
	
	

	
	
	//输入过滤 防注入
function requstCheck($post) { 
    if (!get_magic_quotes_gpc()) { // 判断magic_quotes_gpc是否为打开 
    $post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤 
    } 
    $post = str_replace("_", "\_", $post); // 把 '_'过滤掉 
    $post = str_replace("%", "\%", $post); // 把 '%'过滤掉 
    $post = nl2br($post); // 回车转换 
    $post = htmlspecialchars($post); // html标记转换 
    if(!eregi ('select|inert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|UNION|into|load_file|outfile', $post ))
    return $post; 
} 
