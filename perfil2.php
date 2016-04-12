<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!----sfddsfds-->
<script src="js/jquery-1.11.1.min.js"></script>
    <meta name="viewport" content="width=device-width">
<!---<script src="https://code.jquery.com/jquery-1.10.2.js"></script>--->
     <script src="js/functions.js"></script>
     <script src="js/colors.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/perfilArt.js"></script>
    <script>
            
            $(document).ready(function(){
                if(!doesExist($('.subart[name=1]'))){
                    $('#mini-imgs').hide();
                }
                selectArt('[name=2]'); //en esta linea se selecciona el primero que aparece
                $(".subGran").hide();
                $('#a').show();
                $('.subart').mouseover(function(){
                    selectArt('[name='+$(this).attr("name")+']');
                });
            });
    
    </script>

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
          
	<div id="header">
        <a id="nav-toggle" href="#"><span></span></a>
        <center>
           <img id="limage" src="images/sto.svg" height="65px" style="margin-top: 15px; position:static; max-width: 425px;"/>
        </center>
       
                <img id="plus" src="images/plus.svg" width="40px" height="40px" style="float:right"/>
       <div id="searchc">   
           <div id="menuplustri"></div>
            <div id="menuplus"></div>
           <img id="lupa" class="slide" src="images/lupa.svg" height="45px" width="45px" style="z-index:5;"/>
           <img id="usr" class="slide" src="images/usr.svg" height="45px" width="45px" style="float:right; margin-right:10px; z-index:5;"/>
           <img id="co" class="slide" src="images/config.svg" height="45px" width="45px" style="float:right; margin-right:10px;z-index:5;"/>
       </div>
       <div id="nombre" style="z-index: 8; margin-left: 35px; position: relative; top:-25px; width:200px;">
             <table id="client" cellspacing="10px" cellpadding="5px">
                  <tr>
                      <td style="border-left: solid 3px #545557; padding: 5px; border-bottom: solid 3px #545557"><strong> Marcos, Sysadmin </strong></td>
                  </tr>
                  <tr>
                      <td style="border-left: solid 3px #545557; padding: 5px;border-top: solid 3px #545557"><strong>Talmet</strong></td>
                  </tr>
                </table>
        </div>
       
    </div>

    <div id="subheader" class="noselect">
        <img id="logo2" src="images/line.svg" height="25px" style="margin-top: 12.5px; float: left; margin-left: 10px;"/>
            <ul id="menu">
                <strong>
                <a><li id="1" class="sizable" style="border-top: thick solid #5F64B7;">Principal
                            <ul id="listaInt1">
                                <li class="li1">Elemento 1</li>
                                <li class="li1">Elemento 2</li>
                            </ul>
                    </li></a>
                <div class="borde"></div>
                <a><li id="2" class="sizable" style="border-top: thick solid #68B4FA; ">Clientes
                            <ul id="listaInt2">
                                <li class="li2">Elemento1</li>
                                <li class="li2">Elemento2</li>
                            </ul>
                    </li></a>
                <div class="borde"></div>
                <a><li id="3" class="sizable" style="border-top: thick solid #C53139;">Usuarios
                            <ul id="listaInt3">
                                <li class="li3">Elemento1</li>
                                <li class="li3">Elemento2</li>
                            </ul>
                    </li></a>
                <div class="borde"></div>
                <a><li id="4" class="sizable" style="border-top: thick solid green;">Artículos
                            <ul id="listaInt4">
                                <li class="li4">Elemento1</li>
                                <li class="li4">Elemento2</li>
                            </ul>
                    </li></a>
                <div class="borde"></div>
                <a><li id="5" class="sizable" style="border-top: thick solid #EF8B13;">Estadísticas
                            <ul id="listaInt5">
                                <li class="li5">Elemento1</li>
                                <li class="li5">Elemento2</li>
                            </ul>
                    </li></a>
                <div class="borde"></div>
                <a><li id="6" class="sizable" style="border-top: thick solid #52206E;">Facturas
                            <ul id="listaInt6">
                                <li class="li6">Elemento1</li>
                                <li class="li6">Elemento2</li>
                            </ul>
                    </li></a>
                </strong>
            </ul>
    </div>
    <div id="searchheader" class="noselect">
        <form>
        <label class="bu" for="buscar"><strong>Buscar en el sistema: </strong></label><input class="bu" type="text" name="buscar"/><input type="submit" value="Ir" style="padding-left: 3px; padding-right:3px; margin-right: 5px;">
        </form>
    </div>
    <ul id="usermenu" style="z-index: 87;">
               <div id="tri2" ></div>
               <li class="cm2"><center>Not 1</center></li>
               <li class="cm2"><center>Not 2</center></li>
               <li class="cm2"><center>  Cerrar Sesión  </center></li>
    </ul>
    <div id="target"></div>
    <!--Nombre--codigo y/o id*, proveedor*, precio*, cantidad de stock*, descripcion*, categoria, tags -->
    <div id="wrapper">
        <div id="edit"><a href="#"><img id="ed" src="images/edit.svg" width="100px" height="37px" style="float: right; display:block; margin: 10px;"></a></div>
        <div id="img-desc" style="float:left;width:40%;">
            <img id="grande" src="images/canilla.png" style="float:left;width:100%;margin-right: 30px;">
        </div>
        
        <div id="datos-desc">
            <div class="subGran" id="a">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <h4 class="sep">Categoría Principal: <span class="tag" style="background-color:lightgreen">RE canilla</span></h4>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$126.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <div id="tags"><strong>TAGS:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
    <div id="categorias" class="sep"><strong>Categorias:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. </p>
            </div>
                    <div class="subGran" id="b">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <h4 class="sep">Categoría Principal: <span class="tag" style="background-color:lightgreen">RE canilla</span></h4>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$126.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <div id="tags"><strong>TAGS:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
    <div id="categorias" class="sep"><strong>Categorias:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. </p>
            </div>
                <div class="subGran" id="c">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <h4 class="sep">Categoría Principal: <span class="tag" style="background-color:lightgreen">RE canilla</span></h4>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$126.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <div id="tags"><strong>TAGS:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
    <div id="categorias" class="sep"><strong>Categorias:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. </p>
            </div>
                <div class="subGran" id="d">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <h4 class="sep">Categoría Principal: <span class="tag" style="background-color:lightgreen">RE canilla</span></h4>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$126.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <div id="tags"><strong>TAGS:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
    <div id="categorias" class="sep"><strong>Categorias:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. </p>
            </div>
                <div class="subGran" id="e">
            <h2 class="sep">#w12312312- Canilla super cheta cromada y yo que se</h2>
            <h4 class="sep">Categoría Principal: <span class="tag" style="background-color:lightgreen">RE canilla</span></h4>
            <p  class="sep">by <a href="#">Proveedor</a><hr></p>
            <h3 class="sep" id="precio">Precio: <strong>$126.55</strong></h3>
            <h4 class="sep">Stock: <strong style="color:green;">IN STOCK</strong></h4>
            <h4 class="sep"><strong style="color:green;">ACTIVO</strong></h4>
            <div id="tags"><strong>TAGS:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
    <div id="categorias" class="sep"><strong>Categorias:</strong><span class="tag">canilla</span><span class="tag">canilla</span><span class="tag">canilla</span></div>
            <p class="sep">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nunc in tellus tristique rhoncus. Fusce ut ipsum ut metus eleifend ultrices quis non urna. Integer at diam nec ante posuere rhoncus sit amet ultricies tellus. </p>
            </div>
            <div id="mini-imgs">
                <div name="0" class="subart"><img src="images/canilla1.jpg"><font class="innerPrice">$150</font></div>
                <div name="1" class="subart"><img src="images/canilla2.jpg"><font class="innerPrice">$150</font></div>
                <div name="2" class="subart"><img src="images/canilla3.jpg"><font class="innerPrice">$150</font></div>
                <div name="3" class="subart"><img src="images/canilla1.jpg"><font class="innerPrice">$150</font></div>
                <div name="4" class="subart"><img src="images/canilla1.jpg"><font class="innerPrice">$150</font></div>
            </div>
        </div>
    </div>    
    <div id="scrollup" style="z-index:8; position:fixed; bottom:0%; float:right;"><img src="images/up.svg" width="50px"/></div>
</body>

    <script type="text/javascript" src="js/bootstrap.js"></script>
    
</html>