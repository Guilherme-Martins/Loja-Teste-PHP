<?php 
	require_once("cabecalho.php"); 
	require_once("logica-usuario.php");
	
	$produtoDao = new ProdutoDao($conexao);
	$produtos = $produtoDao->listaProdutos(); ?>

	<h1>Lista de Produtos</h1>
	<BR/>

	<div class="tabela-centro">
	<table class="table table-striped table-bordered">

	<?php
	foreach($produtos as $produto) :
	?>
	<tr>
		<td><?= $produto->getNome() ?></td>
		<td><?= $produto->getPreco() ?></td>
		<!--
		<td><?= $produto->precoComDesconto() ?></td>
		-->
		<td><?= $produto->calculaImposto() ?></td>
		
		<td><?= substr($produto->getDescricao(), 0, 100) ?></td>
		<td><?= $produto->getCategoria()->getNome() ?></td>
		<td>
		    <?php 
		        if ($produto->temIsbn()) {
		            echo "ISBN: ".$produto->getIsbn();
		        }
		    ?>
		</td>
		<?php if(usuarioEstaLogado()) { ?>
		<td>
			<a class="btn btn-primary" href="produto-altera-formulario.php?id=<?=$produto->getId()?>">Alterar</a>
		</td>
		<td>
			<form action="remove-produto.php" method="post">
				<input type="hidden" name="id" value="<?=$produto->getId()?>" />
				<button class="btn btn-danger">Remover</button>
			</form>
		</td>
		<?php } ?>
	</tr>
	<?php
	endforeach
	?>
	
	</table>
	</div>
	
<?php require_once("rodape.php"); ?>