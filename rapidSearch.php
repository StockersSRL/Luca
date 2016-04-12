<?php
session_start(); 
if(!isset($_SESSION['user']))
    header('location: login.php');

require_once 'include/clases.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/colors.js"></script>
    <script>
        var consulta = "<?php echo (isset($_POST['busqueda']) ? $_POST['busqueda'] : ""); ?>";
    </script>
    <script src="js/busquedaRapida.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        $.widget("custom.catcomplete", $.ui.autocomplete, {
            _create: function () {
                this._super();
                this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
            },
            _renderMenu: function (ul, items) {
                var that = this,
                    currentCategory = "";
                $.each(items, function (index, item) {
                    var li;
                    if (item.category != currentCategory) {
                        ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
                        currentCategory = item.category;
                    }
                    li = that._renderItemData(ul, item);
                    if (item.category) {
                        li.attr("aria-label", item.category + " : " + item.label);
                    }
                });
            }
        });

    </script>
    <script>
        $(function () {
            $("#busqueda").catcomplete({
                delay: 0,
                source: function (request, response) {
                    $.getJSON("AJAX/generarData.php", request, response);
                }
            });
        });
    </script>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/busquedaRapida.css" rel="stylesheet" type="text/css" media="all"/>

    <title>[StockMGR]</title>
    <link rel="icon"
          type="image/png"
          href="images/fav.png"/>
</head>
<body class="noselect">

<?php include 'include/header.php'; ?>

