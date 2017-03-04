<?php

$requestURL="";

$args=$_REQUEST;
$sHtml="";
while (list ($key, $val) = each ($args)) {
    $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
}

    $html=<<<HTML
	    <html>
		<head>
		<title>To PAY Page</title>
		</head>
	    <body onLoad="document.returnfunc.submit();">
	    <form action="$requestURL" name="returnfunc" id="returnfunc" method="POST">
	        $sHtml
		</form>
		</body>
		</html>
HTML;
	    echo $html;

