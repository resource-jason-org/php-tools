<?PHP
/**
* SplFixedArray
*/
$array = new SplFixedArray(5);
$array[0]=0;
print_r($array);
//ͨ�������SplFixedArrayҪ��php array����20%~30%������������Ǵ����޴������Ĺ̶��������飬����ǿ�ҽ���ʹ�á�



//////////////////
/**
* ������������session
*/
//////////////////
////////////////////
//ʹ��session_set_cookie_params()������
session_set_cookie_params(0, $path,'abc.com');
//2. ʹ��ini_set���޸�php.ini���޸�session.cookie_domain��ֵ��
ini_set('session.cookie_domain','abc.com')
//////////δ����////////////



//////////////////
/**
* ������������session
*/
//////////////////


/////////////array_reduce///////////
$arr = array('1','2','3'); //�������������ֵĺ�
$sum = 0;
foreach($arr as $v){  //ʹ�� foreachѭ������
    $sum  += $v;// echo $sum
}
// echo array_reduce($arr , function($result , $v){ //ʹ��array_reduce()�������
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

array_map('intval' , $arr);//��ƴ��sql��ѯ��ʱ�򣬺�����

array_map('htmlspecialchars' , $arr);


//�����ļ�
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

   //��ȡ�ͻ���ip
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
	
	

	
	
	//������� ��ע��
function requstCheck($post) { 
    if (!get_magic_quotes_gpc()) { // �ж�magic_quotes_gpc�Ƿ�Ϊ�� 
    $post = addslashes($post); // ����magic_quotes_gpcû�д򿪵�������ύ���ݵĹ��� 
    } 
    $post = str_replace("_", "\_", $post); // �� '_'���˵� 
    $post = str_replace("%", "\%", $post); // �� '%'���˵� 
    $post = nl2br($post); // �س�ת�� 
    $post = htmlspecialchars($post); // html���ת�� 
    if(!eregi ('select|inert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|UNION|into|load_file|outfile', $post ))
    return $post; 
} 