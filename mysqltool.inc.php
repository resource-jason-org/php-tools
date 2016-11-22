<?php
class MysqlTool {
	private $host;
	private $user;
	private $pwd;
	private $dbName;
	private $charset;
	private $conn = null; // 保存连接的资源
	public function __construct() {
		// 应该是在构造方法里,读取配置文件
		// 然后根据配置文件来设置私有属性
		// 此处还没有配置文件,就直接赋值
		$this->host = 'localhost';
		$this->user = 'root';
		$this->pwd = '1q2w3e4r5t';
		$this->dbName = 'hgame';
		$this->charset = 'utf8';
		
		// 连接
		$this->connect ( $this->host, $this->user, $this->pwd );
		
		// 切换库
		$this->switch_database ( $this->dbName );
		
		// 设置字符集
		$this->set_char ( $this->charset );
	}
	
	// 负责连接
	private function connect($h, $u, $p) {
		$conn = mysql_connect ( $h, $u, $p );
		if(!$conn){
			safe_exit("can not connect to mysql server on $h.");
		}
		$this->conn = $conn;
	}
	
	// 负责切换数据库,网站大的时候,可能用到不止一个库
	public function switch_database($db) {
		$sql = 'use ' . $db;
		$this->query ( $sql );
	}
	
	// 负责设置字符集
	public function set_char($char) {
		$sql = 'set names ' . $char;
		$this->query ( $sql );
	}
	
	// 负责发送sql查询
	public function query($sql) {
		return mysql_query ( $sql, $this->conn );
	}
	
	// 负责获取多行多列的select 结果
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
	
	// 获取一行的select 结果
	public function get_row($sql) {
		$rs = $this->query ( $sql );
		
		if (! $rs) {
			return false;
		}
		
		return mysql_fetch_assoc ( $rs );
	}
	
	// 获取一个单个的值
	public function get_one($sql) {
		$rs = $this->query ( $sql );
		if (! $rs) {
			return false;
		}
		
		$row = mysql_fetch_row ( $rs );
		
		return $row [0];
	}
	public function close() {
		mysql_close ( $this->conn );
	}
	public function affected_rows() {
		return mysql_affected_rows ( $this->conn );
	}
}
