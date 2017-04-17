<?php 
	require_once("cabecalho.php"); 
	require_once("logica-usuario.php");
	
	verificaUsuario();

	$tipoProduto = $_POST['tipoProduto'];
	$categoria_id = $_POST['categoria_id'];

	//Criação de um objeto 'Produto'.
	$factory = new ProdutoFactory();
	$produto = $factory->criaPor($tipoProduto, $_POST);

	//Atualização do objeto 'Produto'.
	$produto->atualizaBaseadoEm($_POST);
	$produto->getCategoria()->setId($categoria_id);
	
	if(array_key_exists('usado', $_POST)) {
		$produto->setUsado("true");
	} else {
		$produto->setUsado("false");
	}

	?>
	
	<?php
	$produtoDao = new ProdutoDao($conexao);

	if($produtoDao->insereProduto($produto)) {
	?>
	<p class="alert-success">Produto <?= $produto->getNome(); ?>, <?= $produto->getPreco(); ?> adicionado com sucesso!</p>
	<?php
	} else {
		$msg = mysqli_error($conexao);
	?>
	<p class="alert-danger">O produto <?= $produto->getNome(); ?> não foi adicionado: <?= $msg ?></p>
	<?php
	}
	?>
		
<?php require_once("rodape.php"); ?>