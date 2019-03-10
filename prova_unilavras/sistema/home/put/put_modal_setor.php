<?php 

include('../../../config/config.php');
include('../../../config/functions.php');

$descricao_setor = trim($_POST['descricao_setor']);

//verifica se o campo descricao do setor esta vazio e se tiver vazioO retorna a msg
if(empty($descricao_setor)){
    retorno_usuario("error","Por favor preencha todos os campos com *.");
}

try{
    //verifica se ja existe um setor cadastrado com o mesmo nome
    $query_verificacao = "SELECT descricao_setor FROM tab_setores
     WHERE descricao_setor like '%$descricao_setor%'";

    $stmt_verificacao = $conn->query($query_verificacao);

    if($stmt_verificacao->rowCount() > 0){
        retorno_usuario("error","Já existe um setor com esse nome.<br> Tente novamente!");
    }



}catch(Exception $e){
    echo "erro: " . $e->getMessage();
}


try{
    
    $query_insert = 
    " INSERT INTO tab_setores (descricao_setor) VALUES ('$descricao_setor')";

    $stmt = $conn->prepare($query_insert);

    if($stmt->execute()) {
        //pega o ultimo id inserido para popular o select de setores
        $ultimo_id_inserido = $conn->lastInsertId();

        //armazena no array o nome do setor e seu ultimo id_inserido
         $dados = array('nome_setor' => $descricao_setor,'id'=>$ultimo_id_inserido);

        retorno_usuario("success","Setor Inserido $descricao_setor com sucesso! ",$dados);
    }

}catch(Exception $e){
    echo "erro: " . $e->getMessage();
}   


