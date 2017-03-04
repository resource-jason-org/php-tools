第一步： 加载三个RSA的js库文件，可以到这里下载 http://www.ohdave.com/rsa/。

第二步： 获取秘钥

 要生成获得证书所需的密钥等文件
	1 openssl genrsa -des3 -out server.pem 1024
	2 openssl req -new -key server.pem -out server.csr
	3 openssl rsa -in server.pem -out server.pem
	
	使用上面的命令就会创建一个证书申请，这里我们会要求输入国家、组织、姓名等信息，但是不会要求输入证书有效天数，
	因为证书有效天数是CA认证中心给我们的；然后我们会把这个生成好的cert.csr（Certificate Signing Request (CSR)：证书签名申请）
	发给CA认证中心。CA认证中心通过后，会反馈（通常是邮件）回来认证的信息，再导入即可。

	  把上面生成的文件内容提交给CA，即可换取证书；若自行生成则:
	  
	  openssl x509 -req -days 365 -in server.csr -signkey server.pem -out server.crt
 

     获取十六进制的密钥
	 
	 数据是用ASN.1编码过的，所以可以用openssl命令从密钥文件（key或pem）提取秘钥
	 
	 1 openssl asn1parse -out temp.ans -i -inform PEM < server.pem >server.pem16.log
	 
	 详见（图1）

	




	
	 =====================================================================================================================
	 4. javascript 加密代码
function rsa_pwd(content){

//十六进制公钥 
var rsa_n = "BC6539FEAD9E086D02E1268FF36E46A2843797559D15BE09....";

setMaxDigits(131);

 //131 => n的十六进制位数/2+3 

var key = new RSAKeyPair("10001", '', rsa_n); //10001 => e的十六进制 

content_rsa = encryptedString(key, content);

//不支持汉字 

return content_rsa;

 }
 5. php 加密/解密代码

<?php

/** * 公钥加密

 * * @param string 明文

 * @param string 证书文件（.crt）

 * @return string 密文（base64编码）

 */

function publickey_encodeing($sourcestr, $fileName) {

      $key_content = file_get_contents($fileName);

      $pubkeyid = openssl_get_publickey($key_content);

      if (openssl_public_encrypt($sourcestr, $crypttext, $pubkeyid)) {

            return base64_encode("".$crypttext);

       }

}

/** * 私钥解密

* * @param string 密文（二进制格式且base64编码）

* @param string 密钥文件（.pem / .key）

* @param string 密文是否来源于JS的RSA加密

* @return string 明文
*/

function privatekey_decodeing($crypttext, $fileName, $fromjs = FALSE) {

          $key_content = file_get_contents($fileName);

          $prikeyid = openssl_get_privatekey($key_content);

          $crypttext = base64_decode($crypttext);

          $padding = $fromjs ? OPENSSL_NO_PADDING : OPENSSL_PKCS1_PADDING;

          if (openssl_private_decrypt($crypttext, $sourcestr, $prikeyid, $padding)) {

                     return $fromjs ? rtrim(strrev($sourcestr)) : "".$sourcestr;

           }

           return '';

}

 ?>
6. 测试代码

//JS->PHP 测试 $_POST['password']是js加密后的信息

$txt_en = $_POST['password'];

$txt_en = base64_encode(pack("H*", $txt_en));

$file = 'ssl/server.pem';

$txt_de = privatekey_decodeing($txt_en, $file, TRUE);

var_dump($txt_de);

//PHP->PHP 测试  $data = "汉字:1a2b3c";

$config = Core::getInstance()->config;

$file1 = 'ssl/server.crt';

$file2 = 'ssl/server.pem';

$a = publickey_encodeing($data, $file1);

$b = privatekey_decodeing($a, $file2);

var_dump($b);
7. 需注意
PHP中openssl扩展公私钥加密函数只支持小数据，加密时117字节，解密时128字节。若不然得自己循环加密后合并。

SSL本身也只是用RSA来进行密钥加密，数据加密则是利用这个加密的密钥进行对称加密，以保证速度。所以万不可将其用于大数据量加密！

8. 本方案几处优点
1、安全性高。基于非对称的RSA算法加密数据，只要在私钥不被暴露的前提下，密钥长度足够长，短时间内基本是无法破解的。

2、使用方便。前端使用现成的JS库来实现加密，PHP端则可直接使用现成的openssl扩展，而不用RSA的PHP源码实现或自己开发扩展。

3、速度靠谱。由于RSA解密算法相当复杂，而该操作交由PHP端扩展来实现，效率上比网上的PHP代码要高许多。

4、便于升级。密钥是直接从linux下openssl工具生成的证书中获取，不仅不用其他密钥生成工具，也方便今后升级到真正的HTTPS。