<?php 
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
$mail->From ='luizpaulosistemasdeinformacao@gmail.com';

// Nome do Remetente
$mail->FromName = utf8_decode('Sistema de Solicitações de Serviço ao TI');


// Endereço do e-mail do destinatário
$mail->addAddress('wjosue@unilavras.edu.br');

// Assunto do e-mail
$mail->Subject = utf8_decode('Solicitação - Formulário de Solicitações de Demandas');

