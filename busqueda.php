<?php
session_start();
if (isset($_POST['submit'])) {
    ob_start();
    include_once 'AJAX/busqueda.php';
    ob_end_clean();
}
?>

<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width">
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/funcionesBusqueda.js"></script>
    <script src="js/colors.js"></script>
    <script src="js/switchery.min.js"></script>


    <script src="js/functions.js"></script>
    <script src="js/colors.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
    <link href="css/estilo.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all"/>


    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

    <title>[StockMGR]</title>
    <link rel="icon"
          type="image/png"
          href="images/fav.png"/>
</head>
<body class="noselect azul">
<script>
    var busqueda = [];
    <?php
    if (isset($_SESSION['data']) && !empty($_SESSION['data'])) {
        echo "busqueda =".$_SESSION['data'].";";
        unset($_SESSION['data']);
    }
    ?>
</script>
<?php
require "include/header.php"; 
?>

<span id="imp-busqueda"><img src="images/print.svg"></span>

<div id="wrapper">


    <!--        Busqueda-->
    <!--        agregar checkbox de activo o todos::hecho, rango de precio-->
    <form id="busquedaArt" method="post" action="">
        <div id="busqueda-box">
            <h2>Buscar artículo:</h2><br>
            <input type="text" name="s-nombre" id="s-nombre" placeholder="Nombre" tabindex="1">
            <div id="suggestName" style="display:none;">
            </div>
            <input type="text" name="s-codigo" id="s-codigo" placeholder="Código" tabindex="2">
            <input type="text" name="s-tags" id="s-tags" placeholder="Tags" tabindex="3" style="display: none">
            <label for="input-box">
                <div id="fake-input" class="fake-input"><input id="input-box" class="input-box" name="tags"
                                                               placeholder="Tags" style="margin-top: 0px;
                            padding-top: 0px;margin-left:0px;padding-left:0px;width:100%;" autocomplete="off"
                                                               type="text">
                </div>
            </label>

            <div>Rango de precio</div>
            <div id="slider">
                <input id="slider-min" name="precio-min" tabindex="4">
                <div>

                </div>
                <input id="slider-max" name="precio-max" tabindex="5">
            </div>
            <div><span id="texto-switch-busqueda">Buscar inactivos también</span><input class="js-switch"
                                                                                        type="checkbox" name="inactivos" value="si"></div>
        </div>
        <button id="submit" class="btn btn-primary" type="submit" name="submit" tabindex="6">Buscar</button>
    </form>

    <div id="give-order">
        <select id="orden-check">
            <option value="0">Alfabético: a-z</option>
            <option value="1">Alfabético: z-a</option>
            <option value="2">Precio: bajo-alto</option>
            <option value="3">Precio: alto-bajo</option>
        </select>
    </div>

    <div id="resultados"/>

</div>

<div id="scrollup" style="z-index:8; position:fixed; bottom:0%; float:right;"><img src="images/up.svg" width="30px"/>
</div>
</body>

</html>