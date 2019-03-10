<?php 

include('../../../config/config.php');
include('../../../config/functions.php');

$id_solicitacao = trim($_POST['id_solicitacao']);

//verifica se o id esta vazio e retornoa mensagem de erro

if($id_solicitacao <= 0) {
    retorno_usuario("error","Solicitação não encontrada. Atualize a página e tente novamente!");

}


  try{
    
    $query = "DELETE from tab_solicitacoes where id_solicitacao = '$id_solicitacao'";

    $stmt = $conn->prepare($query);

    if($stmt->execute()) {
        retorno_usuario("success","Solicitação excluída com sucesso!");
    }

}catch(Exception $e){
    echo "erro: " . $e->getMessage();
}   

