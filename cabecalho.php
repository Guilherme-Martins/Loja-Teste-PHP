<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    require_once("mostra-alerta.php");
    require_once("conecta.php");
    require_once("logica-usuario.php"); 

    //Utilização de função anônima.
    spl_autoload_register(function($nomeDaClasse) {
        require_once("class/".$nomeDaClasse.".php");
    });
    ?>

<html>
<head>
    <title>Adocicando</title>
    <meta charset="utf-8">
	<meta property="og:locale" content="pt_BR" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/loja.css" rel="stylesheet" />
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Adocicando</a>
            </div>

               <div>
                <ul class="nav navbar-nav">
                    <?php if(usuarioEstaLogado()) { ?>
					<li><a href="produto-formulario.php">Adiciona Produto</a></li>
                    <?php } ?>
					<li><a href="produto-lista.php">Produtos</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                </ul>
            </div>
        </div><!-- container acaba aqui -->
    </div>

    <div class="container">

    <div class="principal">

    <?php mostraAlerta("success");
    mostraAlerta("danger"); ?>