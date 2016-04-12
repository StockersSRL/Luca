<?php
session_start(); 
if(!isset($_SESSION['user']))
    header('location: login.php');

require_once 'include/clases.php';

if(isset($_POST["altausuario"])){
	if ($_SESSION['tipo']=='ADM')
		user::add($_POST["nombre"], $_POST["apellido"], $_POST["email"], $_POST["username"],$_POST["pass1"],$_POST["pass2"],@$_POST["adm"]);
        var_dump(msg::get());
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script style="color: rgb(0, 0, 0);" src="js/jquery-1.11.1.min.js"></script>
<!---<script src="https://code.jquery.com/jquery-1.10.2.js"></script>--->
     <script src="js/functions.js"></script>
     <script src="js/colors.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/switchery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="css/styles-form.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
    
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<link href="css/estilo.css" rel="stylesheet" type="text/css" media="all">
    
<title>[StockMGR]</title>
<link rel="icon" 
      type="image/png" 
      href="images/fav.png" />
</head>
<body style="  background-image: url(images/bg%20hipster%20forest.jpg);
  background-repeat: no-repeat;
  background-size: cover;">

<?php
require("include/header.php");
?>
    
    <div id="wrapper">
        <h1>Alta de Usuario</h1>
  
          <form method="POST">
          <div class="col-3">
            <label>
              Nombre
              <input placeholder="Nombre" id="nameUsr" name="nombre" tabindex="1">
            </label>
          </div>
          <div class="col-3">
            <label>
              Apellido
              <input placeholder="Apellido" id="phone" name="apellido" tabindex="2">
            </label>
          </div>
          <div class="col-3">
            <label>
              E-mail
              <input placeholder="Dirección de correo electrónico" id="email" name="email" tabindex="3">
            </label>
          </div>
          <div class="col-3">
            <label>
              Usuario
                <input placeholder="Nombre de usuario" id="user" name="username" tabindex="4">
            </label>
          </div>

          <div class="col-3">
            <label>
              Contraseña
              <input type="password" placeholder="••••••••" id="pass" name="pass1" tabindex="5">
            </label>
          </div>
              <div class="col-3">
            <label>
              Reingresa tu contraseña
              <input type="password" placeholder="••••••••" id="rePass" name="pass2" tabindex="5">
            </label>
          </div>
              
          <div class="col-2">
            <label>Administrador</label>
            <center style="position:relative; margin-bottom:8px;"><input class="js-switch" type="checkbox" name="adm"></center>
          </div>
          <div class="col-2">
            <label>Acepto los términos y condiciones</label>
            <center style="position:relative;margin-bottom:8px;"><input class="js-switch" type="checkbox"></center>
          </div>

          <div class="col-submit">
            <button type="submit" name="altausuario" class="submitbtn">Darme de alta</button>
          </div>

          </form>
          </div>
<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
    <div id="scrollup" style="z-index: 8; position: fixed; bottom: 0%; float: right; display: block;"><img src="images/up.svg" width="30px"></div>

</body>

</html>
