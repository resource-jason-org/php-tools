<?php
/**
 * 处理模板
 * @author Jason
 *
 */
class template
{
    protected $assign=array();
    public function __construct(){
        
    }
    /**
     * 显示模板
     * @param string $tmp
     */
    public function display($tmp=''){
        $tpl = $GLOBALS['action'];
        if (empty($tmp)) {
            $function = $GLOBALS['function'];
            $file = $GLOBALS['tpl'] . $tpl . DL . $function . PHP;
            $this->checkTemplate($file);
            @extract($this->assign, EXTR_OVERWRITE);
            $s = $GLOBALS['catch'] . $tpl . DL.$function;
            $s=md5($s);
            $html =$s. '.html';
        } else {
            $file = $GLOBALS['tpl'] . $tpl . DL . $tmp . PHP;
            $this->checkTemplate($file);
            @extract($this->assign, EXTR_OVERWRITE);
            $s = $GLOBALS['catch'] . $tpl . DL.$tmp;
            $s=md5($s);
            $html =$s.'.html';
        }
        // 是否开启缓存
        if (USE_CATCH != 1) {
            include $file;
        } else {
            if ($GLOBALS['USE_CATCH'] == USE_CATCH) {
                $html = 'html/'. $html;
                $filetime = '';
                if (file_exists($html)) {
                    $filetime = filemtime($html);
                }
                $time = time();
                if ($time - $filetime > CATCH_TIME) {
                    ob_start();
                    include $file;
                    $result = ob_get_contents();
                    file_put_contents($html, $result, FILE_USE_INCLUDE_PATH);
                    ob_end_clean();
                }
                if (file_exists($html)) {
                    @header("Location: $html");
                } else {
                    include $file;
                }
            } else {
                include $file;
            }
        }
    }
    /**
     * 模板赋值
     * @param 前台取值变量 $k
     * @param 前台取的值 $v
     */
    public function assign($k,$v){
        $this->assign[$k]=$v;
    }
    /**
     * 创建目录
     * @param unknown $Folder
     */
    public function Mk_Folder($Folder){
        if(!is_readable($Folder)){
            //dirname 返回路径的一部分 
           $this->Mk_Folder( dirname($Folder) );
            if(!is_file($Folder)) mkdir($Folder,0777);
        }
    }
    /**
     * 检查模板是否存在
     */
    private function checkTemplate($file){
        if (!file_exists($file)) {
            echo "<div style='width:100%;height:100px;'><span style='color:red;font-weight:900;'>模板不存在!<span></div>";
            exit();
        }
    }
}
