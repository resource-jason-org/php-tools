<?php
   class index_model extends action_model{
       
       public function index(){
          $sql_count="select count(id) from bf_sys_cfg_list";
	      $count=$GLOBALS['db']->get_one($sql_count);
	      $page=new page($count);
	      $sql="select * from bf_sys_cfg_list limit $page->limitFirst,20";
	      $result=$GLOBALS['db']->get_all($sql);
	     // $page= $page->pageshow();
	      $GLOBALS['tmp']->display();
	   }
	   public function admin(){
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
	       g::Write_log($text);
	       $sql_count="select count(id) from bf_sys_cfg_list";
	       $count=$GLOBALS['db']->get_one($sql_count);
	       $size=3;
	       $page=new page($count,$size);
	       $sql="select * from bf_sys_cfg_list limit $page->limitFirst,$page->listRows";
	       $result=$GLOBALS['db']->get_all($sql);
	      // $show=$page->pageshow();
	       $GLOBALS['tmp']->assign('show',$show);
	       $GLOBALS['tmp']->assign('result',$result);
	       $GLOBALS['tmp']->display();
	   }
   }