<div id="content">
    <div id="searchBar">
        <form method="post" action="rapidSearch.php" id="searchform">
            <label for="buscador">Panel de búsqueda rápida:</label> <input id="busqueda" type="text" name="busqueda"/>
            <input type="submit" name="submit" value="Buscar">
        </form>
    </div>
    <div class="descriptionTitle">
        <div class="titleAction">Clientes</div>
        <div class="descriptionContent">
            <div id="cliUnder">
            <?php
            if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                $queryCli = mysqli_query(bd::$con, "select nombre, mail, ruc, razon_social 
                         from cliente
                         where nombre like '%" . mysqli_real_escape_string(bd::$con, trim($_POST['busqueda'])) . "%'
                         and cliente.es_cliente = 1
                         limit 11
                         ");
                $contadorCli = 0;
                while ($row = @mysqli_fetch_array($queryCli)) {
                    $nombre[$contadorCli] = utf8_encode($row['nombre']);
                    $mail[$contadorCli] = utf8_encode($row['mail']);
                    $ruc[$contadorCli] = utf8_encode($row['ruc']);
                    $razon_social[$contadorCli] = utf8_encode($row['razon_social']);
                    $contadorCli++;
                }
                if ($contadorCli > 0) {
                    echo '<table style="width:100%;" class="result">';
                    echo '<tr><td><strong>Nombre</strong></td>' .
                        '<td><strong>E-mail</strong></td>' .
                        '<td><strong>RUT</strong></td>' .
                        '<td><strong>Razón Social</strong></td></tr>';
                }
                for ($i = 0; $i < $contadorCli; $i++) {
                    if($i<10) {
                        echo "<tr>";
                        echo "<td>" . $nombre[$i] . "</td>";
                        echo "<td>" . $mail[$i] . "</td>";
                        echo "<td>" . $ruc[$i] . "</td>";
                        echo "<td>" . $razon_social[$i] . "</td>";
                        echo "</tr>";
                    }
                }
                if ($contadorCli > 0) echo "</table>";
                echo "</div>";
                if ($contadorCli == 11) {
                    $contadorCli--;
                    $paginas = intval(($contadorCli / 10) + 1);
                    echo '<div class="paginas">';
                    for ($i = 1; $i <= $paginas; $i++) {
                        if ($paginas > 1) echo "<span name=" . "cat" . $i . " class='pag'>" . ($i) . "</span>";
                    }
                    echo "</div>";
                }
                if ($contadorCli == 0) echo "<p>No hay resultados.</p>";
            } else {
                echo "<p>No hay resultados.</p>";
            }

            ?>
        </div>
    </div>
    <div class="descriptionTitle">
        <div class="titleAction">Artículos</div>
        <div class="descriptionContent">
            <div class="descriptionUnderTitle">
                <div class="underTitleAction">Artículos</div>
                <div class="descriptionUnderContent">
                    <div id="artUnder">
                        <?php
                        if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                            $query = mysqli_query(bd::$con, "
                                select articulo.id, cliente.nombre, articulo.nombre 
                                from articulo, cliente 
                                where cliente.id = articulo.proveedor 
                                and cliente.es_cliente = 0 
                                and articulo.nombre like '%" . mysqli_real_escape_string(bd::$con, trim($_POST['busqueda'])) . "%'
                                order by articulo.id asc
                                limit 11
                            ");
                            $contador = 0;
                            while ($row = @mysqli_fetch_array($query)) {
                                $id[$contador] = utf8_encode($row['id']);
                                $proveedor[$contador] = utf8_encode($row['1']);
                                $articulo[$contador] = utf8_encode($row['2']);
                                $contador++;
                            }
                            if ($contador > 0) {
                                echo '<table style="width:100%;" class="result">';
                                echo '<tr><td><strong>ID Artículo</strong></td>' .
                                    '<td><strong>Proveedor</strong></td>' .
                                    '<td><strong>Artículo</strong></td></tr>';
                            }
                            for ($i = 0; $i < $contador; $i++) {
                                if ($i < 10) {
                                    echo "<tr>";
                                    echo "<td>" . $id[$i] . "</td>";
                                    echo "<td>" . $proveedor[$i] . "</td>";
                                    echo "<td>" . $articulo[$i] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            if ($contador > 0) echo "</table>";
                            echo "</div>";
                            if ($contador == 11) {
                                $contador--;
                                $paginas = intval(($contador / 10) + 1);
                                echo '<div class="paginas">';
                                for ($i = 1; $i <= $paginas; $i++) {
                                    if ($paginas > 1) echo "<span name=" . "cat" . $i . " class='pag'>" . ($i) . "</span>";
                                }
                                echo "</div>";
                            }
                        }
                        if (isset($_POST['submit']) && !empty($_POST['submit'])) {

                            if ($contador == 0) echo "<p>No hay resultados.</p>";
                        } else {
                            echo "<p>No hay resultados.</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="descriptionUnderTitle">
                    <div class="underTitleAction">Subartículos</div>
                    <div class="descriptionUnderContent">
                        <div id="subArtUnder">
                            <?php
                            if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                                $query = mysqli_query(bd::$con, "
                                select subarticulo.id, articulo.nombre, subarticulo.precio, subarticulo.stock, subarticulo.codigo
                                from articulo, subarticulo
                                where subarticulo.id_articulo = articulo.id
                                and subarticulo.activo = 1
                                and (subarticulo.codigo like '%" . mysqli_real_escape_string(bd::$con, trim($_POST['busqueda'])) . "%' 
                                or articulo.nombre like '%" . mysqli_real_escape_string(bd::$con, trim($_POST['busqueda'])) . "%')
                                order by subarticulo.id asc
                                limit 11
                                ");
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
                                    echo '<table style="width:100%;" class="result">';
                                    echo '<tr><td><strong>ID Sub-Artículo</strong></td>' .
                                        '<td><strong>Nombre de Artículo</strong></td>' .
                                        '<td><strong>Precio</strong></td>' .
                                        '<td><strong>Stock</strong></td>' .
                                        '<td><strong>Código</strong></td></tr>';
                                }
                                for ($i = 0; $i < $contador; $i++) {
                                    if ($i < 10) {
                                        echo "<tr>";
                                        echo "<td>" . $id[$i] . "</td>";
                                        echo "<td>" . $articulo[$i] . "</td>";
                                        echo "<td>" . $precio[$i] . "</td>";
                                        echo "<td>" . $stock[$i] . "</td>";
                                        echo "<td>" . $codigo[$i] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                if ($contador > 0) echo "</table>";

                            }
                            echo "</div>";
                            if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                                if ($contador == 11) {
                                    $contador--;
                                    $paginas = intval(($contador / 10) + 1);
                                    echo '<div class="paginas">';
                                    for ($i = 1; $i <= $paginas; $i++) {
                                        if ($paginas > 1) echo "<span name=" . "cat" . $i . " class='pag'>" . ($i) . "</span>";
                                    }
                                    echo '</div>';
                                }
                                if ($contador == 0) echo "<p>No hay resultados.</p>";
                            } else {
                                echo "<p>No hay resultados.</p>";
                            }

                            ?>
                        </div>
                    </div>
                    <div class="descriptionUnderTitle">
                        <div class="underTitleAction">Categorías</div>
                        <div class="descriptionUnderContent">
                            <div id="catUnder">
                                <?php
                                if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                                    $query = mysqli_query(bd::$con, "
                                            SELECT `id`, `nombre`
                                            FROM `categoria`
                                            WHERE `nombre`
                                            LIKE '%" . mysqli_real_escape_string(bd::$con, trim($_POST['busqueda'])) . "%'
                                            ORDER BY `id` ASC
                                            limit 11
                                            ");
                                    $contador = 0;

                                    while ($row = mysqli_fetch_array($query)) {
                                        $id[$contador] = utf8_encode($row['id']);
                                        $nombre[$contador] = utf8_encode($row['nombre']);

                                        $contador++;
                                    }
                                    if ($contador > 0) {
                                        echo '<table style="width:100%;" class="result">';
                                        echo '<tr><td><strong>ID</strong></td>' .
                                            '<td><strong>Categoría</strong></td></tr>';
                                    }
                                    for ($i = 0; $i < $contador; $i++) {
                                        if ($i < 10) {
                                            echo "<tr>";
                                            echo "<td>" . $id[$i] . "</td>";
                                            echo "<td>" . $nombre[$i] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    if ($contador > 0) echo "</table>";
                                }
                                echo "</div>";
                                if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                                    if ($contador == 11) {
                                        $contador--;
                                        $paginas = intval(($contador / 10) + 1);
                                        echo '<div class="paginas">';
                                        for ($i = 1; $i <= $paginas; $i++) {
                                            if ($paginas > 1) echo "<span name=" . "cat" . $i . " class='pag'>" . ($i) . "</span>";
                                        }
                                        echo '</div>';
                                    }
                                    if ($contador == 0) echo "<p>No hay resultados.</p>";
                                } else {
                                    echo "<p>No hay resultados.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
               <?php if(!isset($_POST['submit'])) echo "</div>"; ?>
                <div class="descriptionTitle" id="ultimo">
                    <div class="titleAction">Facturas</div>
                    <div class="descriptionContent">
                        <p>No hay resultados.</p>
                    </div>
                </div>
            </div>
            <div id="scrollup" style="z-index:8; position:fixed; bottom:0%; float:right;"><img src="images/up.svg"
                                                                                               width="50px"
                                                                                               style="opacity:.92;"/>
            </div>
</body>
</html>