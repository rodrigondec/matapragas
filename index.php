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
            if ($_SESSION['login'] == 'rodrigo'){
                include_once(TEMPLATES.'/geral/menu_estoque.php'); //adicionando menu
            }
            else if ($_SESSION['login'] == 'levi'){
                include_once(TEMPLATES.'/geral/menu_agendamento.php'); //adicionando menu
            }

        	mostrar_conteudo(); //mostrar o template incluído
        ?>
        
    </body>
</html>

