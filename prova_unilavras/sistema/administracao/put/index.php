<?php 

include('../../../config/config.php');
include('../../../config/functions.php');


//Dados vindo do post
$codigo_cliente   = (int)trim($_POST['codigo']);
$nome             = trim($_POST['nome']);
$endereco         = trim($_POST['endereco']);
$numero           = trim($_POST['numero']);
$bairro           = trim($_POST['bairro']);
$cep              = trim($_POST['cep']);
$id_estado        = (int)$_POST['id_estado'];
$id_cidade        = (int)$_POST['id_cidade'];
$id_tipo_cliente  = (int)$_POST['id_tipo_cliente'];
$id_setor         = (int)$_POST['id_setor'];
$id_curso         = (int)$_POST['id_curso'];
$descricao        = trim($_POST['descricao_solicitacao']);
$email            = trim($_POST['cliente_email']);
$celular          = trim($_POST['celular_cliente']);


//valida os campos via php
if(empty($nome)){
    retorno_usuario("error", "O Campo nome é obrigatório!");
}

if(empty($endereco)){
    retorno_usuario("error", "O Campo endereco é obrigatório!");
}

if(empty($numero)){
    retorno_usuario("error", "O Campo numero é obrigatório!");
}

if(empty($bairro)){
    retorno_usuario("error", "O Campo bairro é obrigatório!");
}

if(empty($cep)){
    retorno_usuario("error", "O Campo cep é obrigatório!");
}

if(empty($id_estado)){
    retorno_usuario("error", "O Campo estado é obrigatório!");
}

if(empty($id_cidade)){
    retorno_usuario("error", "O Campo cidade é obrigatório!");
}

if(empty($id_tipo_cliente)) {
    retorno_usuario("error", "O Campo tipo de cliente é obrigatório!");
}

if(empty($id_setor)) {
    retorno_usuario("error", "O Campo setor é obrigatório!");
}

if(empty($id_curso)) {
    retorno_usuario("error", "O Campo curso é obrigatório!");
}

if(empty($email)) {
    retorno_usuario("error", "O Campo e-mail é obrigatório!");
}

if(empty($celular)) {
    retorno_usuario("error", "O Campo celular é obrigatório!");
}

if(empty($descricao)) {
    retorno_usuario("error", "O campo descrição da solicitação é obrigatório!");
}


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



$sqlUpdatetSolicitacao = "UPDATE tab_solicitacoes SET
    descricao_servico = :descricao
WHERE id_cliente_fk = :codigo_cliente";

$stmt = $conn->prepare($sqlUpdatetSolicitacao);
$stmt->bindValue(":codigo_cliente", $codigo_cliente,PDO::PARAM_INT);
$stmt->bindValue(":descricao", $descricao);
$updateSolicitacao = $stmt->execute();


if($updateCliente && $updateSolicitacao){
    $conn->commit();
   retorno_usuario("success","Dados Alterados com sucesso!");
} else {
    $conn->rollBack();
    return false;
}