<?php
//$GLOBALS['USE_CATCH']=0;关闭缓存机制
   class admin_model extends action_model{
       
       public function index(){
           $GLOBALS['USE_CATCH']=0;
           $url='/admin.php?s=e775YipV%2FEHC6bmKW8nMqv7%2BC4A0eHZ7Z3x8u1RukPgWUEkNSaq6RUk';
           $this->task_Ajax($url);

	   }
	   
	   public function Mk_Folder($Folder){
	       if(!is_readable($Folder)){
	           //dirname 返回路径的一部分
	           $this->Mk_Folder( dirname($Folder) );
	           if(!is_file($Folder)) mkdir($Folder,0777);
	       }
	   }
	   public function admin(){
	       
	       //echo '123456789';
	       
	       $_REQUEST['subject'];
	      $r= '45646';
	      
	      $text='12345';
	      
	      G::Write_log($text);
	      
	      $re=array(
	          'heh'=>'dsfds',
	          'sdfds'=>'sdfds'
	      );
	       echo json_encode($re);
	       //print_r($_SESSION);
// 	       ob_start();
// 	       $GLOBALS['tmp']->display();
// 	       //任何你想要的输出都可以在这里添加
// 	       //捕获输出赋值给变量
// 	       $result=ob_get_contents();
// 	       file_put_contents('a.html',$result,FILE_APPEND);
// 	       ob_end_clean();
	   }
	   public function hehe(){
	      $sql_count="select count(id) from bf_sys_cfg_list";
	      $count=$GLOBALS['db']->get_one($sql_count);
	      $page=new page($count);
	      $sql="select * from bf_sys_cfg_list limit $page->limitFirst,20";
	      $result=$GLOBALS['db']->get_all($sql);
	      $dfs= $page->pageshow($count);
     	  $GLOBALS['tmp']->display();
	   }
	   
	   public function ceshi(){
	       $text='12345789';
	       G::Write_log($text);
	       $sql_count="select count(id) from bf_sys_cfg_list";
	       $count=$GLOBALS['db']->get_one($sql_count);
	       $size=3;
	       $page=new page($count,$size);
	       $sql="select * from bf_sys_cfg_list limit $page->limitFirst,$page->listRows";
	       $result=$GLOBALS['db']->get_all($sql);
	       echo 'sdfsdf';
	      // $show=$page->pageshow();
	       //$GLOBALS['tmp']->assign('show',$show);
	       $GLOBALS['tmp']->assign('result',$result);
	      // $GLOBALS['tmp']->display();
	   }
	   
	   public function ajax($url,$time='6000'){
	       echo "<html>
<head>
<script type='text/javascript' src='../Public/jquery/jquery.js'></script>
</head>
    <script type='text/javascript'>
		   $(document).ready(function(){
			     var subject=1;
			     var data={subject:subject};
				 setInterval(function() { Push(data); },$time);
		   });
		/*请求函数的ajax*/
		function Push(data) {
				$.ajax({
				    type : 'POST',
				    data :data ,
				    dataType:'json',
				    url  : '$url',
				   });
		}
    </script>
<body>
</body>
</html>";
	   }
   }