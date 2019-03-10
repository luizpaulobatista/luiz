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
        <th scope="col">Código Solicitação</th>
        <th scope="col">Tipo de Usuário</th>
        <th scope="col">Telefone</th>
        <th scope="col">E-mail</th>
        <th scope="col">Data Da Solicitação</th>
        <th scope="col">Opções</th>
    </tr>
    </thead>
    <tbody>
    <?php 

        //faz a consulta e popula a tabela com as solicitações cadastrada no sistema
        $query = "SELECT *,
        tab_clientes.nome as nome_cliente
        FROM tab_solicitacoes
        JOIN tab_clientes ON tab_clientes.codigo_cliente = tab_solicitacoes.id_cliente_fk 
        JOIN tab_tipo_cliente ON tab_tipo_cliente.id_tipo_cliente = tab_clientes.id_tipo_cliente";
        
        $stmt = $conn->query($query);
        $contador = 0;

        while($dados = $stmt->fetch(PDO::FETCH_OBJ)) { $contador++;
        ?>
        <tr>
            <th scope="row"><?= $contador ?></th>
            <td><?= $dados->nome_cliente ?></td>
            <td><?= $dados->id_solicitacao ?></td>
            <td><?= $dados->descricao_tipo_cliente ?> </td>
            <td><?= $dados->celular ?></td>
            <td><?= $dados->email ?></td>
            <td><?= date("d/m/Y",strtotime($dados->data_solicitacao)) ?></td>
            <td>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opções
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="javascript:void(0);" onclick="get_dados_solicitacao('<?php echo $dados->id_solicitacao ?>')">Editar Solicitação</a>
                <a class="dropdown-item" href="javascript:void(0);" onclick="confirma_delete_solicitacao('<?php echo $dados->id_solicitacao ?>')">Excluir Solicitação</a>
                </div>
            </div>
            </td>
        </tr>
        <?php } ?>  
    </tbody>
</table>