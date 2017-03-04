 <?php
define('CHARSET', 'utf-8');

class sendmail
{
    /**
     * 发送邮件
     * 
     */
    public function sendmail($toemail, $subject, $message, $from = '')
    {
        $data = array(
            'mailsend' => '2',
            'maildelimiter' => '1',
            'auth' => '1',
            'sitename' => 'VeryTalk Inc.',
            'siteurl' => 'http://www.verytalk.cn/',
            'adminemail' => 'verytalk@qq.com',
            'version' => 'Jason',
            'timeoffset' => '8',
            'server' => 'smtp.qq.com',
            'port' => '25',
            'from' => 'verytalk@qq.com',
            'auth_username' => '770309967',
            'auth_password' => 'songJIAN19920614'
        );
        
        $message = preg_replace("/href\=\"(?!(http|https)\:\/\/)(.+?)\"/i", 'href="' . $data['siteurl'] . '\\2"', $message);
        $message = <<<EOT
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>$subject</title>
</head>
<body>
$subject<br />
$message
</body>
</html>
EOT;
        
        $maildelimiter = $data['maildelimiter'] == 1 ? "\r\n" : ($data['maildelimiter'] == 2 ? "\r" : "\n");
        
        $mailusername = isset($data['mailusername']) ? $data['mailusername'] : 1;
        $data['port'] = $data['port'] ? $data['port'] : 25;
        $data['mailsend'] = $data['mailsend'] ? $data['mailsend'] : 1;
        
        if ($data['mailsend'] == 3) {
            $email_from = empty($from) ? $data['adminemail'] : $from;
        } else {
            $email_from = $from == '' ? '=?' . CHARSET . '?B?' . base64_encode($data['sitename']) . "?= <" . $data['adminemail'] . ">" : (preg_match('/^(.+?) \<(.+?)\>$/', $from, $mats) ? '=?' . CHARSET . '?B?' . base64_encode($mats[1]) . "?= <$mats[2]>" : $from);
        }
        
        $email_to = preg_match('/^(.+?) \<(.+?)\>$/', $toemail, $mats) ? ($mailusername ? '=?' . CHARSET . '?B?' . base64_encode($mats[1]) . "?= <$mats[2]>" : $mats[2]) : $toemail;
        
        $email_subject = '=?' . CHARSET . '?B?' . base64_encode(preg_replace("/[\r|\n]/", '', '[' . $data['sitename'] . '] ' . $subject)) . '?=';
        
        $email_message = chunk_split(base64_encode(str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $message))))));
        $host = $_SERVER['HTTP_HOST'];
        $version = $data['version'];
        $headers = "From: $email_from{$maildelimiter}X-Priority: 3{$maildelimiter}X-Mailer: $host $version {$maildelimiter}MIME-Version: 1.0{$maildelimiter}Content-type: text/html; charset=" . CHARSET . "{$maildelimiter}Content-Transfer-Encoding: base64{$maildelimiter}";
        
        if ($data['mailsend'] == 1) {
            if (function_exists('mail') && @mail($email_to, $email_subject, $email_message, $headers)) {
                return true;
            }
            return false;
        } elseif ($data['mailsend'] == 2) {
            if (! $fp = $this->fsocketopen($data['server'], $data['port'], $errno, $errstr, 30)) {
                runlog('SMTP', "({$data[server]}:{$data[port]}) CONNECT - Unable to connect to the SMTP server", 0);
                return false;
            }
            stream_set_blocking($fp, true);
            
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != '220') {
                runlog('SMTP', "{$data[server]}:{$data[port]} CONNECT - $lastmessage", 0);
                return false;
            }
            
            fputs($fp, ($data['auth'] ? 'EHLO' : 'HELO') . " uchome\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250) {
                runlog('SMTP', "({$data[server]}:{$data[port]}) HELO/EHLO - $lastmessage", 0);
                return false;
            }
            
            while (1) {
                if (substr($lastmessage, 3, 1) != '-' || empty($lastmessage)) {
                    break;
                }
                $lastmessage = fgets($fp, 512);
            }
            
            if ($data['auth']) {
                fputs($fp, "AUTH LOGIN\r\n");
                $lastmessage = fgets($fp, 512);
                if (substr($lastmessage, 0, 3) != 334) {
                    runlog('SMTP', "({$data[server]}:{$data[port]}) AUTH LOGIN - $lastmessage", 0);
                    return false;
                }
                
                fputs($fp, base64_encode($data['auth_username']) . "\r\n");
                $lastmessage = fgets($fp, 512);
                if (substr($lastmessage, 0, 3) != 334) {
                    runlog('SMTP', "({$data[server]}:{$data[port]}) USERNAME - $lastmessage", 0);
                    return false;
                }
                
                fputs($fp, base64_encode($data['auth_password']) . "\r\n");
                $lastmessage = fgets($fp, 512);
                if (substr($lastmessage, 0, 3) != 235) {
                    runlog('SMTP', "({$data[server]}:{$data[port]}) PASSWORD - $lastmessage", 0);
                    return false;
                }
                
                $email_from = $data['from'];
            }
            
            fputs($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from) . ">\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 250) {
                fputs($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from) . ">\r\n");
                $lastmessage = fgets($fp, 512);
                if (substr($lastmessage, 0, 3) != 250) {
                    runlog('SMTP', "({$data[server]}:{$data[port]}) MAIL FROM - $lastmessage", 0);
                    return false;
                }
            }
            
            fputs($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $toemail) . ">\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 250) {
                fputs($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $toemail) . ">\r\n");
                $lastmessage = fgets($fp, 512);
                // runlog('SMTP', "({$data[server]}:{$data[port]}) RCPT TO - $lastmessage", 0);
                return false;
            }
            
            fputs($fp, "DATA\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 354) {
                runlog('SMTP', "({$data[server]}:{$data[port]}) DATA - $lastmessage", 0);
                return false;
            }
            
            $timeoffset = $data['timeoffset'];
            if (function_exists('date_default_timezone_set')) {
                @date_default_timezone_set('Etc/GMT' . ($timeoffset > 0 ? '-' : '+') . (abs($timeoffset)));
            }
            
            $headers .= 'Message-ID: <' . date('YmdHs') . '.' . substr(md5($email_message . microtime()), 0, 6) . rand(100000, 999999) . '@' . $_SERVER['HTTP_HOST'] . ">{$maildelimiter}";
            fputs($fp, "Date: " . date('r') . "\r\n");
            fputs($fp, "To: " . $email_to . "\r\n");
            fputs($fp, "Subject: " . $email_subject . "\r\n");
            fputs($fp, $headers . "\r\n");
            fputs($fp, "\r\n\r\n");
            fputs($fp, "$email_message\r\n.\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 250) {
                runlog('SMTP', "({$data[server]}:{$data[port]}) END - $lastmessage", 0);
            }
            fputs($fp, "QUIT\r\n");
            
            return true;
        } elseif ($data['mailsend'] == 3) {
            ini_set('SMTP', $data['server']);
            ini_set('smtp_port', $data['port']);
            ini_set('sendmail_from', $email_from);
            
            if (function_exists('mail') && @mail($email_to, $email_subject, $email_message, $headers)) {
                
                return true;
            }
            return false;
        }
    }

    protected function fsocketopen($hostname, $port = 80, &$errno, &$errstr, $timeout = 15)
    {
        $fp = '';
        if (function_exists('fsockopen')) {
            $fp = @fsockopen($hostname, $port, $errno, $errstr, $timeout);
        } elseif (function_exists('pfsockopen')) {
            $fp = @pfsockopen($hostname, $port, $errno, $errstr, $timeout);
        } elseif (function_exists('stream_socket_client')) {
            $fp = @stream_socket_client($hostname . ':' . $port, $errno, $errstr, $timeout);
        }
        return $fp;
    }
}
// 调用
// $send=new sendmail('869999860@qq.com', '测试邮件', 'cesh');
?>