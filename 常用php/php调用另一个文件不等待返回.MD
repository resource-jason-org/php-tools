PHP exec() 运行另一个php文件，不等待返回值 
最近经常有人问“在一个php文件中怎样运行另一个php文件而不等待它返回继续执行”。简单举个例子：有一个1.php文件是用户访问的页面，然后1.php中需要有一段代码处理大量邮件，于是将处理邮件的代码转移到2.php中，在1.php通过某种方式运行2.php之后，马上提示用户“邮件已发送，请稍后查收”。

其实邮件并未发送，只是在2.php中继续执行。

方案1

1.php通过http head请求2.php，不等待2.php返回全部内容就结束连接，而2.php一旦被请求所有的代码都会被执行。可以这样说，1.php通过curl发起了一个socket连接后，然后得到响应值立刻断开连接。

1.php的代码如下：


<?php
//记录当前时刻
file_put_contents('test.txt', __FILE__ .' write at '.date('Y-m-d H:i:s').PHP_EOL);
echo 'time:'.date('Y-m-d H:i:s');
$url = 'http://你的服务器IP地址/2.php';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');              // 发送head请求
$result = curl_exec($ch);
echo '<br/>';
echo 'time:'.date('Y-m-d H:i:s');
2.php的代码如下：


<?php
ob_start();
//这里一定要输出内容给1.php,虽然什么都行,没有内容会失灵的
echo '{"code":0, "msg":"success"}';
$size = ob_get_length();
header("Content-Length: $size");
header("Connection: Close");
//使用ob输出缓冲区,提前告诉浏览器脚本运行结束,不同的操作系统用的函数不一样，都写上最好
ob_end_flush();
ob_flush();
flush();
//请求相应已经完成了，后面可以写耗时代码了
sleep(3);
//休眠3秒后追加内容到文件
file_put_contents(__DIR__ .'/test.txt',  __FILE__ .' write at '.date('Y-m-d H:i:s').PHP_EOL, FILE_APPEND);
注意：该方法暂时不支持windows操作系统。



方案2

1.php中使用popen和pclose实现：


<?php
//windows下为php.exe所在目录;例如C:/xampp/php/bin/php
//linux为/usr/local/php/bin/php
$php_path = '/usr/local/php/bin/php';
//后台运行必须使用文件的绝对路径
$php2 = __DIR__ .'/2.php';
$cmd = $php_path.' '.$php2;
//windows和linux下后台执行方式
if(strtoupper(substr(PHP_OS,0,3)) == 'WIN')
{
    pclose(popen('start /B '.$cmd, 'r'));
}else
{
    pclose(popen($cmd.' > /dev/null &', 'r'));
}
  
file_put_contents('test.txt', __FILE__ .' write at '.date('Y-m-d H:i:s').PHP_EOL);
2.php直接写就OK了。

<?php
//休眠10秒后追加内容到文件
sleep(10);
file_put_contents(__DIR__ .'/test.txt',  __FILE__ .' write at '.date('Y-m-d H:i:s').PHP_EOL, FILE_APPEND);
这里以linux平台测试，将1.php和2.php上传到/root目录：

cd /root
touch test.txt
chmod 777 test.txt
php 1.php
cat test.txt
反复cat test.txt文件，发现稍后2.php写入了新的内容。



这两种方法看起来效果是一样的，实际上第一种方法只适合于处理小型后台任务，相当于将2.php的执行任务交给nginx或apache的进程，有很多不确定的因素。

而第二种方法是将2.php的执行任务交给系统进程，一定会执行。但是使用了2个比较危险的函数，在实际使用过程中不一定函数可用。

所以，一般使用linux做服务端的推荐使用第一种方案。