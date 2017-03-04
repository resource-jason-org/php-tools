<?php   
session_start();
class comments{
     public $thisname='com.php';
	 public function getPath($path,$lei='all'){
		if(!is_dir($path))return;
		$openPath=opendir($path);
  		while($file=readdir($openPath)){
			if($file=='.' || $file=='..'){
	 			continue 1;
			}elseif(is_dir($path.'/'.$file) && $lei=='all'){
				$apath=$path.'/'.$file;
  				$this->getPath($apath,$lei);	
			}else{
				 $suffix=explode('.',$file);
				 $suffix=strtolower($suffix[count($suffix)-1]);
				 if($suffix=='php' && $file !=$this->thisname){
					$_SESSION['encode'][]=$path.'/'.$file;
				 }
			}
		}
 	}
 	public function encode($type='addComments'){
 	    $count=0;
 	    if(empty($_SESSION['encode'])){
 	        echo $type."<font color='red'>  ".$count."  </font>" ;
 	        return;
 	    }
 	    while (list($key, $val) = each($_SESSION['encode'])){
 	    unset($_SESSION['encode'][$key]);
 	    $fileName=$val;
 	    if($type=='delete'){
 	        if(unlink($fileName));
 	         $count++;
 	       }else{
 	 
 	    $phpContent=file_get_contents($fileName);
 	    if(trim($phpContent)=='')return;
 	    $encodeContent=preg_replace_callback('/^<\?php/',function (){
 	           $zs=
<<<zss
<?php
/**
 * @package      	xxxxx     
 * @author          Jason 
 * @copyright       xxxxx 
 * @license         xxxxx       
 * @version         v1.0
                              _ooOoo_
                             o8888888o
                             88" . "88
                             (| -_- |)
                              O\ = /O
                          ____/`---'\____
                        .   ' \\| |// `.
                         / \\||| : |||// \
                        / _||||| -:- |||||- \
                         | | \\\ - /// | |
                        | \_| ''\---/'' | |
                        \ .-\__ `-` ___/-. /
                     ___`. .' /--.--\ `. . __
                  ."" '< `.___\_<|>_/___.' >'"".
                 | | : `- \`.;`\ _ /`;.`/ - ` : | |
                   \ \ `-. \_ __\ /__ _/ .-` / /
           ======`-.____`-.___\_____/___.-`____.-'======
                              `=---='
 */
 	           
zss;
 return $zs;  },trim($phpContent));
 	    $fo=file_put_contents($fileName,$encodeContent);
 	    if($fo){
 	        $count++;
 	     }
    	}
 	}
 	echo $type."<font color='red'>".$count."</font>";
 	}
}
$com=new comments();
 	$path=dirname(__FILE__);
 	$com->getPath($path);
 	$com->encode();
 	echo "complete!";
 session_unset();
  unlink("com.php");
?>