<?php
include_once 'C:\Users\Lucas\Dropbox\www\sm\include\clases.php';

$nombre = null;
$codigo = null;
$tags = null;
if (isset($_POST['s-nombre']) && !empty($_POST['s-nombre']))
    $nombre = mysqli_real_escape_string(bd::$con, $_POST['s-nombre']);
if (isset($_POST['s-codigo']) && !empty($_POST['s-codigo']))
    $codigo = mysqli_real_escape_string(bd::$con, $_POST['s-codigo']);
if (isset($_POST['s-tags']) && !empty($_POST['s-tags']))
    $tags = "'" . join("','", explode("|", mysqli_real_escape_string(bd::$con, $_POST['s-tags']))) . "'";
$precioMin = mysqli_real_escape_string(bd::$con, substr($_POST['precio-min'], 1));
$precioMax = mysqli_real_escape_string(bd::$con, substr($_POST['precio-max'], 1));
$ordenar = isset($_POST['ordenar']) ? mysqli_real_escape_string(bd::$con, $_POST['ordenar']) : 0;
$desde = isset($_POST['desde']) ? mysqli_real_escape_string(bd::$con, $_POST['desde']) : 0;
$hasta = isset($_POST['hasta']) ? mysqli_real_escape_string(bd::$con, $_POST['hasta']) : 10;
$inactivos = isset($_POST['inactivos'])&&$_POST['inactivos']=="si"?"1=1":"activo = 1";

switch ($ordenar) {
    case 0:
        $ordenar = "";
        break;
    case 1:
        $ordenar = "ORDER BY articulo.nombre DESC";
        break;
    case 2:
        $ordenar = "ORDER BY subarticulo.precio ASC";
        break;
    case 3:
        $ordenar = "ORDER BY subarticulo.precio DESC";
        break;
}

$sql = "SELECT subarticulo.id ,subarticulo.precio,articulo.nombre FROM subarticulo,articulo WHERE subarticulo.id IN (";
if (isset($nombre)) {
    $sql .= "SELECT subarticulo.id FROM subarticulo WHERE id_articulo IN (SELECT articulo.id FROM articulo WHERE nombre LIKE '%${nombre}%')";
}
if (isset($codigo) && isset($nombre)) {
    $sql .= " UNION SELECT subarticulo.id FROM `subarticulo` WHERE codigo LIKE '%${codigo}%'";
} elseif (isset($codigo)) {
    $sql .= " SELECT subarticulo.id FROM `subarticulo` WHERE codigo LIKE '%${codigo}%'";
}
if (isset($tags) && (isset($codigo) || isset($nombre))) {
    $sql .= " UNION SELECT DISTINCT id_subarticulo AS id FROM subarticulo_tag WHERE tag IN (${tags})";
} elseif (isset($tags)) {
    $sql .= " SELECT DISTINCT id_subarticulo AS id FROM subarticulo_tag WHERE tag IN (${tags})";
}
if (!(isset($tags) || isset($codigo) || isset($nombre))) {
    $sql = "SELECT subarticulo.id, subarticulo.precio,articulo.nombre FROM subarticulo,articulo WHERE precio BETWEEN ${precioMin} AND ${precioMax}".
        " AND subarticulo.id_articulo = articulo.id AND ${inactivos} ${ordenar} LIMIT ${desde}, ${hasta}";
} else {
    $sql .= ") AND precio BETWEEN ${precioMin} AND ${precioMax} AND ${inactivos} AND subarticulo.id_articulo = articulo.id ${ordenar} LIMIT ${desde}, ${hasta}";
}

if ($result = mysqli_query(bd::$con, $sql)) {
    $retorno = array(array("busqueda" => array('s-nombre' => $nombre, 's-codigo' => $codigo, 's-tags' => $_POST['s-tags']
    , 'precio-min' => "$" . $precioMin, 'precio-max' => "$" . $precioMax, 'activo' => 1, 'desde' => $desde,
        'hasta' => $hasta,'query'=> $sql, 'ordenar' => $ordenar, 'inactivos'=>$_POST['inactivos']) ) );
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $sql = "SELECT articulo.nombre,subarticulo.* FROM subarticulo, articulo WHERE subarticulo.id_articulo = articulo.id".
            " AND subarticulo.id=${id} ${ordenar}";
        $row = mysqli_fetch_assoc(mysqli_query(bd::$con, $sql));
        array_push($retorno, array('id' => $row['id'], 'nombre' => $row['nombre'], 'codigo' => $row['codigo']
        , 'distincion' => $row['descripcion'], 'precio' => $row['precio'], 'path' => $row['imgpath']) );
    }
    $_SESSION['data'] = json_encode($retorno);
    echo json_encode($retorno);
} else {
    echo "Error en query" ;
}
