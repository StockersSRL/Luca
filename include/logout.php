<?php
include_once "clases.php";
session_start();
log::set("Cerró sesión");
session_destroy();
header('location: ../login.php'); 
?> 
