<?php 
//Include do config/banco
include("../../../config/config.php");
include("../../../config/functions.php");

$id_solicitacao = (int)$_POST['id_solicitacao'];


$conn->beginTransaction();

try {

    $query = "SELECT *,
     tab_clientes.nome as nome_cliente,
     tab_cidades.nome as nome_cidade
     FROM tab_solicitacoes
     JOIN tab_clientes ON tab_clientes.codigo_cliente = tab_solicitacoes.id_cliente_fk
     JOIN tab_estados ON tab_estados.id = tab_clientes.id_estado
     JOIN tab_setores ON tab_setores.id_setor = tab_clientes.id_setor
     JOIN tab_cursos ON tab_cursos.id_curso = tab_clientes.id_curso
     JOIN tab_cidades ON tab_cidades.id = tab_clientes.id_cidade
     JOIN tab_tipo_cliente ON tab_tipo_cliente.id_tipo_cliente = tab_clientes.id_tipo_cliente
     WHERE tab_solicitacoes.id_solicitacao = '$id_solicitacao'";

    $stmt = $conn->query($query);
    
    $conn->commit();

  } catch (Exception $e) {
    $conn->rollBack();
    echo "erro: " . $e->getMessage();
  }

  $dados = $stmt->fetch();

  $retorno_usuario = array(
      'data'=>$dados,
      'result'=>'success',
      'mensagem'=> ''
 );

 echo json_encode($retorno_usuario);
 

?>