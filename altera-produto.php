<?php 
	require_once("cabecalho.php");                    

	//Instanciação de uma categoria.
	$categoria = new Categoria();
	$categoria->setId($_POST['categoria_id']);

	$nome = $_POST["nome"];
	$preco = $_POST["preco"];
	$descricao = $_POST["descricao"];
	$isbn = $_POST['isbn'];
	$tipoProduto = $_POST['tipoProduto'];
	
	if(array_key_exists('usado', $_POST)) {
		$usado = "true";
	} else {
		$usado = "false";
	}

	if ($tipoProduto == "Livro") {
		//Instanciação de um livro.
		$produto = new Livro($nome, $preco, $descricao, $categoria, $usado);		
		$produto->setIsbn($isbn);
	} else {
		//Instanciação de um produto.
		$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
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