<?php
session_start();
//if(!isset($_SESSION['user']))
//    header('location: login.php');

require_once 'include/clases.php';

if (isset($_POST["submit"])) {
    var_dump($_POST);
    $subarticulos = array();
    $cont = $_POST['subarticulos'];
    $target_dir = "images/articulos/";
    $check = true;
    for ($i = 0; $i < $cont; $i++) {
        //Upload image
        $check = true;
        if (isset($_FILES["foto" . $i])) {
            $target_file = $target_dir . basename($_FILES["foto" . $i]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            echo "Type: " . $imageFileType;
            $check = getimagesize($_FILES["foto" . $i]["tmp_name"]);
            if ($_FILES["foto" . $i]["size"] > 500000) {
                //echo "Sorry, your file is too large.";
                $uploadOk = 0;
                $check = false;
            } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            } else {
                if (move_uploaded_file($_FILES["foto" . $i]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["foto" . $i]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $check = false;
                }
            }
        }
        if ($check === false) break;
//        $id_cat=categoria::getId($_POST['big-cat' . $i]);
        array_push($subarticulos, array('codigo' => $_POST['codigo' . $i], 'id_categoria' => $_POST['big-cat' . $i],
            'activo' => isset($_POST['isActivo' . $i]) ? '1' : '0','distincion' => $_POST['distincionSelect' . $i],
            'precio' => $_POST['precio' . $i], 'stock' => 0, 'descripcion' => $_POST['name' . $i],
            'path' => isset($_FILES["foto" . $i])?$target_dir . basename($_FILES["foto" . $i]["name"]):null));
    }
    if ($check !== false)
        articulo::add($_POST['prov'], $_POST['name'], $_POST['descripcion'], $cont, $subarticulos);
    var_dump($_SESSION);
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jqueryui/jquery-ui.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/funcionesAltaArticulo.js"></script>
    <script src="js/colors.js"></script>
    <script src="js/switchery.min.js"></script>

    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/form.css" rel="stylesheet" type="text/css" media="all"/>

    <title>[StockMGR]</title>
    <link rel="icon"
          type="image/png"
          href="images/fav.png"/>
    <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">

    <link rel="stylesheet" href="css/chosen.css">
    <link rel="stylesheet" href="css/prism.css">

    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!--    <link href="css/estilo.css" rel="stylesheet" type="text/css" media="all"/>-->

    <style type="text/css" media="all">
        .chosen-rtl .chosen-drop {
            left: -9000px;
        }
    </style>


</head>
<body class="noselect azul" onload="init();">

<script>
    var edit = <?php echo isset($_SESSION['edit']) ? 1 : 0?>;
    $.get('file.json');
    var articulo = <?php if (isset($_SESSION['edit'])) {
            /*echo $_SESSION['edit']*/
            echo '{"id":11,"proveedor":"Mabel SRL","nombre":"BRAZO CON ROSETA METALICO",' .
                '"observaciones":"TEXTAREA COSO LARGO PUM TU VIEJA EN TANGADA EN 4 MEJOR EN 8 ASI EL CULO LE ABROCHO",' .

                '"subarticulos":[{"id":8,"id_articulo":11,"codigo":"JEJE","id_categoria":1,"activo":true,"distincion":' .
                '"Modelo","precio":256,"stock":74,"descripcion":"C14","imgpath":"images\/articulos\/BRAZO CON ROSETA ' .
                'METALICO C14.png","categoria":"Daiyuan","tags":[{"tag":"C14"},{"tag":"duchero"},{"tag":"metal"}],' .
                '"categorias":[{"id":24,"nombre":"Accesorios"},{"id":34,"nombre":"Metasul"}]},{"id":9,"id_articulo":11,' .
                '"codigo":"","id_categoria":1,"activo":false,"distincion":"Modelo","precio":270,"stock":52,"descripcion":' .
                '"C15","imgpath":"images\/articulos\/BRAZO CON ROSETA METALICO C15.png","categoria":"Daiyuan","tags":' .
                '[{"tag":"C15"},{"tag":"duchero"},{"tag":"metal"}],"categorias":[{"id":37,"nombre":"Sifones"},' .
                '{"id":38,"nombre":"Terrajas"},{"id":40,"nombre":"Accesorios de grifer\u00eda"}]}]}';
        } else {
            echo '""';
        }
        ?>;
    var categorias = <?php echo json_encode(categoria::getAll());?>;
</script>

<?php
require "include/header.php"; 
?>


<div id="wrapper">

    <h1>Alta de artículo</h1>

    <form id="formito" method="post" action="" enctype="multipart/form-data">
                  <span class="unForm border-form">
                      <input style="display: none;" name="subarticulos">
                      <!--Nombre-->
                      <div class="col-3">
                          <label>
                              Nombre
                              <input placeholder="Nombre del artículo" id="name" name="name" tabindex="1"
                                     autocomplete="off">
                              <div class="suggest-box suggest-col-2">
                              </div>
                          </label>
                      </div>

                      <!--Proveedor-->
                      <div class="col-3">
                          <label>
                              Proveedor
                              <input placeholder="Proveedor" id="prov" name="prov" tabindex="2">
                          </label>
                      </div>

                      <!--Codigo-->
                      <div class="col-3">
                          <label>
                              Código
                              <input placeholder="Código del artículo" id="codigo" name="codigo" tabindex="2">
                          </label>
                      </div>

                      <!--Tags-->
                      <div class="col-3" style="position:relative;">
                          <label for="input-box">
                              Palabras clave
                              <div id="fake-input" class="fake-input"><input id="input-box" class="input-box"
                                                                             name="tags" type="text"
                                                                             placeholder="Encuentra artículos más facilmente"
                                                                             style="margin-top: 0px;
                            padding-top: 0px;margin-left:0px;padding-left:0px;width:90%;" autocomplete="off"></div>
                          </label>
                      </div>

                      <!--Foto-->
                      <div class="col-3">
                          <label style="height:60px;">
                              Foto
                              <input type="file" id="foto" value="Subir Foto" name="foto" tabindex="4">
                          </label>
                      </div>

                      <!--Precio-->
                      <div class="col-3">
                          <label>
                              Precio
                              <input type="number" placeholder="$" id="precio" name="precio" tabindex="6">
                          </label>
                      </div>

                      <!--Categorias-->
                      <div class="col-2" style="float:left;" id="col-cat">
                          <label>
                              <span id="cat-tit">Categorias</span>
                              <select id="categorias" data-placeholder="Selecciona varias..." class="chosen-select"
                                      multiple
                                      style="width:85%;" tabindex="4">
                                  <option value=""></option>
                                  <?php
                                  $categorias = categoria::getAll();
                                  foreach ($categorias as $categoria) {
                                      echo "<option value='${categoria['id']}'>${categoria['nombre']}</option>";
                                  }
                                  ?>
                              </select>
                              <input type="text" style="display: none" id="big-cat" name="big-cat">

                          </label>
                      </div>

                      <!--Descripcion-->
                      <div class="col-2" id="col-desc">
                          <label>
                              <span id="textoDescripcion" class="desc-tit">Descripción</span><br/>
                              <textarea id="descripcion" name="descripcion"
                                        style="-webkit-margin-before: -10px;"></textarea>
                          </label>
                      </div>

                      <!--Activo-->
                      <div class="col-2">
                          <label>Activo</label>
                          <center style="position:relative;margin-bottom:8px;"><input class="js-switch" type="checkbox">
                          </center>
                      </div>


                 </span>
                  
                  <span id="sobre">
                  </span>

        <div class="col-submit">
            <button type="button" id="btn-mas" onclick="addForm();return false;">+</button>
            <button id="submit-btn" type="submit" name="submit" class="submitbtn">Dar de Alta</button>
        </div>

    </form>

</div>

<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    };
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>


<script type="text/javascript">
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });
</script>
<div id="scrollup" style="z-index:8; position:fixed; bottom:0%; float:right;"><img src="images/up.svg" width="50px"
                                                                                   style="opacity:.92;"/></div>
</body>
</html>