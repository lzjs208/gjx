<?php 
class ConnectionMYSQL{
	
	public $host	= "localhost";
	public $name	= "gjx";
	public $pass	= "gjx!123";
	public $table	= "gjxdb";
	public $char	= "utf8";

	public function __construct(){
// 		$this->char=$char;
		$this->connect();
	}
	
	public function connect(){
		$connection = mysql_connect($this->host,$this->name,$this->pass) or die ($this->error());
		mysql_select_db($this->table,$connection) or die ("不存在该数据库".$this->table);
		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET character set 'utf8'");
	}
	
	public function query($sql, $type=''){
		if(!($query = mysql_query($sql))) $this->show('Say:',$sql);
		echo mysql_error();
		return $query;
	}
	
	public function show($message='',$sql=''){
		if(!$sql) echo $message;
		else echo $message.'<br>'.$sql;
	}
	
	public function fn_select($table){
		$this->query("select * from $table");
	}

	public function fn_insert($table,$name,$value){
		$this->query("insert into $table ($name) values ($value)");
	}

	public function fn_delete($table,$id){
		$this->query("delete from $table where id in($id)");
	}

	public function get_one($sql,$result_type = MYSQL_ASSOC){
		$query = $this->query($sql);
		$str = mysql_fetch_array($query,$result_type);
		return $str;
	}

	public function close(){
		return mysql_close();
	}

	public function selecturl($url,$jumpurl,$title){
		if($jumpurl){
			$str = "<a href='".$jumpurl."' target='_blank'>".$title."</a>";
		}else{
			$str = "<a href='".$url."' target='_blank'>".$title."</a>";
		}
	}
}

?>