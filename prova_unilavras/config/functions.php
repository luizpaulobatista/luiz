<?php

function retorno_usuario($tipo_mensagem,$mensagem,$data='')
{
    $dados = array(
        "result" => $tipo_mensagem,
        "mensagem" => $mensagem,
        "data" => $data
    );

    echo json_encode($dados);

    exit;
}

?>