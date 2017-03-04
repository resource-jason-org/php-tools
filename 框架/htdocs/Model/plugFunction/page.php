<?php
class page{
    public $limitFirst;
    public $nowPage;
    public $listRows;
    public $count;
    /**
     * 初始化分页类
     * @param 记录总数 $total
     * @param 分页大小 $listRows
     */
    public function __construct($total,$listRows=15){
        $this->count=$total;
        $this->listRows=$listRows;
        $this->nowPage = ! empty ( $_REQUEST['page'] ) ? $_REQUEST ['page'] : 1;
        $this->limitFirst= ($this->nowPage -1) * $listRows;
    }
    /**
     * 显示分页
     * @return boolean|string
     */
    public function pageshow()
    {
        $GLOBALS['USE_CATCH']=0;
        if (isset($this->nowPage)) {
            $page = $this->nowPage;
        } else
            $page = 1;
            // 如果$url使用默认,即空值,则赋值为本页URL
        $url = $_SERVER["REQUEST_URI"];
        // URL分析
        $parse_url = parse_url($url);
        @$url_query = $parse_url["query"]; // 取出在问号?之后内容
        if ($url_query) {
            $url_query = preg_replace("/(&?)(page_$page)/", "", $url_query);
            $url = str_replace($parse_url["query"], $url_query, $url);
            //对URL加密进行处理
            $host=$_SERVER['HTTP_HOST'];
            if(ENCORD_URL==1){
                $url = str_replace("s=", "", $url_query);
                $url=urldecode($url);
                $url=G::authcode($url);
                $url="http://$host/?s=".$url.'_';
            }else{
                $url="http://$host".$url;
            }
            if ($url_query) {
                $url .= "page";
            } else
                $url .= "?s=/index_index_page";
        } else
            $url .= "?s=/index_index_page";
            // 页码计算
        $lastpg = ceil($this->count /  $this->listRows); // 最后页,总页数
        $page = min($lastpg, $page);
        $prepg = $page - 1; // 上一页
        $nextpg = ($page == $lastpg ? 0 : $page + 1); // 下一页
        $this->sqlfirst = ($page - 1) *  $this->listRows;
        // 开始分页导航内容
        @$pagecon = "显示第 " . ($this->count ? ($this->limitFirst + 1) : 0) . "-" . min($this->limitFirst +  $this->listRows, $this->count) . " 条记录，共 <B>$this->count</B> 条记录";
        if ($lastpg <= 1)
            return false; // 如果只有一页则跳出
        if ($page != 1)
            $pagecon .= " <a href=".$url."_1>首页</a> ";
        else
            $pagecon .= " 首页 ";
        if ($prepg)
            $pagecon .= " <a href= ".$url."_".$prepg.">前页</a> ";
        else
            $pagecon .= " 前页 ";
        if ($nextpg)
            $pagecon .= " <a href=".$url."_".$nextpg.">后页</a> ";
        else
            $pagecon .= " 后页 ";
        if ($page != $lastpg)
            $pagecon .= " <a href=".$url."_".$lastpg.">尾页</a> ";
        else
            $pagecon .= " 尾页 ";
            // 下拉跳转列表,循环列出所有页码
        $pagecon .= "　到第 <select name='topage' size='1' onchange='window.location=\"$url\_\"+this.value'>\n";
        for ($i = 1; $i <= $lastpg; $i ++) {
            if ($i == $page)
                $pagecon .= "<option value='$i' selected>$i</option>\n";
            else
                $pagecon .= "<option value='$i'>$i</option>\n";
        }
        $pagecon .= "</select> 页，共 $lastpg 页";
        $this->nowPage=$page;
        return $pagecon;
    }
}
		
?>	 
