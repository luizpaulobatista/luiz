<!--includ header -->
<?php include('../includes/header.php') ?>
<?php include('../../config/config.php') ?>

  <style>
 .container {
   /* padding-right:120px;
   padding-left:120px; */
   padding-top:30px;
 }
}
  </style>
    
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="bd-form">
              <h2 class="text-left mb30"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Listagem de Clientes</h2>
                <div id="dados_tabela_clientes">
                  <div id="preload_registros" style="display:none">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw mt-lg"></i>
                    <br>
                    <span>Buscando clientes...</span>
                  </div>
                </div>  
            </div>  
          </div>
        </div>
    </div>  
<!--include footer -->
<?php include('../includes/footer.php'); ?>

<!-- include do modal solicitacao -->
<?php// include('./include/modal_clientes.php'); ?>

<?php include('./include/modal_cliente.php') ?>

<?php include('./include/modal_delete_cliente.php') ?>

<?php include('./include/modal_curso.php') ?>

<?php include('./include/modal_setor.php') ?>


<!--SCRIPTS DA PAGINA -->
<script src="<?php echo $app['default']?>clientes/scripts/clientes.js"></script>