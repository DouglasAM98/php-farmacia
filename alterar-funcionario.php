<?php
session_start();
ob_start();
include_once 'util/helper.class.php';

if(isset($_GET['id'])){
  include_once "dao/funcionariodao.class.php";
  include_once "modelo/funcionario.class.php";

  $funDAO = new FuncionarioDAO();
  $array = $funDAO->filtrar($_GET['id'], "codigo");


  $liv = $array[0];

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Edição de funcionarios</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>-->

  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Funcionario</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sistema</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-funcionario.php">Cadastrar funcionario <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-funcionario.php">Consultar funcionario</a>
              </li>
            </ul>
          </div>
        </nav>
        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
        ?>
        <form name="cadfun" method="post" action="">
          <div class="form-group">
            <input type="text" name="nome" placeholder="Nome" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="cpf" placeholder="CPF" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="rg" placeholder="RG" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="cargo" placeholder="Cargo" class="form-control">
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['alterar'])){
            include_once 'modelo/funcionario.class.php';
            include_once 'dao/funcionariodao.class.php';
            include 'util/padronizacao.class.php';

            $fun = new Funcionario();
            $fun->idFuncionario = $_GET['id'];
            $fun->nome = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['nome']));
            $fun->cpf = $_POST['cpf'];
            $fun->rg = $_POST['rg'];
            $fun->cargo = $_POST['cargo'];
            $funDAO = new FuncionarioDAO();
            $funDAO->alterarFuncionario($fun);

            $_SESSION['msg'] = "Funcionario alterado com sucesso!";
            header("location:consulta-funcionario.php");

            ob_end_flush();
          }
        ?>
      </div>
  </body>
</html>
