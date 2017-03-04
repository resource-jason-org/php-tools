<?php
require Functions;
class action_model extends functions
{
    
    public function __construct(){
       parent::__construct();
       
    }
    /**
     * (non-PHPdoc)
     * @see functions::display()
     */
    public function display($tmp='')
    {
        parent::display($tmp);
    }
    /**
     * 获取php版本
     */
    public function getPhpVersion(){
            phpinfo();
    }
    /**
     * 随机数
     * $m 随机多少位
     */
    public function rand($m){
         for($i=0;$i<$m;$i++){
           @$r.=rand(0,9);
         }    
         return $r;  
    }
      
    /**
     * xml 转换成数组
     * $file 文件路径
     */
    public function xml_to_array($file)
    {
        $xml=join("",file($file));
        $array = (array)(simplexml_load_string($xml));
        foreach ($array as $key=>$item){
            $array[$key]  =  $this->struct_to_array((array)$item);
        }
        return $array;
    }
    private function struct_to_array($item) {
        if(!is_string($item)) {
            $item = (array)$item;
            foreach ($item as $key=>$val){
                $item[$key]  = $this->struct_to_array($val);
            }
        }
        return $item;
    }
    
   
    public function __destruct(){
       
    }
}