<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("game", $con);
mysql_query('set names utf8');
/*by www.phpddt.com*/
header("Content-Type:text/html;charset=utf-8");
// // $dir = dirname(__FILE__);
// // echo $dir;
$sql="select * FROM rfcorp_lhjgame where cid=1";
$rr=mysql_query($sql);
while($select=mysql_fetch_array($rr)){
    $path=$select['imgpath'];
    $zhengze = '/nyxslots\/(.*?).jpg$/';
    preg_match($zhengze,$path,$result);
    @$jpg=$result[1];
   // echo $jpg;
    $ID = $select['id'];
//     echo   $update="UPDATE `rfcorp_lhjgame` SET `imgpath`='Public/24k88new/images/LHJ/nyxslots/$jpg.jpg' WHERE (`id`='$ID');";
     //echo "<br/>";
$dir="D:\zend\DDF-DELIVERY250\\trunk\Public\\24k88new\images\LHJ\\nyxslots";//这里输入其它路径
$array=FindFile($dir);
foreach($array as $key=>$row){
    $testZZ="/.png$/";
   if(preg_match($testZZ,$row)){
      // echo $row;
        $row=str_replace(".png", "", $row);
       if($jpg==$row){
           //echo "wocao?";
           echo   $update="UPDATE `rfcorp_lhjgame` SET `imgpath`='Public/24k88new/images/LHJ/nyxslots/$jpg.png' WHERE (`id`='$ID');";
           echo "<br/>";
       }
   }
}
}
function FindFile($dir)
{
    $files = array();
    if($handle = opendir($dir))   //打开目录
    {
        while(($file = readdir($handle)) !== false)  //读取文件名
        {
            if($file !="." && $file !="..")    //排除上级目录 和当前目录
            {
                if(is_dir($dir."\\".$file))    //如果还是文件夹  继续遍历
                {
                    $files[$file] = scandir($dir . "/" . $file);
                }else {
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        return $files;
    }
}
?>