<?php
bd::connect();

class bd{
	
	public static $con;
	
	public static function connect(){
		define('DB_SERVER','localhost'); 
		define('DB_NAME','b3'); 
		define('DB_USER','root'); 
		define('DB_PASS',''); 
		bd::$con = @mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if (!bd::$con) {
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			exit;
		}
		mysqli_set_charset(bd::$con, "utf8");
	}
}

?>