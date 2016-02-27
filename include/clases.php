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
        
        public static function cast_query_results($rs) {
            $fields = mysqli_fetch_fields($rs);
            $data = array();
            $types = array();
            foreach($fields as $field) {
                switch($field->type) {
                    case 1:
                        $types[$field->name] = 'boolean';
                        break;
                    case 3:
                        $types[$field->name] = 'int';
                        break;
                    case 4:
                        $types[$field->name] = 'float';
                        break;
                    default:
                        $types[$field->name] = 'string';
                        break;
                }
            }
            while($row=mysqli_fetch_assoc($rs)) $data[]=$row;
            for($i=0;$i<count($data);$i++) {
                foreach($types as $name => $type) {
                    settype($data[$i][$name], $type);
            }
            }
            return $data;
        }
}

class login{
	public static function in($user, $pass){
		$sql="SELECT * FROM usuario WHERE username = '".$user."'  AND password = '".md5($pass)."'";
		$usuarios=mysqli_query(bd::$con, $sql);
		if(mysqli_num_rows($usuarios)){
			$fila=mysqli_fetch_object($usuarios);
			$_SESSION['user']=$fila->username;
			$_SESSION['tipo']=$fila->tipo;
                        $_SESSION['nombre']=$fila->nombre;
                        $_SESSION['apellido']=$fila->apellido;
                        
			log::set("IniciÃ³ sesiÃ³n");
            		header('location: index.php');
                }else{
                    msg::set("Credenciales inválidas");
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

class articulo{
    static function get($id){
        $sql="SELECT a.id, (SELECT razon_social FROM cliente WHERE id=a.proveedor) AS proveedor, a.nombre, a.observaciones FROM articulo as a WHERE a.id=".$id;
        $resultado=mysqli_query(bd::$con, $sql);
        if($articulo=bd::cast_query_results($resultado)[0]){
            $sql="SELECT *, (SELECT nombre FROM categoria WHERE id=s.id_categoria) AS categoria, (SELECT GROUP_CONCAT(`tag`) FROM `subarticulo-tag` WHERE `id_subarticulo` = s.id GROUP BY `id_subarticulo`) AS tags FROM subarticulo AS s WHERE s.id_articulo=".$id;
            $resultado2=mysqli_query(bd::$con, $sql);
            if($subarticulos=bd::cast_query_results($resultado2)){
                foreach($subarticulos as $subarticulo){
                    
                }
                $articulo["subarticulos"]=$subarticulos;
                return $articulo;
            }else $articulo=null;
        }else $articulo=null;
        return $articulo;
    }
}

class user{
	static function add($nombre, $apellido, $email, $username, $pass1, $pass2, $adm){
            $tipo=($adm ? "ADM" : "USR");
		if(strnatcmp($pass1, $pass2) == 0){
			$sql="INSERT INTO `sm`.`usuario` (`username`, `tipo`, `password`, `nombre`, `apellido`, `email`) VALUES ('".$username."', '".$tipo."', '".md5($pass1)."', '".$nombre."', '".$apellido."', '$email');";
			if(mysqli_query(bd::$con, $sql)){
				msg::set("[$tipo] $username agregado");
				log::set("AgregÃ³ a [$tipo] $username");
			}else msg::set("Usuario no agregado");
		} else msg::set("Usuario no agregado, contraseñas no coinciden");
	}
/*	
	static function del($username){
		if(!strnatcasecmp($username, $_SESSION['user']) == 0){
			$sql="DELETE FROM `usuario` WHERE username = '".$username."'";
			if(mysqli_query(bd::$con, $sql)){
				msg::set("Usuario $username borrado");
				log::set("Borro al usuario $username");
			}else msg::set("Usuario no borrado");
		} else{
			msg::set("No es posible autoeliminarse");
			log::set("Intento autoeliminarse");
		} 
	}
        
	static function show(){
		$sql="SELECT username, tipo FROM usuario";
		$cons=mysqli_query(bd::$con, $sql);
		while($fila=mysqli_fetch_assoc($cons)){
			$array[]=$fila;
		}
		return $array;
	}
	
	static function pass($pass0, $pass1, $pass2){
		$user=$_SESSION['user'];
		$sql="SELECT pass FROM usuario WHERE username = '$user'";
		$cons=mysqli_query(bd::$con, $sql);
		$cons=mysqli_fetch_assoc($cons);
		if(strnatcasecmp(md5($pass0), $cons['pass']) == 0 && strnatcasecmp(md5($pass1), md5($pass2)) == 0){
			$sql="UPDATE usuario SET pass = '".md5($pass1)."' WHERE usuario.username = '".$user."'";
			if(mysqli_query(bd::$con, $sql)){
				msg::set("ContraseÃ±a cambiada");
				log::set("Cambio su contraseÃ±a");
			}
		}else msg::set("ContraseÃ±a no cambiada");
	}*/
}

class msg{
	static $msg = array();
	static function set($string){
		self::$msg[]=$string;
	}
	static function get(){
		return implode("<br>", self::$msg);
	}
}
?>