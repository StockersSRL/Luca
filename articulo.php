<?php
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

session_start(); 
if(!isset($_SESSION['user']))
    header('location: login.php');
require 'include/clases.php';
if(true){
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
            <img id="grande" src="images/canilla.png" style="float:left;width:100%;margin-right: 30px;">
        </div>
        
        <div id="datos-desc">
            <div class="subGran" id="a">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$123.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. Integer posuere augue ac arcu convallis laoreet. Suspendisse ex massa, lacinia quis condimentum sed, cursus ac lacus. Integer lorem justo, cursus quis dapibus laoreet, ornare imperdiet odio. Cras et nisi sit amet nisi euismod tincidunt vitae eu nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vel est fringilla, pretium risus eu, facilisis lectus. </p>
            </div>
                    <div class="subGran" id="b">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$124.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. Integer posuere augue ac arcu convallis laoreet. Suspendisse ex massa, lacinia quis condimentum sed, cursus ac lacus. Integer lorem justo, cursus quis dapibus laoreet, ornare imperdiet odio. Cras et nisi sit amet nisi euismod tincidunt vitae eu nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vel est fringilla, pretium risus eu, facilisis lectus. </p>
            </div>
                <div class="subGran" id="c">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$125.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. Integer posuere augue ac arcu convallis laoreet. Suspendisse ex massa, lacinia quis condimentum sed, cursus ac lacus. Integer lorem justo, cursus quis dapibus laoreet, ornare imperdiet odio. Cras et nisi sit amet nisi euismod tincidunt vitae eu nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vel est fringilla, pretium risus eu, facilisis lectus. </p>
            </div>
                <div class="subGran" id="d">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$126.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. Integer posuere augue ac arcu convallis laoreet. Suspendisse ex massa, lacinia quis condimentum sed, cursus ac lacus. Integer lorem justo, cursus quis dapibus laoreet, ornare imperdiet odio. Cras et nisi sit amet nisi euismod tincidunt vitae eu nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vel est fringilla, pretium risus eu, facilisis lectus. </p>
            </div>
                <div class="subGran" id="e">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$127.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. Integer posuere augue ac arcu convallis laoreet. Suspendisse ex massa, lacinia quis condimentum sed, cursus ac lacus. Integer lorem justo, cursus quis dapibus laoreet, ornare imperdiet odio. Cras et nisi sit amet nisi euismod tincidunt vitae eu nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vel est fringilla, pretium risus eu, facilisis lectus. </p>
            </div>
            <div id="mini-imgs">
                <div name="0" class="subart"><img src="images/canilla1.jpg"></div>
                <div name="1" class="subart"><img src="images/canilla2.jpg"></div>
                <div name="2" class="subart"><img src="images/canilla3.jpg"></div>
                <div name="3" class="subart"><img src="images/canilla1.jpg"></div>
                                <div name="4" class="subart"><img src="images/canilla1.jpg"></div>
            </div>
        </div>
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