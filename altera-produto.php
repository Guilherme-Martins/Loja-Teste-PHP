<?php 
	require_once("cabecalho.php");                    

	$tipoProduto = $_POST['tipoProduto'];
	$produto_id = $_POST['id'];
	$categoria_id = $_POST['categoria_id'];

	//Criação de um objeto 'Produto'.
	$factory = new ProdutoFactory();
	$produto = $factory->criaPor($tipoProduto, $_POST);

	//Atualização do objeto 'Produto'.
	$produto->atualizaBaseadoEm($_POST);
	$produto->setId($produto_id);
	$produto->getCategoria()->setId($categoria_id);
	
	if(array_key_exists('usado', $_POST)) {
		$produto->setUsado("true");
	} else {
		$produto->setUsado("false");
	}

	//Acrescenta o Id do produto para alteração.
	$produto->setId($_POST['id']);

	$produtoDao = new ProdutoDao($conexao);

	if($produtoDao->alteraProduto($produto)) { ?>
		<p class="text-success">O produto <?= $produto->getNome() ?>, <?= $produto->getPreco() ?> foi alterado.</p>
	<?php } else {
		$msg = mysqli_error($conexao);
	?>
		<p class="text-danger">O produto <?= $produto->getNome() ?> não foi alterado: <?= $msg?></p>
	<?php
	}
?>

<?php require_once("rodape.php"); ?>