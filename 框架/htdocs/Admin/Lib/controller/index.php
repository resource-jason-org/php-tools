<?php
//$GLOBALS['USE_CATCH']=0;关闭缓存机制
   class index_model extends action_model{
       
       public function index(){
           $GLOBALS['USE_CATCH']=0;
           $GLOBALS['tmp']->display();
	   }
	   
	   public function Mk_Folder($Folder){
	       if(!is_readable($Folder)){
	           //dirname 返回路径的一部分
	           $this->Mk_Folder( dirname($Folder) );
	           if(!is_file($Folder)) mkdir($Folder,0777);
	       }
	   }
	   public function admin(){
	       echo G::Set_lang(1);
	       echo $this->rand(10);
	       
	       $av = array("the ", "a ", "that ", "this ");
	       array_walk($av, create_function('&$v,$k', '$v = $v . "mango";'));
	       print_r($av);
	       
	       
	       
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
	       $show=$page->pageshow();
	       echo 'sdfsdfdsff';
	       //$GLOBALS['tmp']->assign('show',$show);
	       $GLOBALS['tmp']->assign('result',$result);
	      // $GLOBALS['tmp']->display();
	   }
   }