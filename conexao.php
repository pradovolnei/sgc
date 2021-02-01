<?php
	$con = mysqli_connect('localhost', "root", '');
	mysqli_select_db($con, 'sgc');
	
	ini_set('default_charset','UTF-8');
	mysqli_set_charset($con, "utf8");
	
	$pode_enviar = 1;
	
?>