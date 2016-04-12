<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width">
<script src="js/jquery-1.11.1.min.js"></script>
<!---<script src="https://code.jquery.com/jquery-1.10.2.js"></script>--->
     <script src="js/functions.js"></script>
     <script src="js/colors.js"></script>
    <script src="js/home.js"></script>
    
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/home.css" rel="stylesheet" type="text/css" media="all" />
    
<title>[StockMGR]</title>
<link rel="icon" 
      type="image/png" 
      href="images/fav.png" />
</head>
<body class="noselect">
          
<?php
include "include/header.php";
?>
    
    <div id="content">
        <a href="alta_articulo.php">
        <div class="homeButton">
            
                <img class="hicon" src="images/home/addArt.svg">
            
            <p class="HBscript"><strong>Agregar Artículo</strong></p>
        </div>
            </a>
        <a href="alta_usuario.php">
        <div class="homeButton">
                <img class="hicon" src="images/home/addUsr.svg">
            <p class="HBscript"><strong>Agregar Usuario</strong></p>
        </div></a>
        <div class="homeButton">
            <a href="#">
                <img class="hicon" src="images/home/configUsr.svg">
            </a>
            <p class="HBscript"><strong>Configurar Usuario</strong></p>
        </div>
        <div class="homeButton">
            <a href="#">
                <img class="hicon" src="images/home/factura.svg">
            </a>
            <p class="HBscript"><strong>Realizar Factura</strong></p>
        </div>
        <div class="homeButton">
            <a href="#">
                <img class="hicon" src="images/home/log.svg">
            </a>
            <p class="HBscript"><strong>Ver registros de<br> actividad</strong></p>
        </div>
        <a href="busqueda.php">
        <div class="homeButton">
                <img class="hicon" src="images/home/searchArt.svg">
            <p class="HBscript"><strong>Buscar Artículo</strong></p>
        </div></a>

        <div class="homeButton">
            <a href="#">
                <img class="hicon" src="images/proveedor.svg">
            </a>
            <p class="HBscript"><strong>Agregar proveedor</strong></p>
        </div>
        <a href="pdf/catalogo.php">
        <div class="homeButton">
                <img class="hicon" src="images/home/log.svg">
            
            <p class="HBscript"><strong>Catalogo PDF</strong></p>
        </div>
        </a>
    </div>
    <div id="scrollup" style="z-index:8; position:fixed; bottom:0%; float:right;"><img src="images/up.svg" width="50px" style="opacity:.92;"/></div>
</body>
</html>