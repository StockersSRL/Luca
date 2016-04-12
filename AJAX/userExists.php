<?php
session_start();
if(!isset($_SESSION["user"]))
    exit();
header("Content-type: text/json");
require "include/clases.php";

$sql = 'SELECT count(*) as cuenta FROM `usuario` WHERE `username` = "'.$_POST['q'].'"';

$resultado=mysqli_query(bd::$con, $sql);

$fila=mysqli_fetch_object($resultado);

echo json_encode($fila->cuenta > 0);