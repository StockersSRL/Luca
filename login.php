<?php
session_start(); 
if(isset($_SESSION['user']))
	header('location: index.php');

require "include/clases.php";
if(isset($_POST['login'])){
	login::in($_POST['user'], $_POST['pass']);
}
?>
<html>
    <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/login.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/formu.css" rel="stylesheet" type="text/css" media="all" />

    <title>[StockMGR]</title>
    <link rel="icon" 
          type="image/png" 
          href="images/fav.png" />
    </head>
    <body class="noselect">
        <div id="background">
                <div id="arriba">
                    <div id="img" style="height:100%;">
						<font size=2><div id="prop" >
							<p style="margin-top: 0px" id="in"></p></div>
                        </font>
                    </div>
				</div>                        
        </div>
        <div id="head"><img src="images/sto.svg" width="95%"></div>
        <div class="login-page">
            <div class="form">
                <form class="register-form">
                    <input type="text" placeholder="Empresa"/>
                    <input type="email" placeholder="E-Mail"/>
                    <textarea placeholder="Cuéntanos acerca de tu negocio."></textarea>
                    <input type="submit" value="Contactarse"/>
                    <p class="message">Ya está registrado? <a href="#">Ingresar</a></p>
                </form>
                <form class="login-form" action="" method="post">
                    <input type="text" placeholder="Usuario" name="user"/>
                    <input type="password" placeholder="Contraseña" name="pass"/>
                    <input type="submit" value="Ingresar" name="login"/>
                    <p class="message">Quieres usar StockManager? <a href="#">Contactarse</a></p>
                </form>
                <div id="error"><?php echo msg::get();?></div>
            </div>
        </div></center>
        <div id="marketing"><strong>Control inteligente de stock.</strong></div>
        <div id="butcontainer" style="position: absolute; bottom: 0; margin: 10px;">
		    <img class="bsl" id="i1" src="images/slide1.svg" height="20px"/>
		    <img class="bsl" id="i2" src="images/slide1.svg" height="20px"/>
            <img class="bsl" id="i3" src="images/slide1.svg" height="20px"/>
			<img class="bsl" id="i4" src="images/slide1.svg" height="20px"/>
        </div>
        </div>
    </body>
</html>