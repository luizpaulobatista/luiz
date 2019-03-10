<?php
 
// Caminho da biblioteca PHPMailer
require('../../../config/PHPMailer-master/src/PHPMailer.php');
require('../../../config/PHPMailer-master/src/SMTP.php');
require('../../../config/PHPMailer-master/src/Exception.php');

// Instância do objeto PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
 
// Configura para envio de e-mails usando SMTP
//$mail->isSMTP();
 
// Servidor SMTP
$mail->Host = 'smtp.gmail.com';
 
// Usar autenticação SMTP
$mail->SMTPAuth = true;
 
// Usuário da conta
$mail->Username = 'luizpaulosistemasdeinformacao@gmail.com';
 
// Senha da conta
$mail->Password = 'pjab70@lpb';
 
// Tipo de encriptação que será usado na conexão SMTP
$mail->SMTPSecure = 'ssl';
 
// Porta do servidor SMTP
$mail->Port = 465;
 
// Informa se vamos enviar mensagens usando HTML
$mail->IsHTML(true);
 
// Email do Remetente
$mail->From = 'luizpaulosistemasdeinformacao@gmail.com';
 
// Nome do Remetente
$mail->FromName = 'Luiz Paulo Batista';
 
// Endereço do e-mail do destinatário
$mail->addAddress('luizpaulo_17mg@yahoo.com.br');
 
// Assunto do e-mail
$mail->Subject = utf8_decode('Solicitação - Formulário de Solicitações de Demandas');
 
// Mensagem que vai no corpo do e-mail

$mail->Body =utf8_decode( 
'<html>
    <head>
    <title>Solicitação - Formulário de Solicitações de Demandas</title>
    </head>
    <body>
    <p>Olá,</p>
    <p>Alguém acaba de fazer uma solicitação no formulário de solicitações de demanda!</p>
    <p>Informações recebidas:</p>
    <p>Nome: <b>Luiz Paulo</b> </p>
    <p>E-mail:<b>luizpaulo_17mg@yahoo.com.br</b></p>
    <p>Celular: <b>91724029</b></p>
    <p>Data:<b>09/03/2019</b></p>
    <p>Tipo de Pessoa:<b>Aluno</b></p>
    <p>Descrição da Solicitação:<b>Esse é um teste...</b></p>

    </body>
</html>
');
 
// Envia o e-mail e captura o sucesso ou erro
if($mail->Send()):
    echo 'Enviado com sucesso !';
else:
    echo 'Erro ao enviar Email:' . $mail->ErrorInfo;
endif;