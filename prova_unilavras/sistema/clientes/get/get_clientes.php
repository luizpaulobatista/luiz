<?php 
//Include do config/banco
include("../../../config/config.php");
include("../../../config/functions.php");

?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Usuário</th>
        <th scope="col">Tipo de Usuário</th>
        <th scope="col">Telefone</th>
        <th scope="col">E-mail</th>
        <th scope="col">Opções</th>
    </tr>
    </thead>
    <tbody>
    <?php 

        //faz a consulta e popula a tabela com as solicitações cadastrada no sistema
        $query = "SELECT *,
        tab_clientes.nome as nome_cliente
        FROM tab_clientes 
        JOIN tab_estados ON tab_estados.id = tab_clientes.id_estado
        JOIN tab_cidades ON tab_cidades.id = tab_clientes.id_cidade
        JOIN tab_tipo_cliente ON tab_tipo_cliente.id_tipo_cliente = tab_clientes.id_tipo_cliente
        JOIN tab_cursos ON tab_cursos.id_curso = tab_clientes.id_curso 
        JOIN tab_setores ON tab_setores.id_setor = tab_clientes.id_setor";
        
        $stmt = $conn->query($query);
        $contador = 0;

        while($dados = $stmt->fetch(PDO::FETCH_OBJ)) { $contador++;
        ?>
        <tr>
            <th scope="row"><?= $contador ?></th>
            <td><?= $dados->nome_cliente ?></td>
            <td><?= $dados->descricao_tipo_cliente ?> </td>
            <td><?= $dados->celular ?></td>
            <td><?= $dados->email ?></td>
            <td>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opções
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="javascript:void(0);" onclick="get_dados_cliente('<?php echo $dados->codigo_cliente ?>')">Editar Cliente</a>
                <a class="dropdown-item" href="javascript:void(0);" onclick="confirma_delete_cliente('<?php echo $dados->codigo_cliente ?>')">Excluir Cliente</a>
                </div>
            </div>
            </td>
        </tr>
        <?php } ?>  
    </tbody>
</table>