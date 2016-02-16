<?php
include_once "clases.php";
session_start(); 
session_destroy();
log::set("Cerró sesión");
header('location: ../login.php'); 
?> 
