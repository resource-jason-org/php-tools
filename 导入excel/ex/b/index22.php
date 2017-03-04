<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("game", $con);
mysql_query('set names utf8');
header("Content-Type:text/html;charset=utf-8");
$i=1;

    $sql="SELECT
*
FROM
	rfcorp_lhjgame
WHERE
	cid = 3
";
    $rr=mysql_query($sql);
    while($select=mysql_fetch_array($rr)){
      
        $en_name=$select['title'];
        $id=$select['id'];
        $game_id=$select['game_id'];
        $rurl="/user.php?s=Index_playAMYCommon_gameid_".$game_id."_clienttype_html5_gamename_".$en_name.".html";
        
        $durl="/index.php?s=PlayDemo_playTT_gameid_".$game_id."_clienttype_html5_gamename_".$en_name.".html";
        
        
       // $game_id=$select['game_id'];
        
        //NYX /index.php?s=/PlayDemo_playNYX_gameid_70021.html
        
//         $rurl="user.php?s=Index_playMG_gameid_$game_id.html";
//         $durl="user.php?s=Index_playMG_gameid_".$game_id."_mode_0.html";
        
        
        
//        $en_name=str_replace(" ","",$en_name);
//        $en_name=str_replace("_","/",$en_name);
//        $en_name=str_replace("`","//",$en_name);
        
//         print_r($id);
//         print_r($en_name);
//         echo "<br/>";
                  // $durl="/index.php?s=/PlayDemo_playNYX_gameid_".$select['game_id'].".html"; 
        //$durl="/index.php?s=PlayDemo_playTT_gameid_".$select['game_id']."_gamename_".$select['en_title'].".html";

        $upsql="UPDATE rfcorp_lhjgame
        SET mobile_real_url='$rurl' ,mobile_demo_url='$durl'
        WHERE id = '$id'";
        $rrs=mysql_query($upsql);
        if($rrs){
            echo "<br/>";
            print_r($id);
            echo "_------------------------------------______-------------------------------";
            $i++;
        }
    }
    echo $i;
?>