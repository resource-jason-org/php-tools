<?php

header('Content-Type: text/html; charset=UTF-8');

//引用 PHP。。。。。。

function &test(){
     static $_testArray=array('ceshi1'=>1,'ceshi2'=>100);
     
     $_testArray['ceshi1']= $_testArray['ceshi1']+100;
     
     return $_testArray;
}
$a=5;

$a=test();

print_r($a);

print_R(test());

$a=&test();

$a['ceshi1']=100000;

print_R(test());

$a['ceshi1']=200000;

print_R(test());




function test(&$a){
    $a=$a+100;
}
$b=1;
echo $b;//输出１ test($b);   //这里$b传递给函数的其实是$b的变量内容所处的内存地址，通过在函数里改变$a的值　就可以改变$b的值了 echo "<br>"; echo $b;//输出101


$a="ABC";
$b =&$a;
echo $a;//这里输出:ABC
echo $b;//这里输出:ABC
$b="EFG";
echo $a;//这里$a的值变为EFG 所以输出EFG echo $b;//这里输出EFG




?>
