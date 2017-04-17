<?php
    class ProdutoDao {

        private $conexao;

        function __construct($conexao) {
            $this->conexao = $conexao;
        }

        function listaProdutos() {
            $produtos = array();
            $resultado = mysqli_query($this->conexao, "select p.*,c.nome as categoria_nome 
                from produtos as p join categorias as c on c.id=p.categoria_id");

            while($produto_array = mysqli_fetch_assoc($resultado)) {

                $tipoProduto = $produto_array['tipoProduto'];
                $produto_id = $produto_array['id'];
                $categoria_nome = $produto_array['categoria_nome'];

                $factory = new ProdutoFactory();
                $produto = $factory->criaPor($tipoProduto, $produto_array);
                $produto->atualizaBaseadoEm($produto_array);

                $produto->setId($produto_id);
                $produto->getCategoria()->setNome($categoria_nome);

                array_push($produtos, $produto);
            }
            return $produtos;
        }

        function insereProduto(Produto $produto) {
            $nome = mysqli_real_escape_string($this->conexao, $produto->getNome());
            $preco = mysqli_real_escape_string($this->conexao, $produto->getPreco());
            $descricao = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
            $categoria_id = mysqli_real_escape_string($this->conexao, $produto->getCategoria()->getId());
            $usado = mysqli_real_escape_string($this->conexao, $produto->getUsado());

            $isbn = "";
            if ($produto->temIsbn()) {
                $isbn = mysqli_real_escape_string($this->conexao, $produto->getIsbn());
            }

            $waterMark = "";
            if($produto->temWaterMark()) {
                $waterMark = mysqli_real_escape_string($this->conexao, $produto->getWaterMark());
            }

            $taxaImpressao = "";
            if($produto->temTaxaImpressao()) {
                $taxaImpressao = mysqli_real_escape_string($this->conexao, $produto->getTaxaImpressao());
            }

            $tipoProduto = get_class($produto);

            $query = "insert into produtos (nome, preco, descricao, categoria_id, 
                        usado, isbn, tipoProduto, waterMark, taxaImpressao) 
                        values ('{$nome}', {$preco}, '{$descricao}', {$categoria_id}, 
                        {$usado}, '{$isbn}', '{$tipoProduto}', '{$waterMark}', '{$taxaImpressao}')";

            $resultadoDaInsercao = mysqli_query($this->conexao, $query);
            return $resultadoDaInsercao;
        }

        function alteraProduto(Produto $produto) {
            $id = mysqli_real_escape_string($this->conexao, $produto->getId());
            $nome = mysqli_real_escape_string($this->conexao, $produto->getNome());
            $preco = mysqli_real_escape_string($this->conexao, $produto->getPreco());
            $descricao = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
            $categoria_id = mysqli_real_escape_string($this->conexao, $produto->getCategoria()->getId());
            $usado = mysqli_real_escape_string($this->conexao, $produto->getUsado());

            $isbn = "";
            if ($produto->temIsbn()) {
                $isbn = mysqli_real_escape_string($this->conexao, $produto->getIsbn());
            }

            $waterMark = "";
            if($produto->temWaterMark()) {
                $waterMark = mysqli_real_escape_string($this->conexao, $produto->getWaterMark());
            }

            $taxaImpressao = "";
            if($produto->temTaxaImpressao()) {
                $taxaImpressao = mysqli_real_escape_string($this->conexao, $produto->getTaxaImpressao());
            }

            $tipoProduto = get_class($produto);

            $query = "update produtos set nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', 
            categoria_id= {$categoria_id}, usado = {$usado}, isbn = '{$isbn}', tipoProduto = '{$tipoProduto}', 
            waterMark = '{$waterMark}', taxaImpressao = '{$taxaImpressao}' where id = '{$id}'";

            $resultadoDaAlteracao = mysqli_query($this->conexao, $query);
            return $resultadoDaAlteracao;
        }

        function buscaProduto($id) {
            $query = "select * from produtos where id = {$id}";
            $resultado = mysqli_query($this->conexao, $query);
            $produto_buscado = mysqli_fetch_assoc($resultado);

            $tipoProduto = $produto_buscado['tipoProduto'];
            $produto_id = $produto_buscado['id'];
            $categoria_id = $produto_buscado['categoria_id'];

            $factory = new ProdutoFactory();
            $produto = $factory->criaPor($tipoProduto, $produto_buscado);
            $produto->atualizaBaseadoEm($produto_buscado);

            $produto->setId($produto_id);
            $produto->getCategoria()->setId($categoria_id);

            return $produto;
        }

        function removeProduto($id) {
            $query = "delete from produtos where id = {$id}";

            $resultadoDaDelecao = mysqli_query($this->conexao, $query);
            return $resultadoDaDelecao;
        }
    }
?>