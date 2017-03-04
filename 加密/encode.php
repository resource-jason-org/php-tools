<?php
/****************************************************************************************************************
 *myEncode，此类用于对php代码进行加密（只针对纯php代码）
 *使用方法：1、可视化界面操作（直接输入脚本名称即可，例如：http://www.xxx.com/encode.php）
 *		  2、可在url上面给出具体参数直接执行（该方法可嵌入安装程序中对程序进行保护）
 *			 例如：http://www.xxx.com/encode.php?codePath=XXX&lockIpXXX&lockDate=XXX&mdb=XXX&delMyself=XXX
 *			 codePath:加密路径 this当前目录，all所有目录
 *			 lockIp	 :加密ip，多个ip用逗号隔开
 *			 lockDate：软件使用截止日期
 *			 mdb	 ：加密口令，任意10个以内字符
 *			 delMyself：为yes则在脚本执行结束后删除该脚本
 *OYOencode 1.0 
 *author   ：落叶随风
 *QQ number：274944659
 *QQ Group ：127394775
 *加密算法可根据你的需要自行修改，不足之处请多多指教
 *解密方法   解密方法 echo $OOOOOOO0(strrev($OOOOO0OO));
****************************************************************************************************************/

header("Content-type: text/html; charset=utf-8");
session_start();
date_default_timezone_set("PRC");
error_reporting(0);
$funcStrings='';
class myEncode{
	public $path;
	public $myName;
	public $lockIp;//锁定ip,可以多个
	public $lockDate;//锁定日期;
	public $keyMdb;	//密匙
	public $keyFile;//密匙路径
 	public function __construct(){
	    $this->path=dirname(__FILE__);
		$this->myName=basename(__FILE__);
		$this->lockIp =geti('lockIp');
		$this->lockDate=geti('lockDate');
		$this->keyMdb=md5(geti('keyMdb'));
		$this->keyFile=$_SERVER['SystemRoot'].'/'.$this->keyMdb.'.dll';
		$this->lockFunc();
  		if(isset($_SESSION['encode'])){
			if(count($_SESSION['encode'])>0){
				echo "<pre>";
				  echo "<pre>";
  				  echo '已加密'.$_SESSION['encoded'].'个文件！';
				 print_r(array_reverse($_SESSION['over']));
				 $this->encode();	
				echo "<script>window.location.reload();</script>";
			}elseif(count($_SESSION['encode'])==0){
				  echo "<pre>";
  				  echo '加密完成,共'.count($_SESSION['over']).'个文件，加密'.$_SESSION['encoded'].'个文件！';	
				  print_r(array_reverse($_SESSION['over']));
				  session_unset();
				  if(geti('delMyself')=='yes'){
					unlink(__FILE__);  
				  }
			}
		}else{
			session_unset();
 			#创建锁文件
// 			if(!isset($_SESSION['encode']) ){
// 				file_put_contents($this->keyFile,$this->keyMdb,LOCK_EX);
// 			}
			
			$this->getPath($this->path,geti('codePath'));	
 			$_SESSION['over']=array();
			$_SESSION['encoded']=0;
			echo "<script>window.location.reload();</script>";
		}
	}
	public function getPath($path,$lei=''){
		if(!is_dir($path))return;
		$openPath=opendir($path);
  		while($file=readdir($openPath)){
			if($file=='.' || $file=='..'){
	 			continue 1;
			}elseif(is_dir($path.'/'.$file) && $lei=='all'){
				$apath=$path.'/'.$file;
  				$this->getPath($apath,$lei);	
			}else{
				 $suffix=explode('.',$file);
				 $suffix=strtolower($suffix[count($suffix)-1]);
				 if($suffix=='php' && $file!=$this->myName){
					$_SESSION['encode'][]=$path.'/'.$file;
				 }
			}
		}
 	}
	public function encode(){
		$handle=each($_SESSION['encode']);
		unset($_SESSION['encode'][$handle['key']]);
		$fileName=$handle['value'];
		$phpContent=file_get_contents($fileName);
		if(trim($phpContent)=='')return;
		$isCanEncode=preg_match('/^<\?php\s+(.*)\s+\?>$/is',trim($phpContent));	
		if($isCanEncode){
			$encodeContent=preg_replace_callback('/^<\?php\s+(.*)\s+\?>$/is','enCodes',trim($phpContent));
			$fo=0;//file_put_contents($fileName,$encodeContent);
			if($fo){
				$_SESSION['over'][]=$fileName.'&nbsp;加密成功！';
				$_SESSION['encoded']++;
			}
		}else{
				$_SESSION['over'][]=$fileName.'&nbsp;不用加密！';
		}
	}	
	public function lockFunc(){
		$lockDate=strtotime($this->lockDate);
		$lockStr ='if(!isset($oyo_locking)){'."\r\n";
// 		$lockStr.='if(time()>'.$lockDate.'){'."\r\n";
// 		$lockStr.='die("<a style=\"color:red;font-size:14px\">错误：系统已过期，请升级</a>");'."\r\n";	
// 		$lockStr.='}'."\r\n";
// 		$lockStr.='$requsetIp=$_SERVER["SERVER_NAME"];'."\r\n";
// 		$lockStr.='$lockIp=explode(",","'.$this->lockIp.'");'."\r\n";
// 		$lockStr.='if(!in_array($requsetIp,$lockIp)){'."\r\n";
// 		$lockStr.='die("<a style=\"color:red;font-size:14px\">错误：该主机未注册</a>");	'."\r\n";
// 		$lockStr.='}'."\r\n";
		
// 		$lockStr.='if(!file_exists("'.$this->keyFile.'")){'."\r\n";
// 		$lockStr.='die("<a style=\"color:red;font-size:14px\">错误：系统核心文件丢失</a>");	'."\r\n";
// 		$lockStr.='}else{'."\r\n";
// 		$lockStr.='$key=file_get_contents("'.$this->keyFile.'");'."\r\n";
// 		$lockStr.='$key=trim($key);'."\r\n";
// 		$lockStr.='if($key!="'.$this->keyMdb.'"){'."\r\n";
// 		$lockStr.='die("<a style=\"color:red;font-size:14px\">错误：密匙破坏</a>");'."\r\n";
// 		$lockStr.='}'."\r\n";
// 		$lockStr.='}'."\r\n";
		
		$lockStr.='$oyo_locking="passed";'."\r\n";
		$lockStr.='}'."\r\n";
		$lockStr.='eval($OOOOOOO0(strrev($OOOOO0OO)));'."\r\n";
		return $GLOBALS['funcStrings']=$lockStr;	
	}
}
/********************************************************************************************/
 function geti($get){
		if(isset($_GET[$get])){
			return $_GET[$get]	;
		}	
		return false;
	}
  
