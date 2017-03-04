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
$r=$data->read("mgnew.xls");
//$data->sheets[0]['numRows']为Excel行数
$array=$data->sheets;
$array_cells=$array['0']['cells'];
unset($array_cells['1']);
$i=0;
$i=1;


foreach($array_cells as $row){
//     @$game_title=trim($row[2]);
//     @$game_type=trim($row[3]);
//     @$game_reel=trim($row[4]);
//     @$game_line=trim($row[5]);
//     @$game_lang=trim($row[6]);
//     @$game_frame=trim($row[7]);
//     @$game_effects=trim($row[8]);
//     if($game_reel !='N/A' && $game_reel != ''){
//         $game_reel=$game_reel.'转';
//     }
    
//     @(!empty($row[9]))?$row[9]=$row[9].',':$row[9]='';
//     @(!empty($row[10]))?$row[10]=$row[10].',':$row[10]='';
//     @(!empty($row[11]))?$row[11]=$row[11]:$row[11]='';
//     @$to=$row[9].$row[10].$row[11];
//     @$game_topic=trim($to);
   // echo $game_topic;
   // echo "</br>";
///index.php?s=PlayDemo_playMG_gameid_GopherGold_clienttype_html5.html

    
    @$gameId=trim($row[5]);
   
    
//     $ssss="select * from rfcorp_lhjgame where cid=2 and game_id = '$gameId'";
   
//     $result = mysql_query($ssss,$con);
//     $rrs= mysql_num_rows($result);
//     if(!$rrs){
//         echo $ssss;
//         echo "<br/>";
//         print_r($gameId);
//         echo "_------------------------------------______-------------------------------";
//     }
    
    
    if($gameId !=''){
       // ECHO $i;
    $demourl="/index.php?s=PlayDemo_playMG_gameid_".$gameId."_clienttype_html5.html";
    $realurl="user.php?s=Index_playMG_gameid_".$gameId."_clienttype_html5.html";

       echo   $upsql="UPDATE rfcorp_lhjgame
     SET mobile_real_url = '$realurl',
     mobile_demo_url = '$demourl'
     WHERE game_id = '$gameId' AND cid=2;";
    echo "</br>";
    $i++;
    
    
    }

//       $upsql="UPDATE rfcorp_lhjgame
//  SET game_type = '$game_type',
//  game_reel = '$game_reel',
//  game_line = '$game_line',
//  game_lang = '$game_lang',
//  game_frame = '$game_frame',
//  game_effects = '$game_effects',
//  game_topic = '$game_topic'
//  WHERE title = '$game_title';";

  //  echo $upsql;
   
    
    }
   
?>