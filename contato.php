<?php require_once("cabecalho.php"); ?>

    <h1>Formulário de Contato</h1>
    <BR/>
    
    <form action="envia-contato.php" method="post">
        <table class="table">
            <tr>
                <td>Nome</td>
                <td><input type="text" name="nome" class="form-control"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" class="form-control"></td>
            </tr>
            <tr>
                <td>Mensagem</td>
                <td><textarea class="form-control" name="mensagem"></textarea></td>
            </tr>
            <tr>
                <td><button type="submit" class="btn btn-primary">Enviar</button></td>
                <td></td>
            </tr>
        </table>

    </form>

<?php require_once("rodape.php"); ?>