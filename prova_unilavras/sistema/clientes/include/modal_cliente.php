
<div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-labelledby="Modal Solicitação" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Detalhes da Solicitação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="id_form_modal_cliente" data-toggle="validator">
            <div class="form-row">
            
                <div class="form-group col-md-3">
                    <label for="codigo">Código: *</label>
                    <input type="text" required class="form-control form-control-lg " id="codigo" name="codigo" placeholder="Código" readonly >
                <div class="help-block with-errors"></div>
                </div>
                
                <div class="form-group col-md-9">
                <label for="nome">Nome: *</label>
                <input type="text" required  class="form-control form-control-lg" id="nome" name="nome" placeholder="Nome">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="nome">Email: *</label>
                <input type="email" required  class="form-control form-control-lg" id="cliente_email" name="cliente_email" placeholder="exemplo@.com.br">
                <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                <label for="nome">Celular: *</label>
                <input type="text" required  class="form-control form-control-lg" id="celular_cliente" name="celular_cliente" placeholder="(99)99999-9999">
                <div class="help-block with-errors"></div>
                </div>
            </div>  
            <div class="form-row ">
                <div class="form-group col-md-6">
                <label for="endereco">Endereço: *</label>
                <input required type="text" class="form-control form-control-lg" id="endereco" name="endereco" placeholder="Rua, Avenida..">
                <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-2">
                <label for="numero">Número: *</label>
                <input required type="text" class="form-control form-control-lg" id="numero" name="numero" placeholder="Número">
                <div class="help-block with-errors"></div>
                </div>
            
                <div class="form-group col-md-4">
                <label for="bairro">Bairro: *</label>
                <input required type="text" class="form-control form-control-lg" id="bairro" name="bairro" placeholder="Bairro">
                <div class="help-block with-errors"></div>
                </div>
            </div>  
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="estado">Estado: *</label>
            
                    <select required id="id_estado" name="id_estado" class="form-control form-control-lg" onchange="get_cidades('id_estado','id_cidade')">
                        <option value="">Selecione...</option> 
                        <?php 
                            $query = "SELECT * FROM tab_estados";

                            $stmt = $conn->prepare($query);

                            $stmt->execute();

                            while($dados = $stmt->fetch(PDO::FETCH_OBJ))
                            {  ?>
                                <option value="<?php echo $dados->id ?>"><?php echo mb_strtoupper($dados->uf,'UTF8'); ?></option>   
                                <?php
                            } 
                        ?>
                    </select>
                    <div class="help-block with-errors"></div>
                </div> 
                <div class="form-group col-md-6"> 
                <label for="cidade">Cidade: *</label>
                <select required id="id_cidade" name="id_cidade" class="form-control form-control-lg" >
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="row">  
                <div class="form-group col-md-6" style="padding-right:0px">   
                <label for="cep">Cep: *</label>
                <input required type="text" class="form-control form-control-lg" id="cep" name="cep" placeholder="999999-999">
                <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipo_cliente">Tipo te Cliente: *</label>
            
                    <select required id="id_tipo_cliente" name="id_tipo_cliente" class="form-control form-control-lg">
                        <option value="">Selecione...</option> 
                        <?php 
                            $query = "SELECT * FROM tab_tipo_cliente";

                            $stmt = $conn->prepare($query);

                            $stmt->execute();

                            while($dados = $stmt->fetch(PDO::FETCH_OBJ))
                            {  ?>
                            <option value="<?php echo $dados->id_tipo_cliente ?>"><?php echo mb_strtoupper($dados->descricao_tipo_cliente,'UTF8'); ?></option>   
                            <?php
                            } 
                        ?>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>             

            </div>

            <div class="form-row ">
                <div class="form-group col-md-6"> 
                <label for="setor">Setor: *</label>
                <div class="input-group">
                    <select required class="custom-select custom-select-lg" id="id_setor" name="id_setor">
                    <option selected="">Selecione...</option>
                    <?php 
                        $query = "SELECT * FROM tab_setores";

                        $stmt = $conn->prepare($query);

                        $stmt->execute();

                        while($dados = $stmt->fetch(PDO::FETCH_OBJ))
                        {  ?>
                            <option value="<?php echo $dados->id_setor ?>"><?php echo mb_strtoupper($dados->descricao_setor,'UTF8'); ?></option>   
                            <?php
                        } 
                    ?>
                    </select>
                    <div class="input-group-append">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_setor_cliente"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                    
                
                </div>
                <div class="help-block with-errors"></div>
                </div>  
                <div class="form-group col-md-6">
                <div>
                    <label for="cidade">Curso: *</label>
                    <div class="input-group">
                    <select required class="custom-select custom-select-lg" id="id_curso" name="id_curso">
                        <option selected="">Selecione...</option>
                        <?php 
                        $query = "SELECT * FROM tab_cursos";

                        $stmt = $conn->prepare($query);

                        $stmt->execute();

                        while($dados = $stmt->fetch(PDO::FETCH_OBJ))
                        {  ?>
                            <option value="<?php echo $dados->id_curso ?>"><?php echo mb_strtoupper($dados->descricao_curso,'UTF8'); ?></option>   
                            <?php
                        } 
                        ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_curso_cliente"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                    </div>
                </div>  
                </div>
                
            </div> 
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Alterar Solicitação</button>
            </form>
      </div>
    </div>
   </div> 
</div>

