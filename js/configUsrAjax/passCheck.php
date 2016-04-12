<?php

if(isset($_POST['password']) && !empty($_POST['password'])){
	require 'connect.php';
	$query = mysql_query("
			SELECT	`usuario`.`password`
			FROM 	`usuario`
			WHERE	`usuario`.`password` = '" . mysql_real_escape_string(md5(trim($_POST['password']))) ."'
			");
	echo (mysql_num_rows($query)==0) true; ? : utf8_encode('Contraseña actual incorrecta') ;
}//trim(mysql_result($query, 0, 'password'))
	?>