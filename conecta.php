<?php
	$conexao = mysqli_connect('localhost', 'root', '', 'loja');
	//$conexao = mysqli_connect("mysql.hostinger.com.br", "u681604169_guiti", "guitins", "u681604169_guiti");
	
	mysqli_query($conexao, "SET NAMES 'utf8'");	
	mysqli_query($conexao, 'SET character_set_connection=utf8');
	mysqli_query($conexao, 'SET character_set_client=utf8');
	mysqli_query($conexao, 'SET character_set_results=utf8');