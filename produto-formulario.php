<?php 
	require_once("cabecalho.php"); 
	require_once("logica-usuario.php");
	
	verificaUsuario();

	$categoria = new Categoria();
	$categoria->setId(1);

	$produto = new LivroFisico("", "", "", $categoria, "");

	$categoriaDao = new CategoriaDao($conexao);
	$categorias = $categoriaDao->listaCategorias();
?>

	<h1>Formulário de Produto</h1>
	<BR/>

    <form action="adiciona-produto.php" method="post">
        <table class="table">
            <?php include("produto-formulario-base.php"); ?>
			
			<tr>
				<td><input class="btn btn-primary" type="submit" value="Cadastrar" /></td>
				<td></td>
			</tr>
        </table>

    </form>
</html>

<?php require_once("rodape.php"); ?>