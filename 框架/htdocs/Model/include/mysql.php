<?php
class mysql {
	private $host;
	private $user;
	private $pwd;
	private $dbName;
	private $charset;
	private $conn = null; // 保存连接的资源
	public function __construct($host,$user,$pwd,$dbName,$charset,$switch='') {
		$this->host = $host;
		$this->user = $user;
		$this->pwd = $pwd;
		$this->dbName = $dbName;
		$this->charset = $charset;
		$this->connect ( $this->host, $this->user, $this->pwd );
		if(empty($switch)){
		    $switch=$this->dbName;
		}
		$this->switch_database ($switch);
		$this->set_char ( $this->charset );
	}
	/**
	 * 连接数据库
	 * @param host $h
	 * @param user $u
	 * @param password $p
	 */
	private function connect($h, $u, $p) {
		$conn = mysql_connect ( $h, $u, $p );
		if(!$conn){
			safe_exit("can not connect to mysql server on $h.");
		}
		$this->conn = $conn;
	}
	
	/**
	 *  负责切换数据库,网站大的时候,可能用到不止一个库
	 */
	public function switch_database($db) {
		$sql = 'use ' . $db;
		$this->query ( $sql );
	}
	
	/**
	 * 负责设置字符集
	 */
	public function set_char($char) {
		$sql = 'set names ' . $char;
		$this->query ( $sql );
	}
	
	/**
	 * 负责发送sql查询
	 * @param unknown $sql
	 */
	public function query($sql) {
		return mysql_query ( $sql, $this->conn );
	}
	
	/**
	 * 负责获取多行多列的select 结果
	 * @param unknown $sql
	 */
	public function get_all($sql) {
		$list = array ();
		$rs = $this->query ( $sql );
		if (! $rs) {
			return false;
		}
		while ( $row = mysql_fetch_assoc ( $rs ) ) {
			$list [] = $row;
		}
		return $list;
	}
	
	/**
	 * 获取一行的select 结果
	 * @param unknown $sql
	 * @return boolean
	 */
	public function get_row($sql) {
		$rs = $this->query ( $sql );
		if (! $rs) {
			return false;
		}
		return mysql_fetch_assoc ( $rs );
	}
	
	/**
	 *  获取一个单个的值
	 * @param unknown $sql
	 * @return boolean|unknown
	 */
	public function get_one($sql) {
		$rs = $this->query ( $sql );
		if (! $rs) {
			return false;
		}
		$row = mysql_fetch_row ( $rs );
		return $row [0];
	}

	public function affected_rows() {
		return mysql_affected_rows ( $this->conn );
	}
	
	public function __destruct() {
	    mysql_close ( $this->conn );
	}
}
