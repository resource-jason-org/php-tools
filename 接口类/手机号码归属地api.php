 <?php
   $number=$_REQUEST['phone'];
	    if($number){
    	    $xml=file_get_contents("http://www.096.me/api.php?phone=$number&mode=xml");
    	    $obj_xml=simplexml_load_string($xml);
    	     foreach($obj_xml->children() as $child)   //获取XML对象里面的每一个子节点，也是一个类似于数组的对象
    	     {
    	         echo $child->phonenum;
    	         echo $child->location;
    	         echo $child->phoneJx;
    	     }
	     }
?>