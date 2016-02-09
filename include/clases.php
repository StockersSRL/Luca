<?php
define('DB_SERVER','localhost'); 
define('DB_NAME','sm'); 
define('DB_USER','root'); 
define('DB_PASS',''); 


BD::connect();

class BD{
	public static $con;
	public static function connect(){
		BD::$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if (!bd::$con) {
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			exit;
		}
		mysqli_set_charset(BD::$con, "utf8");
	}
}

?>