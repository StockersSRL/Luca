<?php
session_start();
if(!isset($_SESSION["user"]))
    exit();
header("Content-type: text/json");
require "include/clases.php";

if (isset($_POST['tipo'])) {
    switch ($_POST['tipo']) {
        case "Categorías":
            if (isset($_POST['keyWord'])) {
                if (isset($_POST['id'])) {
                    $pagina = $_POST['id'];
                }

                $query = mysqli_query(bd::$con, "
                                            SELECT `id`, `nombre`
                                            FROM `categoria`
                                            WHERE `nombre`
                                            LIKE '%" . mysqli_real_escape_string(bd::$con, trim($_POST['keyWord'])) . "%'
                                            ORDER BY `id` ASC
                                            LIMIT " . (($pagina * 10) - 10) . ", " . ($pagina * 10) . "
                                            ");
                $contador = 0;
                $retorno = "";
                while ($row = @mysqli_fetch_array($query)) {
                    $id[$contador] = utf8_encode($row['id']);
                    $nombre[$contador] = utf8_encode($row['nombre']);
                    $contador++;
                }
                if ($contador > 0) {
                    $retorno .= '<table style="width:100%;" class="result">';
                    $retorno .= '<tr><td><strong>ID</strong></td>' .
                        '<td><strong>Categoría</strong></td></tr>';
                }
                for ($i = 0; $i < $contador; $i++) {
                    if ($i < 10) {
                        $retorno .= "<tr>";
                        $retorno .= "<td>" . $id[$i] . "</td>";
                        $retorno .= "<td>" . $nombre[$i] . "</td>";
                        $retorno .= "</tr>";
                    }
                }
                if ($contador > 0) $retorno .= "</table>";
                $retorno .= "</div>";
                echo $retorno;
            }
            break;
        case "Artículos":
            if (isset($_POST['keyWord'])) {
                if (isset($_POST['id'])) {
                    $pagina = $_POST['id'];
                }
                $query = mysqli_query(bd::$con, "
                                select articulo.id, cliente.nombre, articulo.nombre 
                                from articulo, cliente 
                                where cliente.id = articulo.proveedor 
                                and cliente.es_cliente = 0 
                                and articulo.nombre like '%" . mysqli_real_escape_string(bd::$con, trim($_POST['keyWord'])) . "%'
                                order by articulo.id asc
                                limit " . (($pagina * 10) - 10) . ", " . ($pagina * 10) . "
                            ");
                $contador = 0;
                $retorno = "";
                while ($row = @mysqli_fetch_array($query)) {
                    $id[$contador] = utf8_encode($row['id']);
                    $proveedor[$contador] = utf8_encode($row['1']);
                    $articulo[$contador] = utf8_encode($row['2']);
                    $contador++;
                }
                if ($contador > 0) {
                    $retorno .= '<table style="width:100%;" class="result">';
                    $retorno .= '<tr><td><strong>ID Artículo</strong></td>' .
                        '<td><strong>Proveedor</strong></td>' .
                        '<td><strong>Artículo</strong></td></tr>';
                }
                for ($i = 0; $i < $contador; $i++) {
                    $retorno .= "<tr>";
                    $retorno .= "<td>" . $id[$i] . "</td>";
                    $retorno .= "<td>" . $proveedor[$i] . "</td>";
                    $retorno .= "<td>" . $articulo[$i] . "</td>";
                    $retorno .= "</tr>";
                }
                if ($contador > 0) echo "</table>";
                $retorno .= "</div>";
                echo $retorno;
            }
            break;
        case "Subartículos":
            if (isset($_POST['keyWord'])) {
                if (isset($_POST['id'])) {
                    $pagina = $_POST['id'];
                }
                $query = mysqli_query(bd::$con, "
                                select subarticulo.id, articulo.nombre, subarticulo.precio, subarticulo.stock, subarticulo.codigo
                                from articulo, subarticulo
                                where subarticulo.id_articulo = articulo.id
                                and subarticulo.activo = 1
                                and (subarticulo.codigo like '%" . mysqli_real_escape_string(bd::$con, trim($_POST['keyWord'])) . "%' 
                                or articulo.nombre like '%" . mysqli_real_escape_string(bd::$con, trim($_POST['keyWord'])) . "%')
                                order by subarticulo.id asc
                                limit " . (($pagina * 10) - 10) . ", " . ($pagina * 10) . "
                                ");
                $retorno = "";
                $contador = 0;
                while ($row = @mysqli_fetch_array($query)) {
                    $id[$contador] = utf8_encode($row['0']);
                    $articulo[$contador] = utf8_encode($row['1']);
                    $precio[$contador] = utf8_encode($row['2']);
                    $stock[$contador] = utf8_encode($row['3']);
                    $codigo[$contador] = utf8_encode($row['4']);
                    $contador++;
                }
                if ($contador > 0) {
                    $retorno .= '<table style="width:100%;" class="result">';
                    $retorno .= '<tr><td><strong>ID Sub-Artículo</strong></td>' .
                        '<td><strong>Nombre de Artículo</strong></td>' .
                        '<td><strong>Precio</strong></td>' .
                        '<td><strong>Stock</strong></td>' .
                        '<td><strong>Código</strong></td></tr>';
                }
                for ($i = 0; $i < $contador; $i++) {
                    $retorno .= "<tr>";
                    $retorno .= "<td>" . $id[$i] . "</td>";
                    $retorno .= "<td>" . $articulo[$i] . "</td>";
                    $retorno .= "<td>" . $precio[$i] . "</td>";
                    $retorno .= "<td>" . $stock[$i] . "</td>";
                    $retorno .= "<td>" . $codigo[$i] . "</td>";
                    $retorno .= "</tr>";
                }
                if ($contador > 0) $retorno .= "</table>";
                echo $retorno;
            }
            break;
        case "Clientes":
            if (isset($_POST['keyWord'])) {
                if (isset($_POST['id'])) {
                    $pagina = $_POST['id'];
                }
                $queryCli = mysqli_query(bd::$con, "select nombre, mail, ruc, razon_social 
                         from cliente
                         where cliente.es_cliente = 1
                         and cliente.nombre like '%". mysqli_real_escape_string(bd::$con, trim($_POST['keyWord'])) ."%'
                         limit " . (($pagina * 10) - 10) . ", " . ($pagina * 10) . "
                         ");
                $retorno = "";
                $contadorCli = 0;
                while ($row = @mysqli_fetch_array($queryCli)) {
                    $nombre[$contadorCli] = utf8_encode($row['nombre']);
                    $mail[$contadorCli] = utf8_encode($row['mail']);
                    $ruc[$contadorCli] = utf8_encode($row['ruc']);
                    $razon_social[$contadorCli] = utf8_encode($row['razon_social']);
                    $contadorCli++;
                }
                if ($contadorCli > 0) {
                    $retorno .= '<table style="width:100%;" class="result">';
                    $retorno .= '<tr><td><strong>Nombre</strong></td>' .
                        '<td><strong>E-mail</strong></td>' .
                        '<td><strong>RUT</strong></td>' .
                        '<td><strong>Razón Social</strong></td></tr>';
                }
                for ($i = 0; $i < $contadorCli; $i++) {
                    if ($i < 10) {
                        $retorno .= "<tr>";
                        $retorno .= "<td>" . $nombre[$i] . "</td>";
                        $retorno .= "<td>" . $mail[$i] . "</td>";
                        $retorno .= "<td>" . $ruc[$i] . "</td>";
                        $retorno .= "<td>" . $razon_social[$i] . "</td>";
                        $retorno .= "</tr>";
                    }
                }
                if ($contadorCli > 0) $retorno .= "</table>";
                echo $retorno;
            }
            break;
        default:
            echo "ERROR";
            break;
    }
}
?>