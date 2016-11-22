<?php

//特殊字符

  if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<{}]|\]|\[|\/|\\\|\"|\|/",$nickname)){
        message ( 'errorBack', '注册失败,昵称含有特殊字符');
    }

//中文
    if(!eregi("[^\x80-\xff]","$username")){
        message ( 'errorBack', '注册失败,昵称含有中文');
    }
    if(preg_match("/[\x7f-\xff]/", $username)){
        message ( 'errorBack', '注册失败,昵称含有中文');
    }
	
//IP	
	
	$origin_ip   = trim(preg_replace('/^((\d{1,3}\.){3})(.*)/','$1',$testip),' .');
	
//URL
function is_url($str){ 
//检验网址 
return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $str); 
} 

//邮编

function is_zip($str){ 
//检验邮编 
return preg_match("/^[1-9]\d{5}$/", $str); 
} 

  //整数两位小数 或者整数加两位小数
	    if(!preg_match("/^[0-9]+(.[0-9]{1,2})?$/", $amount)){
	        message('error','存款金额填写错误！', U('MoneyIn/neteller'));
	        exit();
	    }

//邮箱
function is_email($str){ 
	return preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $str); 
} 

//六位数字

    if(!preg_match("/^\d{6}$/", $code)){
	        message('error','Secure ID填写错误！', U('MoneyIn/neteller'));
	        exit();    
     }
	
//三位字母

 if(!preg_match("/^[a-zA-Z]{3}$/", $currency)){
	        message('error','Currency 填写错误！', U('MoneyIn/neteller'));
	        exit();    
 }	
 
 //防注入
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


  /**
     * IsMail函数:检测是否为正确的邮件格式
     * 返回值:是正确的邮件格式返回邮件,不是返回false
     */
    
   private function CheckEmail($email)
    {
        global $dArr;
        $dArr = array( 
            '163.com','126.com','sina.com','yahoo.com.cn','yahoo.com','sohu.com','yeah.net','139.com',
            'tom.com','21cn.com','qq.com','foxmail.com','gmail.com','hotmail.com','263.net',
            'vip.qq.com','vip.163.com','vip.sina.com','vip.sina.com.cn','vip.foxmail.com',
        );
        if(empty($email)) return FALSE;
        list($e,$d) = explode('@', $email);
        if(!empty($e) && !empty($d))
        {
            $d = strtolower($d);
            if(!in_array($d,$dArr)) return FALSE;
            return preg_match('/^[a-z0-9]+([\+_\-\.]?[a-z0-9]+)*/i', $e);
        }
        return FALSE;
    }
    
?>