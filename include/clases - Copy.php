<?php
/*
session_start(); 
if(!isset($_SESSION['user'])){
    header('location: login.php');
    exit("Need to login to the system touse this function.");
}
*/
define('DB_SERVER', 'localhost');
define('DB_NAME', 'sm');
define('DB_USER', 'root');
define('DB_PASS', '');

BD::connect();

class bd
{
    public static $con;

    public static function connect()
    {
        BD::$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (!bd::$con) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            exit;
        }
        mysqli_set_charset(BD::$con, "utf8");
    }

    public static function cast_query_results($rs)
    {
        $fields = mysqli_fetch_fields($rs);
        $data = array();
        $types = array();
        foreach ($fields as $field) {
            switch ($field->type) {
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
        while ($row = mysqli_fetch_assoc($rs)) $data[] = $row;
        for ($i = 0; $i < count($data); $i++) {
            foreach ($types as $name => $type) {
                settype($data[$i][$name], $type);
            }
        }
        return $data;
    }
}

class login
{
    public static function in($user, $pass)
    {
        $sql = "SELECT * FROM usuario WHERE username = '" . $user . "'  AND password = '" . md5($pass) . "'";
        $usuarios = mysqli_query(bd::$con, $sql);
        if (mysqli_num_rows($usuarios) == 1) {
            $fila = mysqli_fetch_object($usuarios);
            $_SESSION['user'] = $fila->username;
            $_SESSION['tipo'] = $fila->tipo;
            $_SESSION['nombre'] = $fila->nombre;
            $_SESSION['apellido'] = $fila->apellido;

            log::set("IniciÃ³ sesiÃ³n");
            header('location: index.php');
        } else {
            msg::set("Credenciales inválidas");
        }
    }
}

class log
{

    static function set($text)
    {
        if (!isset(bd::$con)) log::bd();
        date_default_timezone_set('America/Montevideo');
        $registro = date("[d-m-Y H:i:s]") . " [" . $_SESSION['user'] . "] " . $text . '\n';
        $sql = "INSERT INTO `log` (`mes`, `registro`) VALUES ('" . date('m-Y') . "', '$registro') ON DUPLICATE KEY UPDATE registro=concat(registro, '$registro')";
        mysqli_query(bd::$con, $sql);
    }

    static function show()
    {
        $show = array();
        if (!isset(bd::$con)) log::bd();
        $sql = "SELECT mes FROM `log`";
        $resultado = mysqli_query(bd::$con, $sql);
        while ($temp = mysqli_fetch_object($resultado)) {
            $show[] = $temp->mes;
        }
        return $show;
    }

    static function download($mes)
    {
        $sql = "SELECT registro FROM `log` WHERE mes='" . $mes . "'";
        $resultado = mysqli_query(bd::$con, $sql);
        $contenido = mysqli_fetch_object($resultado);
        $contenido = $contenido->registro;
        $filename = 'log ' . $mes . '.txt';
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-disposition: attachment; filename=' . $filename);
        //header('Content-Length: '.mb_strlen($contenido));
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Cache-Control: must-revalidate');
        echo $contenido;
        log::set("DescargÃ³ " . $filename);

    }
}

class articulo
{
    static function idSubToId($subId){
        $sql = "SELECT id_articulo FROM subarticulo WHERE id=" . $subId;
        $resultado = mysqli_query(bd::$con, $sql);
        $resultado = mysqli_fetch_assoc($resultado);
        return $resultado['id_articulo'];
    }
    static function exists($id)
    {
        $sql = "SELECT count(*)AS count FROM articulo WHERE id=" . $id;
        $resultado = mysqli_query(bd::$con, $sql);
        $count = mysqli_fetch_assoc($resultado);
        return $count['count'] == 1;
    }

    static function toHtml($id){
        if ($json = json_decode(articulo::get($id), true)) {
            $i = 0;
            $letra = "a";
            $html = '<div id="datos-desc">';
            $img = '<div id="mini-imgs">';
            foreach ($json["subarticulos"] as $subarticulo) {
                $html = $html . '<div class="subGran" id="' . $letra . '">';
                $html = $html . '<h2 class="sep">' . ($subarticulo["codigo"] ? "#" . $subarticulo["codigo"] . " " : "") . (strcasecmp($subarticulo["distincion"], "no") == 0 ? $json["nombre"] . " " . $subarticulo["descripcion"] : $json["nombre"] . " " . $subarticulo["distincion"] . " " . $subarticulo["descripcion"]) . '</h2>';
                $html = $html . '<h4 class="sep">Categoría Principal: <span class="tag" style="background-color:lightgreen">' . $subarticulo["categoria"] . '</span></h4>';
                $html = $html . '<p  class="sep">by <a href="#">' . $json["proveedor"] . '</a><hr></p>';
                $html = $html . '<h3 class="sep" id="precio">Precio: <strong>$U' . $subarticulo["precio"] . '</strong></h3>';
                $html = $html . '<h4 class="sep">Stock: <strong style="color:' . ($subarticulo["stock"] > 0 ? 'green' : 'red') . ';">' . $subarticulo["stock"] . '</strong></h4>';
                $html = $html . '<h4 class="sep"><strong style="color:' . ($subarticulo["activo"] ? 'green' : 'red') . ';">' . ($subarticulo["activo"] ? 'ACTIVO' : 'NO ACTIVO') . '</strong></h4>';
                if (sizeof($subarticulo["tags"]) > 0) {//
                    $html = $html . '<div id="tags"><strong>TAGS:</strong>';
                    foreach ($subarticulo["tags"] as $tag) {
                        $html = $html . '<span class="tag">' . $tag['tag'] . '</span>';
                    }
                    $html = $html . "</div>";
                }

                if (sizeof($subarticulo["categorias"]) > 0) {//
                    $html = $html . '<div id="categorias" class="sep"><strong>Categorias:</strong>';
                    foreach ($subarticulo["categorias"] as $categoria) {
                        $html = $html . '<span class="tag">' . $categoria['nombre'] . '</span>';
                    }
                    $html = $html . "</div>";
                }


                $html = $html . '<p class="sep">' . $json["observaciones"] . '</p>';
                $html = $html . '</div>';
                $img = $img . '<div name="' . $i . '" class="subart"><img src="' . $subarticulo["imgpath"] . '"><font class="innerPrice">$U' . $subarticulo["precio"] . '</font></div>';
                $letra = chr(ord($letra) + 1);
                $i++;
            }
            $img = $img . '</div>';
            $html = $html . $img . '</div>';
            return $html;
        } else return null;
    }

    static function get($id)
    {
        $sql = "SELECT a.id, (SELECT razon_social FROM cliente WHERE id=a.proveedor) AS proveedor, a.nombre, a.observaciones FROM articulo as a WHERE a.id=" . $id;
        $resultado = mysqli_query(bd::$con, $sql);
        if ($articulo = bd::cast_query_results($resultado)[0]) {
            $sql = "SELECT *, (SELECT nombre FROM categoria WHERE id=s.id_categoria) AS categoria, (SELECT GROUP_CONCAT(`tag`) FROM `subarticulo_tag` WHERE `id_subarticulo` = s.id GROUP BY `id_subarticulo`) AS tags FROM subarticulo AS s WHERE s.id_articulo=" . $id;
            $resultado2 = mysqli_query(bd::$con, $sql);
            if ($subarticulos = bd::cast_query_results($resultado2)) {
                foreach ($subarticulos as $subarticulo) {
                    $sql = "SELECT id_categoria AS id, (SELECT nombre FROM categoria WHERE id=sc.id_categoria) AS nombre FROM subarticulo_categoria AS sc WHERE id_subarticulo=" . $subarticulo["id"];
                    $resultado3 = mysqli_query(bd::$con, $sql);
                    $subarticulo["categorias"] = bd::cast_query_results($resultado3);

                    $sql = "SELECT tag FROM subarticulo_tag WHERE id_subarticulo=" . $subarticulo["id"];
                    $resultado3 = mysqli_query(bd::$con, $sql);
                    $subarticulo["tags"] = bd::cast_query_results($resultado3);

                    $articulo["subarticulos"][] = $subarticulo;
                }
                return json_encode($articulo);
            } else $articulo = null;
        } else $articulo = null;
        return $articulo;
    }

    static function add($proveedor, $nombre, $observaciones, $cont, $subarticulos)
    {
        $sql = "INSERT INTO articulo (proveedor, nombre, observaciones) VALUES ('" . "1" . "','" . $nombre . "','" . $observaciones . "')";
        if (mysqli_query(bd::$con, $sql)) {
            echo $sql;
            $id_art = mysqli_insert_id(bd::$con);
            for ($i = 0; $i < $cont; $i++) {
                $subarticulo = $subarticulos[$i];
                $sql = "INSERT INTO subarticulo(id_articulo,codigo,id_categoria,activo,distincion,precio,stock,descripcion,imgpath)"
                    . "VALUES('" . $id_art . "','" . $subarticulo["codigo"] . "','" . $subarticulo["id_categoria"] . "','" . $subarticulo["activo"] . "','" . $subarticulo["distincion"]
                    . "','" . $subarticulo["precio"] . "','" . $subarticulo["stock"] . "','" . $subarticulo["descripcion"] . "','" . $subarticulo["path"] . "')";
                echo $sql;
                if (mysqli_query(bd::$con, $sql)) {
                    msg::set("Ingresado" + $i);
                    $_SESSION['sql' . $i] = "sii ".$sql;
                }else{
                    $_SESSION['sql' . $i] = "nooo ".$sql;
                }
            }
        } else {
            msg::set("Articulo no ingresado");
            var_dump($sql);
            echo $sql;
        }
    }
}

class user
{
    static function add($nombre, $apellido, $email, $username, $pass1, $pass2, $adm){
        $tipo = ($adm ? "ADM" : "USR");
        if (strnatcmp($pass1, $pass2) == 0) {
            $sql = "INSERT INTO `sm`.`usuario` (`username`, `tipo`, `password`, `nombre`, `apellido`, `email`) VALUES ('" . $username . "', '" . $tipo . "', '" . md5($pass1) . "', '" . $nombre . "', '" . $apellido . "', '$email');";
            if (mysqli_query(bd::$con, $sql)) {
                msg::set("[$tipo] $username agregado");
                log::set("AgregÃ³ a [$tipo] $username");
            } else msg::set("Usuario no agregado");
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

class msg
{
    static $msg = array();

    static function set($string)
    {
        self::$msg[] = $string;
    }

    static function get()
    {
        return implode("<br>", self::$msg);
    }
}

class categoria{
    static function get($id){
        $sql = "SELECT nombre FROM categoria WHERE id = '" . $id . "'";
        $row = mysqli_fetch_assoc(mysqli_query(bd::$con, $sql));
        return $row['nombre'];
    }

    static function getAll(){
        $sql = "SELECT * FROM `categoria`";
        if ($result = mysqli_query(bd::$con, $sql)) {
            $retorno = array();
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($retorno, array('id' => $row['id'], 'nombre' => $row['nombre']));
            }
            return $retorno;
        }else{
            return false;
        }
    }

}

?>