<?php
session_start();
ob_start();
include_once 'util/helper.class.php';

if(isset($_GET['id'])){
  include_once "dao/clientedao.class.php";
  include_once "modelo/cliente.class.php";

  $cliDAO = new ClienteDAO();
  $array = $cliDAO->filtrar($_GET['id'], "codigo");

  $cli = $array[0];

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Edição de cliente</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>-->

</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Cliente</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="index.php">Sair</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-cliente.php">Cadastrar cliente <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-cliente.php">Consultar cliente</a>
              </li>
            </ul>
          </div>
        </nav>
        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
        ?>
        <form name="cadcliente" method="post" action="">
          <div class="form-group">
            <input type="text" required="required" name="txtnome" placeholder="Nome" class="form-control" pattern="^[a-zA-ZÁ-ù ]{2,20}$">
          </div>
          <div class="form-group">
            <input type="number" required="required" name="numcpf" placeholder="CPF" class="form-control" pattern="[0-9]{8,11}$"/>
          </div>
          <div class="form-group">
            <input type="number" required="required" name="numrg" placeholder="RG" class="form-control" pattern="[0-9]{8,11}$"/>
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['alterar'])){
            include_once 'modelo/cliente.class.php';
            include_once 'dao/clientedao.class.php';
            include 'util/padronizacao.class.php';

            $cli = new Cliente();
            $cli->idCliente = $_GET['id'];
            $cli->nome = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
            $cli->cpf = $_POST['numcpf'];
            $cli->rg = $_POST['numrg'];
            $cliDAO = new ClienteDAO();
            $cliDAO->alterarCliente($cli);

            $_SESSION['msg'] = "Cliente alterado com sucesso!";
            header("location:consulta-cliente.php");

            ob_end_flush();
          }
        ?>
      </div>
  </body>
</html>
