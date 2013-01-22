<?php
	include('controle/globais.php');
	session_destroy();
	header('LOCATION: /'.BASE.'/login.php/');	
?>