/********************************************************************************************/
function enCodes($me){
	static $isFirst=0;
 	if($isFirst==0){
 		$codeF=base64_encode($GLOBALS['funcStrings']);
	}else{
		$codeF='';
 	}
 	$isFirst++;
	$code=$me[1];
	
	echo $code;
 	$encodes=base64_encode($code);
	$encodes=strrev($encodes);
	$return='<?php'."\r\n";  
	$return.='/**'."\r\n";
	$return.='*Jason Group  '."\r\n";
	$return.='*author：Jason'."\r\n";
	$return.='*QQ number：869999860'."\r\n";
	$return.='*createTime:'.date('Y-m-d H:i:s')."\r\n";
	$return.='*/'."\r\n";
	$return.='$OOOOOOO0="\x62\x61\x73\x65\x36\x34\x5F\x64\x65\x63\x6F\x64\x65";';
	$return.='$OOOOO0OO="'.$encodes.'";';
	$return.='eval($OOOOOOO0("'.$codeF.'"));'."\r\n";
	$return.='?>';
	
	return $return;
}
if(isset($_GET['codePath'])){
	$myEncode=new myEncode();
	exit;
} 
session_unset();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>php加密</title>
</head>
<style>
body{font: 15px 'Microsoft YaHei','宋体',STHeiti,Verdana,Arial,Helvetica,sans-serif;color:#333}
.abut{border:0px;background:#004080;color:#FFF;width:100px;height:30px; border-radius:3px;cursor:pointer}
.abut:hover{background:#000037}
.atit{font-size:17px;font-weight:bold;height:50px; padding-left:50px}
.atit_0{color:#F60}
.atit_1{font-size:13px;color:#CCC;font-weight:normal}
.agreen{color:green;}
.mainTab{width:800px;height:300px; border:#CCC 1px solid; border-top:#004080 3px solid; position:absolute;left:50%;top:50%; margin-left:-400px; margin-top:-200px;}
</style>
<body>
<form method="get" action="" onsubmit="return confirm('确定开始加密吗？')">
	<table class="mainTab">
   		 <tr>
        	<td colspan="3" align="left" class="atit">
            	&nbsp;&nbsp;PHP代码加密器<a class="atit_0"> OYOencoder1.0</a>&nbsp;&nbsp; <a class="atit_1">Copyright by haigo.com</a>
            </td>
        </tr>
    	<tr>
        	<td width="130" align="right">加密目录：</td>
            <td width="200" >
            	 <select name="codePath">
                    <option value="this">当前目录</option>
                    <option value="all">当前目录和子目录</option>
                </select>
            </td>
            <td>设置加密的目录</td>
        </tr>
        <tr>
        	<td align="right">  锁定ip/域名：</td>
            <td> <input type="text" name="lockIp"  value="<?=$_SERVER['SERVER_NAME']?>"/></td>
            <td>多个用‘，’隔开,例如<a class="agreen"> 192.168.1.1,223.21.2.172</a></td>
        </tr>
        <tr>
        	<td align="right">限制日期：</td>
            <td> <input type="text" name="lockDate"  value="<?=(date("Y")+1).date('-m-d')?>" /></td>
            <td>设置使用期限</td>
        </tr>
        <tr>
        	<td align="right">加密口令：</td>
            <td><input type="text" name="mdb"  value="abcdefasgs" maxlength="10" /></td>
            <td>根据你的需要自行输入(最多10位)</td>
        </tr>
        <tr>
        	<td align="right"></td>
            <td colspan="2">
            	<input type="checkbox" name="delMyself"  value="yes"   /> 
            	加密完成后同时删除此加密脚本&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" class="abut" value="开始加密" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>
