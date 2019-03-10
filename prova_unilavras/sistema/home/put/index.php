<?php 

include('../../../config/config.php');
include('../../../config/functions.php');

// Caminho da biblioteca PHPMailer
require('../../../config/PHPMailer-master/src/PHPMailer.php');
require('../../../config/PHPMailer-master/src/SMTP.php');
require('../../../config/PHPMailer-master/src/Exception.php');

//include as configuracoes do e-mail
include('./configuracoes_email.php');

//include das validacoes do php
include("./validacoes.php");


//VERIFICA SE JA EXISTE O CLIENTE CADASTRADO
$query_verificacao = "SELECT codigo_cliente FROM tab_clientes WHERE codigo_cliente = :codigo_cliente";

$stmt_verificacao = $conn->prepare($query_verificacao);
$stmt_verificacao->bindValue(":codigo_cliente", $codigo_cliente,PDO::PARAM_INT);

if(!$stmt_verificacao->execute()) {
    echo "erro:" .$conn->errorInfo(1); 
}


//VERIFICA SE SERÁ UPDATE OU INSERT
$num_registros = $stmt_verificacao->rowCount();

//SE FOR MAIOR QUE ZERO É UPDATE(TEM USUARIO CADASTRADO)
if($num_registros > 0) {

    $conn->beginTransaction();


    $sqlUpdatetCliente = "UPDATE tab_clientes SET
        nome = :nome, email = :email, celular = :celular, 
        endereco = :endereco,numero = :numero, bairro = :bairro,
        id_cidade = :id_cidade, id_estado = :id_estado,
        cep = :cep,id_setor = :id_setor, id_curso = :id_curso,
        id_tipo_cliente = :id_tipo_cliente
    WHERE codigo_cliente = :codigo_cliente";

 

    $stmt = $conn->prepare($sqlUpdatetCliente);
    $stmt->bindValue(":codigo_cliente", $codigo_cliente,PDO::PARAM_INT);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":celular", $celular);
    $stmt->bindValue(":endereco", $endereco);
    $stmt->bindValue(":numero", $numero);
    $stmt->bindValue(":bairro", $bairro);
    $stmt->bindValue(":id_cidade", $id_cidade,PDO::PARAM_INT);
    $stmt->bindValue(":id_estado", $id_estado,PDO::PARAM_INT);
    $stmt->bindValue(":id_setor", $id_setor,PDO::PARAM_INT);
    $stmt->bindValue(":id_curso", $id_curso,PDO::PARAM_INT);
    $stmt->bindValue(":id_tipo_cliente", $id_tipo_cliente,PDO::PARAM_INT);
    $stmt->bindValue(":cep", $cep);
    $updateCliente = $stmt->execute();

    //Apos o update é feito o insert na tabela solicitaçoes
    $sqlInsertSolicitacao = "INSERT INTO tab_solicitacoes
    ( 
        id_cliente_fk,
        data_solicitacao,
        descricao_servico
       ) 
       VALUES (
        :codigo_cliente, 
        CURDATE(),
        :descricao)";

    $stmt2 = $conn->prepare($sqlInsertSolicitacao);

    $stmt2->bindValue(":codigo_cliente", $codigo_cliente, PDO::PARAM_INT);
    $stmt2->bindValue(":descricao", $descricao);
    $insertSolicitacao = $stmt2->execute();
    
    
    // Mensagem que vai no corpo do e-mail
    $mail->Body =utf8_decode( 
    "<html>
        <head>
        <title>Solicitação - Formulário de Solicitações de Demandas</title>
        </head>
        <body>
        <p>Olá,</p>
        <p>Alguém acaba de fazer uma solicitação no formulário de solicitações de demanda!</p>
        <p>Informações recebidas:</p>
        <p>Nome: <b>$nome</b> </p>
        <p>E-mail:<b>$email</b></p>
        <p>Celular: <b>$celular</b></p>
        <p>Descrição da Solicitação:<b>$descricao...</b></p>

        </body>
    </html>
    ");

    if($sqlUpdatetCliente && $insertSolicitacao && $mail->send()){
        $conn->commit();
       retorno_usuario("success","Sua solicitação foi enviada com sucesso! O setor de TI já está acompanhando sua demanda e em breve entrará em contato pelo telefone: $celular ou pelo e-mail: $email");
    } else {
        $conn->rollBack();
       retorno_usuario("error","Erro ao enviar a solicitação. Tente novamente!");
    }

}


//se o registro for menor ou igual a zero, insercao
$conn->beginTransaction();


    $sqlInsertCliente = "INSERT INTO 
    tab_clientes
     ( 
        codigo_cliente,
        nome,
        celular, 
        email,
        endereco,
        numero,
        bairro,
        id_cidade,
        id_estado,
        id_curso,
        id_setor,
        id_tipo_cliente,
        cep
        ) 
        VALUES (:codigo_cliente,
                :nome,
                :celular, 
                :email,
                :endereco,
                :numero,
                :bairro,
                :id_cidade,
                :id_estado,
                :id_curso,
                :id_setor,
                :id_tipo_cliente,
                :cep)";

 

    $stmt = $conn->prepare($sqlInsertCliente);
    $stmt->bindValue(":codigo_cliente", $codigo_cliente,PDO::PARAM_INT);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":celular", $celular);
    $stmt->bindValue(":endereco", $endereco);
    $stmt->bindValue(":numero", $numero);
    $stmt->bindValue(":bairro", $bairro);
    $stmt->bindValue(":id_cidade", $id_cidade,PDO::PARAM_INT);
    $stmt->bindValue(":id_estado", $id_estado,PDO::PARAM_INT);
    $stmt->bindValue(":cep", $cep);
    $stmt->bindValue(":id_setor", $id_setor,PDO::PARAM_INT);
    $stmt->bindValue(":id_curso", $id_curso,PDO::PARAM_INT);
    $stmt->bindValue(":id_tipo_cliente", $id_tipo_cliente,PDO::PARAM_INT);
    $insertCliente = $stmt->execute();


    $sqlInsertSolicitacao = "INSERT INTO tab_solicitacoes
    ( 
        id_cliente_fk,
        data_solicitacao,
        descricao_servico
       ) 
       VALUES (
                :codigo_cliente, 
                CURDATE(),
               :descricao)";

    $stmt2 = $conn->prepare($sqlInsertSolicitacao);

    $stmt2->bindValue(":codigo_cliente", $codigo_cliente,PDO::PARAM_INT);
    $stmt2->bindValue(":descricao", $descricao);
    $insertSolicitacao = $stmt2->execute();

    
    // Mensagem que vai no corpo do e-mail

    $mail->Body =utf8_decode( 
    "<html>
        <head>
        <title>Solicitação - Formulário de Solicitações de Demandas</title>
        </head>
        <body>
        <p>Olá,</p>
        <p>Alguém acaba de fazer uma solicitação no formulário de solicitações de demanda!</p>
        <p>Informações recebidas:</p>
        <p>Nome: <b>$nome</b> </p>
        <p>E-mail:<b>$email</b></p>
        <p>Celular: <b>$celular</b></p>
        <p>Descrição da Solicitação:<b>$descricao...</b></p>

        </body>
    </html>
    ");


    if($insertCliente && $insertSolicitacao && $mail->Send()){
        $conn->commit();
       retorno_usuario("success","Sua solicitação foi enviada com sucesso! O setor de TI já está acompanhando sua demanda e em breve entrará em contato pelo telefone: $celular ou pelo e-mail: $email");
    } else {
        $conn->rollBack();
       retorno_usuario("error","Erro ao realizar uma solicitação. Atualize a pagina e tente novamente! ");
    }
