<?php 

include('../../../config/config.php');
include('../../../config/functions.php');

$codigo_cliente = trim($_POST['codigo_cliente']);

//verifica se o id esta vazio e retornoa mensagem de erro

if($codigo_cliente <= 0) {
    retorno_usuario("error","Cliente não encontrado. Atualize a página e tente novamente!");

}

//verifica se o cliente possui solicitacao se caso possuir nao dexiar excluir
$query_verificacao = "SELECT * FROM tab_solicitacoes WHERE id_cliente_fk = :codigo_cliente";

$stmt_verificacao = $conn->prepare($query_verificacao);
$stmt_verificacao->bindValue(":codigo_cliente", $codigo_cliente,PDO::PARAM_INT);

if(!$stmt_verificacao->execute()) {
    echo "erro:" .$conn->errorInfo(1); 
}


//VERIFICA SE SERÁ UPDATE OU INSERT
$num_registros = $stmt_verificacao->rowCount();

if($num_registros > 0) {
    retorno_usuario("error", "Não é possivel excluir o cliente nesse momento, pois o cliente possui solicitações cadastradas no sistema!");
}

  try{
    
    $query = "DELETE from tab_clientes where codigo_cliente = '$codigo_cliente'";

    $stmt = $conn->prepare($query);

    if($stmt->execute()) {
        retorno_usuario("success","Cliente excluído com sucesso!");
    }

}catch(Exception $e){
    echo "erro: " . $e->getMessage();
}   

