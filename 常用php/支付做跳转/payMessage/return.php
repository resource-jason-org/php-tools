<?php 
    if(@empty($_GET['trade_status'])){
        header('HTTP/1.1 404 Not Found'); header('status: 404 Not Found'); exit();
    }
    if(@$_GET['trade_status'] == 'TRADE_FINISHED' || @$_GET['trade_status'] == 'TRADE_SUCCESS') {   
     
     header("Location:index.php?s=1");
     exit;
   }else{
      header("Location:index.php?s=2");
      exit;
   }
?>
