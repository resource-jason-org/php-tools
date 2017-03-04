<?php
levenshtein();
//你有没有经历过需要知道两个单词有多大的不同的时候，这个函数就是来帮你解决这个问题的。它能比较出两个字符串的不同程度。
$str1 = "carrot";
$str2 = "carrrott";
echo levenshtein($str1, $str2); //Outputs 2

get_defined_vars()
//这是一个在debug调试时非常有用的函数。这个函数返回一个多维数组，里面包含了所有定义过的变量。
print_r(get_defined_vars());

ignore_user_abort();
//这个函数用来拒绝浏览器端用户终止执行脚本的请求。正常情况下客户端的退出会导致服务器端脚本停止运行。

highlight_string();
//当你想把PHP代码显示到页面上时，highlight_string()
//函数就会显得非常有用。这个函数会把你提供的PHP代码用内置的PHP语法突出显示定义的颜色高亮显示。
//这个函数有两个参数，第一个参数是一个字符串，表示这个字符串需要被突出显示。
//第二个参数如果设置成TRUE，这个函数就会把高亮后的代码当成返回值返回。
php_strip_whitespace();
//这个函数也跟前面的show_source()函数相似，但它会删除文件里的注释和空格符。
get_browser();
//这个函数会读取browscap.ini文件，返回浏览器兼容信息。

gzcompress(), gzuncompress()
//这两个函数用来压缩和解压字符串数据。它们的压缩率能达到50% 左右。
//另外的函数 gzencode() 和 gzdecode() 也能达到类似结果，但使用了不同的压缩算法。

register_shutdown_function()
//这个函数，能够在脚本终止前回调注册的函数,也就是当 PHP 程序执行完成后执行的函数。


  $backtrace = debug_backtrace();
	    array_shift($backtrace);
//function	字符串	当前的函数名。
//line	整数	当前的行号。
//file	字符串	当前的文件名。
//class	字符串	当前的类名
//object	对象	当前对象。


//捕获php程序异常
   set_error_handler ( array ('App', 'appError' ) );
     static public function appError($errno, $errstr, $errfile, $errline) {
    switch ($errno) {
    case E_ERROR :
      case E_USER_ERROR :
        $errorStr = "[$errno] $errstr " . basename ( $errfile ) . " 第 $errline 行.";
        if (C ( 'LOG_RECORD' ))
          Log::write ( $errorStr, Log::ERR );
        halt ( $errorStr );
        break;
      case E_STRICT :
        case E_USER_WARNING :
          case E_USER_NOTICE :
            default :
              $errorStr = "[$errno] $errstr " . basename ( $errfile ) . " 第 $errline 行.";
              Log::record ( $errorStr, Log::NOTICE );
              break;
    }
 
  //捕获异常
  set_exception_handler ( array ('App', 'appException' ) );
 
 //获取当前运行模式
    echo php_sapi_name();  
	   // 只允许在cli下面运行  
        if (php_sapi_name() != "cli"){  
            die("only run in command line mode\n");  
        }  

		
?>