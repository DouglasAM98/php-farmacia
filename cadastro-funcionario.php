<?php
session_start();
ob_start();
include_once 'util/helper.class.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro de funcionario</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  </head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Funcionario</h1>

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
        <form name="cadfuncionario" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome" class="form-control" pattern="^[a-zA-ZÁ-ù ]{2,20}$">
          </div>
          <div class="form-group">
            <input type="number" name="numcpf" placeholder="CPF" class="form-control" pattern="[0-9]{8,11}$"/>
          </div>
          <div class="form-group">
            <input type="number" name="numrg" placeholder="RG" class="form-control" pattern="[0-9]{8,11}$"/>
          </div>
          <div class="form-group">
            <input type="text" name="txtcargo" placeholder="Cargo" class="form-control" pattern="^[a-zA-ZÁ-ù ]{2,20}$">
          </div>

          <div class="form-group">
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['cadastrar'])){
            include 'modelo/funcionario.class.php';
            include 'dao/funcionariodao.class.php';
            include 'util/padronizacao.class.php';

            $fun = new funcionario();
            $fun->nome = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
            $fun->cpf = $_POST['numcpf'];
            $fun->rg = $_POST['numrg'];
            $fun->cargo = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtcargo']));

            $funDAO = new funcionarioDAO();
            $funDAO->cadastrarFuncionario($fun);

            $_SESSION['msg'] = "funcionario cadastrado com sucesso!";
            header("location:cadastro-funcionario.php");

            ob_end_flush();
          }
        ?>
      </div>
  </body>
</html>
