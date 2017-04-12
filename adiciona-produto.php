<?php 
	require_once("cabecalho.php"); 
	require_once("logica-usuario.php");
	
	verificaUsuario();

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