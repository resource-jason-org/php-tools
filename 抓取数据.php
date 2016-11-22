<?php
$url = 'http://www.shishicai.cn/cqssc/';  //这儿填页面地址
$code='';
set_time_limit(0);
$i=1;
    while ($i<100){
        $info=file_get_contents($url);
        preg_match_all('/<td class="borB">(.*?)<\/td>/si',$info,$m);
        $info=$m[1][0];
        $info .= "\n";
        if($code !=$info){
            echo "==============\n";
            flush();
            echo $info;
            flush();
            chmod(dirname(__FILE__), 0777);
            $file = @fopen('./LHJtasklog/code.txt', 'a+');
            if (! $file) {
                mkdir("./LHJtasklog/");
                $file = fopen('./LHJtasklog/code.txt', 'a+');
            }
            // 获取需要写入的内容
           // $info .= "\r \n";
            fwrite($file, $info);
            fclose($file);
            unset($file);
            // 销毁文件资源句柄变量
            $code=$info;
       }
    sleep(20);
    $i++;
    }
?>