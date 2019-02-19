<?php session_start(); ob_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>-->

</head>
<body>
  <div class="container">

    <h1 style="text-align:center" class="jumbotron bg-info">Seja bem vindo!</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Sair</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">Home<span class="sr-only">(current)</span></a>
          </li>

            <!--CLIENTE-->
          <li class="nav-item">
            <a class="nav-link" href="cadastro-cliente.php">Cadastrar cliente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-cliente.php">Consultar cliente</a>
          </li>

            <!--PRODUTO-->
          <li class="nav-item">
            <a class="nav-link" href="cadastro-produto.php">Cadastrar produto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-produto.php">Consultar produto</a>
          </li>
            <!--FUNCIONARIO-->
            <li class="nav-item">
              <a class="nav-link" href="cadastro-funcionario.php">Cadastrar funcionario</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="consulta-funcionario.php">Consultar funcionario</a>
            </li>

        </ul>
      </div>
    </nav>

  <h3 style="text-align:center">Sistema de farmacia</h3>

  </div>
</body>
</html>
