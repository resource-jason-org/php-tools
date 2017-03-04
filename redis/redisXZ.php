<?php

header('Content-Type: text/html; charset=UTF-8');


class RedisModel  {
    private $REDIS_SERVER;
    private $REDIS_HOST;
    private $REDIS_PORT;
    private $REDIS_EXPIRE;
    private $REDIS_STATUS = false;

    function __construct() {
        $this->REDIS_CONFIG = true;
        $this->REDIS_HOST ='127.0.0.1';
        $this->REDIS_PORT = '6379';
        $this->REDIS_EXPIRE =30;
        //connect
        if($this->REDIS_CONFIG === true){
            try{
                $this->REDIS_SERVER = new Redis();
                $this->REDIS_SERVER->connect($this->REDIS_HOST, $this->REDIS_PORT);
               
      
                
                if(!$this->REDIS_SERVER->ping()){
               
                    $this->REDIS_STATUS = false;
                   // //$this->syslog( __FUNCTION__, __LINE__, "Redis Server Error!");
                }else{
                  
                    $this->REDIS_STATUS = true;
                }
            }catch(RedisException $e){
                
                
                $this->REDIS_STATUS = false;
          
            }
        }else{
            $this->REDIS_STATUS = false;
        }
    }
    public function status(){
        return $this->REDIS_STATUS;
    }
    public function flushAll(){
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->flushAll() : false;
    }
    public function del($key){
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->del($key) : false;
    }
    /**
     * get data
     * @param $key
     */
    function get($key){
        $value = $this->REDIS_SERVER->get($key);
        $jsonData  = json_decode( $value, true );
        if($this->REDIS_STATUS === false){
            return false;
        }else{
            return ($jsonData === NULL) ? $value : $jsonData;
        }
    }
    /**
     * set data
     * @param $key
     * @param $val
     */
    function set($key,$val){
        $val  =  (is_object($val) || is_array($val)) ? json_encode($val,JSON_UNESCAPED_SLASHES) : $val;
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->set($key,$val) : false;
    }
    /**
     * delete key and data
     * @param $key
     */
    function delete($key){
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->delete($key) : false;
    }
    /**
     * Set Redis Data
     * @param string $key 缓存变量名
     * @param mixed $val  存储数据
     * @param integer $exp  有效时间（秒）
     */
    function rpush($key,$val,$exp){

        //redis不认多维数组 json_encode
        $val  =  (is_object($val) || is_array($val)) ? json_encode($val,JSON_UNESCAPED_SLASHES) : $val;

        //         $result = $this->REDIS_SERVER->rpush($key, $val);
        $result = ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->rpush($key, $val) : false;

        return $result;
    }
    /**
     * List Count
     * @param $key
     */
    function llen($key){

        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->llen($key) : false;
    }
    /**
     * Get Redis List content，form $star to $end
     * @param  $key
     */
    function lgetrangePage($key,$star,$end){
        $value = $this->REDIS_SERVER->lgetrange($key,$star,$end);
        $jsonData  = json_decode( $value, true );

        if($this->REDIS_STATUS === false){
            return false;
        }else{
            return ($jsonData === NULL) ? $value : $jsonData;
        }
    }
    /**
     * Get Redis Data form list all
     * @param  $key
     */
    function lgetrange($key){
        $value = $this->REDIS_SERVER->lgetrange($key,0,-1);
        $jsonData  = json_decode( $value, true );
        if($this->REDIS_STATUS === false){
            return false;
        }else{
            return ($jsonData === NULL) ? $value : $jsonData;
        }

    }
    /**
     * 将哈希表key中的域field的值设为value。如果key不存在，一个新的哈希表被创建并进行HSET操作。
     * 如果域field已经存在于哈希表中，旧值将被覆盖。
     * @param  $key
     * @param  $field
     * @param  $val
     * return 如果field是哈希表中的一个新建域，并且值设置成功，返回1。如果哈希表中域field已经存在且旧值已被新值覆盖，返回0。
     */
    function hset($key,$field,$val){
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->hSet($key,$field,$val) : false;
    }

    /**
     * 返回哈希表key中给定域field的值。
     * @param  $key
     * @param  $field
     * return 给定域的值。当给定域不存在或是给定key不存在时，返回nil
     */
    function hget($key,$field){
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->hGet($key,$field) : false;
    }
    public function hdel($key,$field){
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->hDel($key,$field) : false;
    }
    public function hkeys($key){
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->hKeys($key) : false;
    }

    /**
     * 获取单页
     * @param $key
     * @param $lang
     */
    public function getPage($key,$lang = 'cn'){
        $label = $key.'-'.$lang;
        $value = $this->hget('page',$label);
        $jsonData  = json_decode( $value, true );
        if($this->REDIS_STATUS === false){
            return false;
        }else{
            return ($jsonData === NULL) ? $value : $jsonData;
        }
    }
    /**
     * 设置单页
     * @param $key
     * @param $val
     * @param $lang
     */
    public function setPage($key,$val,$lang = 'cn'){
        //redis不认多维数组 json_encode
        $val  =  (is_object($val) || is_array($val)) ? json_encode($val,JSON_UNESCAPED_SLASHES) : $val;
        $label = $key.'-'.$lang;
        return ($this->REDIS_STATUS === true) ? $this->hset('page',$label,$val) : false;
    }
    /**
     * 设置faqs
     * @param $key
     * @param $val
     * @param $lang
     */
    public function setFaqs($val,$lang = 'cn'){
        $label = 'faqs-lang-'.$lang;
        return ($this->REDIS_STATUS === true) ? $this->rpush($label,$val) : false;
    }
    /**
     * 获取faqs
     * @param $key
     * @param $val
     * @param $lang
     */
    public function getFaqs($lang = 'cn'){
        $label = 'faqs-lang-'.$lang;
        return ($this->REDIS_STATUS === true) ? $this->lgetrange($label) : false;
    }

    /**
     * 统计faq list数量
     * @param $key
     * @param $val
     * @param $lang
     */
    public function countFaqs($lang = 'cn'){
        $label = 'faqs-lang-'.$lang;
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->llen($label) : false;
    }

    /**
     * 统计game list数量
     * @param $key
     * @param $val
     * @param $lang
     */
    public function countGames(){
        $label = 'gamesList';
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->llen($label) : false;
    }
    public function countMobileGames(){
        $label = 'mobileGamesList';
        return ($this->REDIS_STATUS === true) ? $this->REDIS_SERVER->llen($label) : false;
    }
    /**
     * 设置faqs
     * @param $key
     * @param $val
     * @param $lang
     */
    public function setGames($val){
        $label = 'gamesList';
        return ($this->REDIS_STATUS === true) ? $this->rpush($label,$val): false;
    }
    public function setMobileGames($val){
        $label = 'mobileGamesList';
        return ($this->REDIS_STATUS === true) ? $this->rpush($label,$val): false;
    }
    /**
     * 获取faqs
     * @param $key
     * @param $val
     * @param $lang
     */
    public function getGames(){
        $label = 'gamesList';
        return ($this->REDIS_STATUS === true) ? $this->lgetrange($label) : false;
    }
    public function getMobileGames(){
        $label = 'mobileGamesList';
        return ($this->REDIS_STATUS === true) ? $this->lgetrange($label) : false;
    }
}


$a=new RedisModel();

$bb=$a->getGames();
print_r($bb);

?>
