<?php
header('Content-Type: text/html; charset=UTF-8');
$switch=1;

if($switch==1){
$file = "1.jpg";
$type = getimagesize($file);
$fp = fopen($file,"r") or die("Can't open file");
echo $file_content = urlencode(base64_encode(fread($fp,filesize($file))));

fclose($fp);

}else{
$code=@base64_decode(urldecode(trim($_REQUEST['code'])));
  //    file_put_contents('1.jpg', $aa);
if($code){
   downfile('1.jpg',$code);
 }
}

function downfile($filename,$code){
    header( "Content-type:   application/octet-stream ");
    header( "Accept-Ranges:   bytes ");
    header( "Content-Disposition:   attachment;   filename=$filename");
    header( "Expires:   0 ");
    header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ");
    header( "Pragma:   public ");
    echo  $code;
}
?> 
<?php if( $switch !=1 ){ ?>
<form action='' method='post'>
<textarea name='code'>
</textarea>
 <input type='submit' value='确定'/>
 </form>
<?php } ?>
