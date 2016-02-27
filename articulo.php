<?php
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

session_start(); 
if(!isset($_SESSION['user']))
    header('location: login.php');
require 'include/clases.php';
if(false){
if(!(isset($_GET["id"]) && $articulo=articulo::get($_GET["id"])))
        exit();//ARTICULO NO EXISTE
var_dump($articulo);
exit();
}
?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-1.11.1.min.js"></script>
    <meta name="viewport" content="width=device-width">
<!---<script src="https://code.jquery.com/jquery-1.10.2.js"></script>--->
     <script src="js/functions.js"></script>
     <script src="js/colors.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/perfilArt.js"></script>

    <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
        
        <link href="css/estilo.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/perfilArt.css" rel="stylesheet" type="text/css" media="all" />
            <title>[StockMGR]</title>
<link rel="icon" 
      type="image/png" 
      href="images/fav.png" />
</head>
<body>
          
<?php
include 'header.php';
?>
    <!--Nombre--codigo y/o id*, proveedor*, precio*, cantidad de stock*, descripcion*, categoria, tags -->
    <div id="wrapper">
        <div id="edit"><a href="#"><img id="ed" src="images/edit.svg" width="100px" height="37px" style="float: right; display:block; margin: 10px;"></a></div>
        <div id="img-desc" style="float:left;width:40%;">
            <img id="grande" src="images/canilla2.jpg" style="float:left;width:100%;margin-right: 30px;">
        </div>
<?php
if(!(isset($_GET["id"]) && $articulo=articulo::toHtml($_GET["id"])))
        exit();//ARTICULO NO EXISTE
echo $articulo;
?>
    </div>    
<script>
elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
    <div id="scrollup" style="z-index:8; position:fixed; bottom:0%; float:right;"><img src="images/up.svg" width="50px"/></div>
</body>

    <script type="text/javascript" src="js/bootstrap.js"></script>
    
</html>