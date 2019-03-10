<?php 
//Include do config/banco
include("../../../config/config.php");
include("../../../config/functions.php");

$id_estado = (int)$_POST['id_estado'];



if($id_estado <= 0)
{
    retorno_usuario("error","Estado não encontrado. Atualize a página e tente novamente!");
}

$conn->beginTransaction();

try {

    $query = "SELECT * FROM tab_cidades WHERE estado = '$id_estado'";

    $stmt = $conn->query($query);
    
    $conn->commit();

  } catch (Exception $e) {
    $conn->rollBack();
    echo "erro: " . $e->getMessage();
  }

  $array_cidades = $stmt->fetchAll();

  $retorno_usuario = array(
      'data'=>$array_cidades,
      'result'=>'success',
      'mensagem'=> ''
 );

 echo json_encode($retorno_usuario);
 

?>
