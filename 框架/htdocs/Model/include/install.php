<?php
/**
 * 安装此框架
 * @author Jason
 *
 */
class install{
    public $home;
    public function __construct($home){
      $this->home=$home;
    }
    /**
     * 执行安装 ...
     */
   public function start_install(){
    $home=$this->home;
    $con="$home/Lib/controller/";
           $this->Mk_Folder($con);
           $result='<?php
   class index_model extends action_model{
       public function index(){
                $GLOBALS[tmp]->display();
	   }
   }            ';
           $con=$con.'index.php';
           file_put_contents($con, $result, FILE_USE_INCLUDE_PATH);
           $ve="$home/Views/default/Tpl/index/";
           $this->Mk_Folder($ve);
           $ve=$ve.'index.php';
           $tmp= '<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body>
       <a href="<?=G::set_url("/index_index")?>">您现在可以使用该框架了</a>        
</body>
</html>';
           file_put_contents($ve, $tmp, FILE_USE_INCLUDE_PATH);
   }
   /**
    * 创建目录
    * @param unknown $Folder
    */
   private function Mk_Folder($Folder){
       if(!is_readable($Folder)){
           //dirname 返回路径的一部分
           $this->Mk_Folder( dirname($Folder) );
           if(!is_file($Folder)) mkdir($Folder,0777);
       }
   }
}

