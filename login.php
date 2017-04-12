<?php 
	require_once("banco-usuario.php");
	require_once("logica-usuario.php");

	$usuario = buscaUsuario($conexao, $_POST["email"], $_POST["senha"]);

	if($usuario == null) { //Erro de Login
		$_SESSION["danger"] = "Usuário ou senha inválido."; 
	    header("Location: index.php"); 
	} else { //Login Correto
		$_SESSION["success"] = "Usuário logado com sucesso.";
		logaUsuario($usuario["email"]);
	    header("Location: index.php"); 
	}
	die();