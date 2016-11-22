<?php
/*
=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=
+                         our team [F.S.T]                                  +
+               website : http://www.wrsky.com                              +
+         the tool change the code of php base64ed!!                        +
=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=1=
*/
?>
<HTML><HEAD><TITLE>火狐php后门变形工具</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<STYLE type=text/css>A {
	COLOR: #000000; TEXT-DECORATION: none
}
A:hover {
	TEXT-DECORATION: underline
}
BODY {
	FONT-SIZE: 12px; SCROLLBAR-ARROW-COLOR: #cc0000; SCROLLBAR-BASE-COLOR: #f8f8f8; BACKGROUND-COLOR: #999999
}
TABLE {
	FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana
}
TEXTAREA {
	FONT-WEIGHT: normal; FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana; BACKGROUND-COLOR: #f8f8f8
}
INPUT {
	FONT-WEIGHT: normal; FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana; BACKGROUND-COLOR: #f8f8f8
}
OBJECT {
	FONT-WEIGHT: normal; FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana; BACKGROUND-COLOR: #f8f8f8
}
SELECT {
	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana; BACKGROUND-COLOR: #f8f8f8
}
.nav {
	FONT-WEIGHT: bold; FONT-SIZE: 12px; FONT-FAMILY: Tahoma, Verdana
}
.header {
	FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #ffffff; FONT-FAMILY: Tahoma, Verdana; BACKGROUND-COLOR: #cc0000
}
.header A {
	COLOR: #ffffff; TEXT-DECORATION: none
}
.category {
	FONT-SIZE: 11px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana; BACKGROUND-COLOR: #efefef
}
.tableborder {
	BORDER-RIGHT: #cc0000 1px solid; BORDER-TOP: #cc0000 1px solid; BACKGROUND: #d6e0ef; BORDER-LEFT: #cc0000 1px solid; BORDER-BOTTOM: #cc0000 1px solid
}
.singleborder {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; FONT-SIZE: 0px; PADDING-BOTTOM: 0px; LINE-HEIGHT: 1px; PADDING-TOP: 0px; BACKGROUND-COLOR: #f8f8f8
}
.smalltxt {
	FONT-SIZE: 11px; FONT-FAMILY: Tahoma, Verdana
}
.mediumtxt {
	FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana
}
.bold {
	FONT-WEIGHT: bold
}
.multi {
	FONT-SIZE: 11px; COLOR: #000000; FONT-FAMILY: Tahoma, Verdana
}
.navtd {
	FONT-SIZE: 12px; COLOR: #ffffff; FONT-FAMILY: Tahoma, Verdana; TEXT-DECORATION: none
}
.tableborder {
	BORDER-RIGHT: #cc0000 1px solid; BORDER-TOP: #cc0000 1px solid; BACKGROUND: #d6e0ef; BORDER-LEFT: #cc0000 1px solid; BORDER-BOTTOM: #cc0000 1px solid
}
</STYLE>

<META content="MSHTML 6.00.2800.1476" name=GENERATOR></HEAD>
<BODY bgColor=#999999>
<CENTER>
<DIV align=center>
<FORM name=FORM action="" method=post 
encType=multipart/form-data>
<TABLE cellSpacing=1 cellPadding=0 width="40%" bgColor=#cc3300 border=0>
  <TBODY>
  <TR>
    <TD colSpan=2 height=30>
      <DIV align=center><STRONG><FONT 
      color=#ffffff>火狐php后门变形工具</FONT></STRONG></DIV></TD></TR>
  <TR bgColor=#cccccc>
    <TD vAlign=top height=120><TEXTAREA name=code rows=16 cols=90>
<?php
if (get_magic_quotes_gpc()) {
    $_GET = stripslashes_array($_GET);
	$_POST = stripslashes_array($_POST);
}
	// 去掉转义字符
	function stripslashes_array(&$array) {
		while(list($key,$var) = each($array)) {
			if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || ''.intval($key) == "$key")) {
				if (is_string($var)) {
					$array[$key] = stripslashes($var);
				}
				if (is_array($var))  {
					$array[$key] = stripslashes_array($var);
				}
			}
		}
		return $array;
	}

if (empty($_POST['code'])) {
echo"/*\n";
echo "请写入你要转换的代码，去掉程序的开头的&lt;?php和结尾的?&gt！";
echo"\n";
echo "另外提交后请耐心等待，不要重复提交或刷新，会出错的，^_^";
echo"下面给个示范\n*/\n";
echo'phpinfo();';
}else{
echo"&lt;?php";
echo" eval(base64_decode('";
echo base64_encode($_POST['code']);
echo"'));?&gt;";
}
?>
</TEXTAREA> 
  <TR align=middle bgColor=#cccccc>
    <TD colSpan=2 height=32><INPUT type=submit value=开始罪恶的变形></TD></TR>
  <TR align=middle>
    <TD colSpan=2 height=32>Copyright(c)<STRONG><FONT color=#ffffff> <A 
      href="http://www.wrsky.com/" target=_blank>火狐原创</A></FONT></STRONG> 
      Power By <STRONG><FONT color=#ffffff>Saiy 
  </FONT></STRONG></TD></TR></TBODY></TABLE></FORM></DIV></CENTER></BODY></HTML>
