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

                $categoria = new Categoria();
                $categoria->setNome($produto_array['categoria_nome']);

                $nome = $produto_array['nome'];
                $descricao = $produto_array['descricao'];
                $preco = $produto_array['preco'];
                $usado = $produto_array['usado'];
                $isbn = $produto_array['isbn'];
                $tipoProduto = $produto_array['tipoProduto'];

                if ($tipoProduto == "Livro") {
                    $produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
                    $produto->setIsbn($isbn);
                } else {
                    $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
                }
                $produto->setId($produto_array['id']);

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

            $tipoProduto = get_class($produto);

            $query = "insert into produtos (nome, preco, descricao, categoria_id, usado, isbn, tipoProduto) 
                values ('{$nome}', {$preco}, '{$descricao}', {$categoria_id}, {$usado}, '{$isbn}', '{$tipoProduto}')";

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

            $tipoProduto = get_class($produto);

            $query = "update produtos set nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', 
            categoria_id= {$categoria_id}, usado = {$usado}, isbn = '{$isbn}', tipoProduto = '{$tipoProduto}' where id = '{$id}'";

            $resultadoDaAlteracao = mysqli_query($this->conexao, $query);
            return $resultadoDaAlteracao;
        }

        function buscaProduto($id) {
            $query = "select * from produtos where id = {$id}";
            $resultado = mysqli_query($this->conexao, $query);
            $produto_buscado = mysqli_fetch_assoc($resultado);

            $categoria = new Categoria();
            $categoria->setId($produto_buscado['categoria_id']);

            $nome = $produto_buscado['nome'];
            $descricao = $produto_buscado['descricao'];
            $preco = $produto_buscado['preco'];
            $usado = $produto_buscado['usado'];
            $isbn = $produto_buscado['isbn'];
            $tipoProduto = $produto_buscado['tipoProduto'];

            if ($tipoProduto == "Livro") {
                $produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
                $produto->setIsbn($isbn);
            } else {
                $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
            }
            $produto->setId($produto_buscado['id']);

            return $produto;
        }

        function removeProduto($id) {
            $query = "delete from produtos where id = {$id}";

            $resultadoDaDelecao = mysqli_query($this->conexao, $query);
            return $resultadoDaDelecao;
        }
    }
?>