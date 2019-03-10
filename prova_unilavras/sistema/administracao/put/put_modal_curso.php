<?php 

include('../../../config/config.php');
include('../../../config/functions.php');

$descricao_curso = trim($_POST['descricao_curso']);


//verifica se o campo descricao do curso esta vazio e se tiver vazioO retorna a msg
if(empty($descricao_curso)) {
    retorno_usuario("error","Por favor preencha todos os campos com *.");
}

try{
    //verifica se ja existe um curso cadastrado com o mesmo nome
    $query_verificacao = "SELECT descricao_curso FROM tab_cursos
     WHERE descricao_curso like '%$descricao_curso%'";

    $stmt_verificacao = $conn->query($query_verificacao);

    if($stmt_verificacao->rowCount() > 0){
        retorno_usuario("error","Já existe um curso com esse nome.<br> Tente novamente!");
    }


}catch(Exception $e){
    echo "erro: " . $e->getMessage();
}


try{
    
    $query_insert = 
    " INSERT INTO tab_cursos (descricao_curso) VALUES ('$descricao_curso')";

    $stmt = $conn->prepare($query_insert);

    if($stmt->execute()) {
        //pega o ultimo id inserido para popular o select de setores
        $ultimo_id_inserido = $conn->lastInsertId();

        //armazena no array o nome do setor e seu ultimo id_inserido
         $dados = array('nome_curso' => $descricao_curso,'id'=>$ultimo_id_inserido);

        retorno_usuario("success","Curso $descricao_curso inserido com sucesso! ",$dados);
    }

}catch(Exception $e){
    echo "erro: " . $e->getMessage();
}   


