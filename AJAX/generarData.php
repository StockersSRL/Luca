<?php
//query posible para articulo
/*select distinct a.nombre
from articulo a, cliente c, subarticulo s
where c.id = a.proveedor
and c.es_cliente = 0
and a.nombre like '%tub%'
or (s.id_articulo = a.id and s.codigo like '%tub%')
order by a.id asc*/

session_start();
if(!isset($_SESSION["user"]))
    exit();
header("Content-type: text/json");
require "../include/clases.php";

	$queryArg = $_GET['term'];
    $queryCat = mysqli_query(bd::$con, "SELECT `nombre` FROM `categoria` WHERE `nombre` LIKE '%". $queryArg ."%'"); 
	$queryCli = mysqli_query(bd::$con, "Select `nombre` FROM `cliente` WHERE `nombre` LIKE '%". $queryArg ."%' AND `es_cliente` = 1");
	$queryArt = mysqli_query(bd::$con, "SELECT `nombre` FROM `articulo` WHERE `nombre` LIKE '%". $queryArg ."%'");
	$querySubArt = mysqli_query(bd::$con, "SELECT subarticulo.codigo 
                                FROM subarticulo, articulo 
                                WHERE articulo.id = subarticulo.id_articulo 
                                AND articulo.nombre LIKE '%". trim($queryArg) ."%'");
    $contador = 0;
    while($row=mysqli_fetch_array($queryCat)){ 
         $data[$contador]=array("label" => utf8_encode($row['nombre']), "category" => "Categorias");
         $contador++;
    }
	while($row=mysqli_fetch_array($queryCli)){ 
         $data[$contador]=array("label" => utf8_encode($row['nombre']), "category" => "Clientes");
         $contador++;
    }
	while($row=mysqli_fetch_array($queryArt)){ 
         $data[$contador]=array("label" => utf8_encode($row['nombre']), "category" => "Artículos");
         $contador++;
    }
	while($row=mysqli_fetch_array($querySubArt)){ 
         $data[$contador]=array("label" => utf8_encode($row['0']), "category" => "SubArtículos");
         $contador++;
    }
    echo json_encode($data);
?>