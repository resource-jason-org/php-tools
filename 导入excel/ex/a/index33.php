<?php 
$con = mysql_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("game", $con);
mysql_query('set names utf8');

header("Content-type: text/html; charset=utf-8");
$str="冒险/魔幻/神话/爱情/生活/休闲/风情/电影/运动/动物/植物/动作/科幻/财富/美食/历史/帮派/萌物/警匪/战争/赌场/节日/扑克/21点/轮盘/百家乐/消除/宾果";

$array = explode("/", $str);
print_R($array);
$i=1;
while(list($k,$v)=each($array)){
    $a='';
    $a="INSERT INTO `game`.`rfcorp_lhj_advsearch_cat` (
	`id`,
	`cid`,
	`title`,
	`tid`,
	`status`
)
VALUES
	(
		'',
		'7',
		'$v',
		'$i',
		'1'
	);

    ";
    echo $a;
    $rr=mysql_query($a);
    $i++;
    
   
    
}



//$select=mysql_fetch_row($rr);
//print_r($select);

exit;



$get=$_GET['id'];
empty($get)?$get=137:$get;
//$get=mysql_escape_string($get);
$sql="SELECT
	*
FROM
	rfcorp_verified_check_log
WHERE
	id = '$get'
";
echo $sql;
echo "<br/>";
$rr=mysql_query($sql);
while($select=mysql_fetch_row($rr)){
    print_r($select);
}

print_r($select);
exit;
$z="OR 1=1 AND 1=1";
$R=mysql_escape_string($z);
print_r($R);

?>