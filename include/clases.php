<?php
define('DB_SERVER','localhost'); 
define('DB_NAME','sm'); 
define('DB_USER','root'); 
define('DB_PASS',''); 


BD::connect();

class bd{
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

class login{
	public static function in($user, $pass){
		$sql="SELECT * FROM usuario WHERE username = '".$user."'  AND pass = '".md5($pass)."'";
		$usuarios=mysqli_query(bd::$con, $sql);
		if(mysqli_num_rows($usuarios) == 1){
			$fila=mysqli_fetch_object($usuarios);
			$_SESSION['user']=$fila->username;
			$_SESSION['tipo']=$fila->tipo;
			log::set("IniciÃ³ sesiÃ³n");
			header('location: index.php');
		}
	}
}

class log{
	
	static function set($text){
		if(!isset(bd::$con)) log::bd();
		date_default_timezone_set('America/Montevideo');
		$registro=date("[d-m-Y H:i:s]")." [".$_SESSION['user']."] ".$text.'\n';
		$sql="INSERT INTO `log` (`mes`, `registro`) VALUES ('".date('m-Y')."', '$registro') ON DUPLICATE KEY UPDATE registro=concat(registro, '$registro')";
		mysqli_query(bd::$con, $sql);
	}
	
	static function show(){
		$show=array();
		if(!isset(bd::$con)) log::bd();
		$sql="SELECT mes FROM `log`";
		$resultado=mysqli_query(bd::$con, $sql);
		while($temp=mysqli_fetch_object($resultado)){
			$show[]=$temp->mes;
		}
		return $show;
	}
	
	static function download($mes){
		$sql="SELECT registro FROM `log` WHERE mes='".$mes."'";
		$resultado=mysqli_query(bd::$con, $sql);
		$contenido=mysqli_fetch_object($resultado);
		$contenido=$contenido->registro;
		$filename='log '.$mes.'.txt';
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-disposition: attachment; filename='.$filename);
		//header('Content-Length: '.mb_strlen($contenido));
		header("Pragma: no-cache");
		header("Expires: 0");
		header('Cache-Control: must-revalidate');
		echo $contenido;
		log::set("DescargÃ³ ".$filename);

	}
}
?>