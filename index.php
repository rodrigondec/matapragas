<?php include_once('controle/rotas.php'); ?>


<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
    	<link rel="stylesheet" type="text/css" href="/<?php echo BASE?>/estaticos/estilo.css">
        <title>Mata Pragas</title>
    </head>
    <body>
        <?php 
            if (!isset($_SESSION['login']))
               header('LOCATION:/'.BASE.'/login.php');

            include_once(TEMPLATES.'/geral/menu.php'); //adicionando menu
        	mostrar_conteudo(); //mostrar o template incluído
        ?>
        <a href='<?php echo '/'.BASE.'/logout.php/'; ?>'>SAIR</a>
    </body>
</html>

