php 运算符小结
最近在写PHP程序的时候发现了一些特殊的PHP符号，例如连续小于符号,三个小于符号,eot,eod,echo示例,print示例等，突然间 发现用这么久的PHP了,竟然连PHP的基本符号都没有认全,看到@号还查了半天才知道什么意思.把基本符号和一些外面冰吧常见的PHP符号整理成了列 表，在我的博客上帖一下吧,需要的朋友们可以参考下PHP相关的特殊符号~


注解符号:

         // 单行注解    

         /*      */    多行注解

引号的使用

         ’   ’ 单引号,没有任何意义,不经任何处理直接拿过来;

         " "双引号,php动态处理然后输出,一般用于变量.

变量形态:   

          一种是True 即 真的;

         另一种是False 即假的

常见变量形态:   

         string          字串(数字\汉字\等等)

         integer         整数(1、2、3、4、5、0、-1、-2、等等)

         double          浮点数（小数点）

         array           数组  

         object          对象

可以用的方法有gettype($mix) 和settype($mix,$typename);

常用符号

         \"         双引号

         \\         反斜线

         \n         换行

         \r         送出

         \t         跳位(TAB)

运算符号

         +       加法运算              -       减法运算

         *       乘法运算              /       除法运算

         %       取余数                ++     累加              

         --      累减1                 .      把字串相加        

设定运算

         =         把右边的值代入左边(一定要会)

         +=       把右边的值加到左边

         -=        把右边的值减到左边

         *=        把左边的值乘以右边

         /=        把左边的值除以右边

         .=        把右边的字串加到左边

位员运算

         &         且

         |           或

         ^         互斥(xor)

         <<      向左移位

         >>      向右移位

         ~         取1的补数

逻辑运算

       <      小于                 >       大于            

       <=     小于等于              >=      大于等于

       !=       不等于              &&      而且       

       ||         或者              !      不

其他运算符号

         $         变量符号              

         &        变量的指标(加在变量前)

         @       不显示错误信息(加在函数前)

         ->        对象的方法或者属性  

         =>       数组的元素值  

         ? :       三元运算子    

基本方法

1.PHP转换字符串为大小写！

    strtolower(); 把字符转小写
    strtoupper(); 把字符转大写

2.PHP加密字符串(大小写均可)
  
    md5();加密
    sha1();加密

3.关于引号

一、单引号是原样输出
二、双引号是内容解释进行输出
三、反单引号是执行一个命令，如`pwd`。
四、“\”作用于转译字符，如“\n”为换行！

4.函数:htmlspecialchars() 
本函数将特殊字符转成 HTML 的字符串格式 ( &....; )。最常用到的场合可能就是处理客户留言的留言版了。 

& (和) 转成 & 
" (双引号) 转成 " 
< (小于) 转成 &lt; 
> (大于) 转成 &gt; 

此函数只转换上面的特殊字符，并不会全部转换成 HTML 所定的 ASCII 转换。 

5.批量输出HTML内容！

echo <<< EOT
HTML输出内容。。。//这里注释照样输出！
EOT;

Print <<<EOT
HTML输出内容。。。//这里注释照样输出！
EOT;
(注意：内部包含变量用“{变量}”)

6.判断文件是否存在并且输出内容

<?php
$FileName="File.TXT";
if (File_Exists($FileName)){
Echo "<xmp>".File_Get_Contents($FileName)."</xmp>";
}else
{
Echo"no";
}
?>

7.卸载变量unset;

unset($var);
unset($var,$var1);


8.is_int;
检测变量是否是整数;
9.is_null;
检测变量是否为 NULL ;
10.is_string
检测变量是否是字符串
11.is_real;
is_float() 的别名
12.isset
检测变量是否设置
13.is_bool
检测变量是否是布尔型
14.is_array
检测变量是否是数组
15.is_object
检测变量是否是一个对象
16.SubStr.
SUBSTR(String,Start,SelectNum)
echo substr('abcdef', 1);       // bcdef
echo substr('abcdef', 1, 3);    // bcd
echo substr('abcdef', 0, 4);    // abcd
echo substr('abcdef', 0, 8);    // abcdef
echo substr('abcdef', -1, 1); // f
17.Nb2br
echo nl2br("foo isn't\n bar");
把转义的换行变成 HTML的<BR />