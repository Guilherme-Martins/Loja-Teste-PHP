<?php
    session_start();
    require_once("mail/PHPMailerAutoload.php");

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    //Criação de um novo 'mail'.
    $mail = new PHPMailer();

    //Configuração dos dados do servidor para 'gmail'.
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "apresentacao.guitins@gmail.com";
    $mail->Password = "guitins*";

    //Configuração de quem envia o e-mail.
    $contato_nome = '=?UTF-8?B?'.base64_encode('Site Apresentação').'?='; //Arruma a codificação dos acentos.
    $mail->setFrom("apresentacao.guitins@gmail.com", $contato_nome);
    $mail->addAddress("apresentacao.guitins@gmail.com");

    //Título do email.
    $assunto = '=?UTF-8?B?'.base64_encode('Proposta de Solicitação').'?='; //Arruma a codificação dos acentos.
    $mail->Subject = $assunto;

    //Corpo do email em 'HTML'.
    $mail->msgHTML("<html>de: {$nome}<br/>email: {$email}<br/>mensagem: {$mensagem}</html>");

    //Corpo do email em 'texto alternativo'.
    $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

    //Verificação de envio.
    if($mail->send()) {
        $_SESSION["success"] = "Mensagem enviada com sucesso";
        header("Location: index.php");
    } else {
        $_SESSION["danger"] = "Erro ao enviar mensagem: " . $mail->ErrorInfo;
        header("Location: contato.php");
    }
    die();