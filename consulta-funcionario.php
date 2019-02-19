<?php
session_start();
ob_start();

include_once 'dao/funcionariodao.class.php';
include_once 'modelo/funcionario.class.php';
include_once 'util/helper.class.php';

$funDAO = new funcionarioDAO();
$array = $funDAO->buscarFuncionario();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Consulta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Consulta de funcionario</h1>

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
            <a class="nav-link" href="cadastro-funcionario.php">Cadastro funcionario</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="consulta-funcionario.php">Consultar funcionario <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <h2>Consulta de funcionario</h2>
    <?php
    if(isset($_SESSION['msg'])){
      Helper::alert($_SESSION['msg']);
      unset($_SESSION['msg']);
    }

    if(count($array) == 0){
        echo "<h2>Não há funcionario no banco!</h2>";
        return;
    }
    ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Cargo</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Cargo</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($array as $f){
            echo "<tr>";
              echo "<td>$f->idFuncionario</td>";
              echo "<td>$f->nome</td>";
              echo "<td>$f->cpf</td>";
              echo "<td>$f->rg</td>";
              echo "<td>$f->cargo</td>";
              echo "<td><a href='consulta-funcionario.php?id=$f->idFuncionario' class='btn btn-danger'>Excluir</a></td>";
              echo "<td><a href='alterar-funcionario.php?id=$f->idFuncionario' class='btn btn-warning'>Alterar</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
  if(isset($_GET['id'])){
    $funDAO->deletarFuncionario($_GET['id']);
    $_SESSION['msg'] = "Funcionario excluído com sucesso!";
    header("location:consulta-funcionario.php");
  }
  ?>
</body>
</html>
