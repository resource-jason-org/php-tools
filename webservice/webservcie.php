<?php


//server端 serverSoap.php

$soap = new SoapServer(null,array('uri'=>"http://192.168.1.179/"));//This uri is your SERVER ip.
$soap->addFunction('minus_func');                                                 //Register the function
$soap->addFunction(SOAP_FUNCTIONS_ALL);
$soap->handle();

function minus_func($i, $j){
    $res = $i - $j;
    return $res;
}

//client端 clientSoap.php
try {
    $client = new SoapClient(null,
        array('location' =>"http://192.168.1.179/test/serverSoap.php",'uri' => "http://127.0.0.1/")
    );
    echo $client->minus_func(100,99);

} catch (SoapFault $fault){
    echo "Error: ",$fault->faultcode,", string: ",$fault->faultstring;
}



////这是客户端调用服务器端函数的例子，我们再搞个class的。

//server端 serverSoap.php
$classExample = array();

$soap = new SoapServer(null,array('uri'=>"http://192.168.1.179/",'classExample'=>$classExample));
$soap->setClass('chesterClass');
$soap->handle();

class chesterClass {
    public $name = 'Chester';

    function getName() {
        return $this->name;
    }
}

//client端 clientSoap.php

try {
    $client = new SoapClient(null,
        array('location' =>"http://192.168.1.179/test/serverSoap.php",'uri' => "http://127.0.0.1/")
    );
    echo $client->getName();

} catch (SoapFault $fault){
    echo "Error: ",$fault->faultcode,", string: ",$fault->faultstring;
}
