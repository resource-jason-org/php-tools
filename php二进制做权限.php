<?php 




/**
 * 
 * 
0000 0000 0000 0001 是否缓存帖子位置信息
0000 0000 0000 0010 是否回帖只对管理人员和发帖者可见
0000 0000 0000 0100 是否抢楼贴
0000 0000 0000 1000 是否倒序查看回帖
0000 0000 0001 0000 是否存在主题图章标志位
0000 0000 0010 0000 回复是否通知作者
0000 0000 0100 0000 是否推送到QQ空间
0000 0000 1000 0000 是否推送到腾讯微博

这8种状态可以使用一个数字来同时表示，节省了字段

那么这种东西的原理是什么呢

这个我们可以复习一下的位运算单算法

例子	名称	结果
$a & $b	And（按位与）	将把 $a 和 $b 中都为 1 的位设为 1。
$a | $b	Or（按位或）	将把 $a 或者 $b 中为 1 的位设为 1。
$a ^ $b	Xor（按位异或）	将把 $a 和 $b 中不同的位设为 1。
~ $a	Not（按位非）	将 $a 中为 0 的位设为 1，反之亦然。
$a << $b	Shift left（左移）	将 $a 中的位向左移动 $b 次（每一次移动都表示“乘以 2”）。
$a >> $b	Shift right（右移）	将 $a 中的位向右移动 $b 次（每一次移动都表示“除以 2”）。
 * 
 */




// echo bindec('0011');

// echo '<br/>';

// $a=3 ;


// $b=6;


// echo bindec('0110');

// echo '<br/>';

// echo $a & $b;

// echo '<br/>';

// echo  decbin($a & $b);

// echo '<br/>';

// echo $a|$b;


// echo '<br/>';


// echo  decbin($a|$b);




//echo 2 << 3;


define('aaaaa', 2 << 3);


echo aaaaa;



?>