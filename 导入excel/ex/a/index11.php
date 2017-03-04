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
require_once 'excel_reader2.php';
//创建对象
$data = new Spreadsheet_Excel_Reader();
//设置文本输出编码
$data->setOutputEncoding('UTF-8');
//读取Excel文件
$r=$data->read("aa.xls");
//$data->sheets[0]['numRows']为Excel行数
$array=$data->sheets;
$array_cells=$array['0']['cells'];
unset($array_cells['1']);
$i=0;
$i=1;


foreach($array_cells as $row){
       @$gameId=trim($row[1]); 
       @$gameJp=trim($row[4]);
       @$gameJp=str_replace("'", "`", $gameJp);
	   $sql="UPDATE `rfcorp_lhjgame` SET `jp_title`='$gameJp' WHERE (`id`='$gameId');";
	   echo $sql;
	   echo "<br/>";
	   

    }
   
?>