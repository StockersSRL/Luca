<?php
@session_start(); 
if(!isset($_SESSION['user']))
    header('location: login.php');
?>
<div id="header">
        <a id="nav-toggle" href="#"><span></span></a>
        <center>
            <a href="index.php">
           <img id="limage" src="images/sto.svg" height="65px" style="margin-top: 15px; position:static; max-width: 425px;"/>
            </a>
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
                      <td style="border-left: solid 3px #545557; padding: 5px; border-bottom: solid 3px #545557"><strong> <?php echo "[".$_SESSION['tipo']."] ".$_SESSION['apellido'].", ".$_SESSION['nombre'];?> </strong></td>
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
        <form method="post" action="rapidSearch.php" >
        <label class="bu" for="buscar"><strong>Buscar en el sistema: </strong></label><input class="bu" type="text" name="busqueda"/><input type="submit" value="Ir" name="submit" style="padding-left: 3px; padding-right:3px; margin-right: 5px;">
        </form>
    </div>
    <ul id="usermenu" style="z-index: 87;">
               <div id="tri2" ></div>
               <li class="cm2"><center>Not 1</center></li>
               <li class="cm2"><center>Not 2</center></li>
    <a href="include/logout.php"><li class="cm2"><center>  Cerrar Sesión  </center></li></a>
    </ul>
   

    <div id="target"></div>