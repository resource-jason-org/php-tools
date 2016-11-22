<?php


function GETBySocket($URL, $port=80) {
    //get host from url
    preg_match('/\/\/.*\//sU',$URL,$host_array);
    if(!$host_array[0]) {
        $URL.='/';
        preg_match('/\/\/.*\//sU',$URL,$host_array);
    }
    $host=substr($host_array[0],2,-1);
    //connect
    $fp = stream_socket_client("$host:$port", $errcode, $errstr, 1);// or die("get ". $host ." failed");
    //
    $header = "GET ". $URL. " HTTP/1.1\r\n";
    $header .= "Accept: */*\r\n";
    $header .= "Accept-Language: zh-cn\r\n";
    //$header .= "HTTP_CONNECTION: Keep-Alive\r\n";
    $header .= "HTTP_ACCEPT: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";
    $header .= "HTTP_ACCEPT_CHARSET: gbk,*,utf-8\r\n";
    //$header .= "Accept-Encoding: gzip, deflate\r\n";
    $header .= "User-Agent: Mozilla/4.0(compatible; MSIE 6.0; Windows NT 5.1;)\r\n";
    $header .= "Host: ". $host ."\r\n";
    //$header .= "Connection: Keep-Alive\r\n";
    //$header .= "Cookie: cnzz02=2; rtime=1; ltime=1148456424859; cnzz_eid=56601755-\r\n\r\n";
    $header .= "Connection: close\r\n\r\n";
    stream_socket_sendto($fp, $header);
    ///////////////////$content=stream_socket_recvfrom($fp,1000,STREAM_PEEK);
    $content=stream_get_contents($fp);
    fclose($fp);
    $position_header=strpos($content, "\r\n\r\n");
    if (stripos(substr($content, 0 ,$position_header), 'Transfer-Encoding: chunked')) {
        return substr($content, strpos($content, "\r\n", $position_header +4)+2);
    } else {
        return substr($content, $position_header +4);
    }

}
echo GETBySocket('http://www.qq.com/');