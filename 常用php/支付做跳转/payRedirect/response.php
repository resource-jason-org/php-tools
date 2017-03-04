<?php
header("Content-type: text/html; charset=utf-8");
require_once 'payTool.php';
require_once 'pay.url.config.php';



   
   
   echo curlRequest($responseUrl,$_REQUEST);
   
   
   
   
   