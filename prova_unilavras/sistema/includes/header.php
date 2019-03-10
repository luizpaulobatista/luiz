<?php 

include($_SERVER['DOCUMENT_ROOT']."/prova_unilavras/config/config.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Prova</title>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="<?php echo $app['css']?>main.css"/>
  <link rel="stylesheet" href="<?php echo $app['css']?>jquery.toast.css"/>
  <link rel="stylesheet" href="<?php echo $app['css']?>font-awesome.min.css"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body >
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
    <a class="navbar-brand" href="#">Sistema de Solicitações de Serviço</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $app['default']?>home/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $app['default']?>administracao/">Administração <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $app['default']?>clientes/">Clientes<span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>