<?php 
	require_once("cabecalho.php"); 
	
	$id = $_GET['id'];
	
	$produtoDao = new ProdutoDao($conexao);
	$produto = $produtoDao->buscaProduto($id);

	$categoriaDao = new CategoriaDao($conexao);
	$categorias = $categoriaDao->listaCategorias();

	$selecao_usado = $produto->getUsado() ? "checked='checked'" : "";
	$produto->setUsado($selecao_usado);
?>

	<h1>Alteração de Produto</h1>
    <form action="altera-produto.php" method="post">
	
		<input type="hidden" name="id" value="<?=$produto->getId()?>" />
		
        <table class="table">
            <?php include("produto-formulario-base.php"); ?>
			
			<tr>
				<td><button class="btn btn-primary" type="submit">Alterar</button></td>
				<td></td>
			</tr>
        </table>

    </form>
</html>

<?php require_once("rodape.php"); ?>