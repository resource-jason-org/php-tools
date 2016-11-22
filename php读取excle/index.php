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

foreach($array_cells as $row){
    $img=trim($row[3]);
    $name=trim($row[2]);
    $time=time();
    $sql="INSERT INTO `game`.`rfcorp_lhjgame` (
    `id`,
    `title`,
    `cid`,
    `imgpath`,
    `is_recommend`,
    `is_hot`,
    `demo_url`,
    `real_url`,
    `time`,
    `status`,
    `game_help`,
    `is_new`,
    `game_id`
    )
    VALUES
    (
    '',
    '$name',
    '3',
    'Public/24k88new/images/LHJ/mgslots/$img.png',
    '1',
    '4',
    'index.php?s=/',
    'user.php?s=/',
    '$time',
    '1',
    '/index.php?s=/News_indexdetail_item_',
    '1',
    '$img'
    );
    ";
    mysql_query($sql);
}



?>