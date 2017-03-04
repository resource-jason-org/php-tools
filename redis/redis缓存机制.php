<?php
header("Content-type: text/html; charset=utf-8"); 
    /**
     * 工厂方法模式
     * -------------
     * @author      Jason
     * @version     v1.0
     */
    //缓存接口
    interface cache { 
        public function init($conf);
        public function setVal($key , $val);
        public function getVal($key);
        public function delVal($key);
        public function autoIncreament($key);
    }
    //mem
    class mymemCache implements cache {
        //mymem连接
        public function init($conf)
        {
            echo '初始化mymem';
        }
        public function setVal($key , $val)
        {
            echo 'mem设置值';
        }
        public function getVal($key)
        {
            echo 'mem获取值';
        }
        public function delVal($key)
        {
            echo 'mem删除值';
        }
        public function autoIncreament($key)
        {
            echo 'mem自增';
        }
    } 
    //redis
    class redisCache  implements cache { 
        public $redis_con;
        public function __construct(){
    	      $redis = new Redis;
    	      $this->redis_con=$redis;
              $this->redis_con->connect('127.0.0.1');
    	 }
        //redis连接
        public function init($arr)
        {
//     	   $redis = new Redis;
//         $redis->connect('127.0.0.1');
        }
        public function setVal($key , $val)
        {
			$this->redis_con->set($key, $val);
        }
        public function getVal($key)
        { 
		   $result=$this->redis_con->get($key);
		   return $result;
        }
        public function delVal($key)
        {
            $this->redis_con->delete($key);
        }
        public function autoIncreament($key)
        {
            echo 'redis自增';
        }
    }
    class cacheFactory
    {
        private static $obj; 
        private static $type;
        private static $conf;
        private static $allowtype = array('mymem','redis');
        private static function getConfig()
        {
            //include_once('config.php');加载配置文件 获取缓存的类型 及缓存的配置参数
            global $_SC;
            self::$type = $_SC['cachetype'];//做空值的判断
            self::$conf = $_SC['cacheconf'];//做空值的判断
        }
        //外部调用创建缓存对象
        public static function CreateOperation(){
            self::getConfig();
            try
            {
                $error = '未知的缓存类型';
                if(in_array(self::$type , self::$allowtype))
                {
                    $type = self::$type.'Cache';
                    self::$obj = new $type;
                }
                else
                    throw new Exception($error);
            }
            catch (Exception $e) { 
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                exit;
            }
            return self::$obj;
        }
    }

    $_SC = array();
    $_SC['cachetype'] = 'redis';//mymem
    $_SC['cacheconf'] = array();
    $cache = cacheFactory::CreateOperation();
    $rrr=$cache->setVal('a','1111');
    echo '<br />';
    $a = $cache->getVal('hehe');
    $b = $cache->getVal('a');
	echo $a;
	echo $b;
    echo '<br />';
    $cache->delVal('hehe');
  ?>