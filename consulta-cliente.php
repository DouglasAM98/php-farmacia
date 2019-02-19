<?php
session_start();
ob_start();

include_once 'dao/clientedao.class.php';
include_once 'modelo/cliente.class.php';
include_once 'util/helper.class.php';

$cliDAO = new clienteDAO();
$array = $cliDAO->buscarCliente();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Consulta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!---  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script> -->

</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Consulta de Cliente</h1>

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
            <a class="nav-link" href="cadastro-cliente.php">Cadastrar cliente</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="consulta-cliente.php">Consultar cliente <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <h2>Consulta de cliente</h2>
    <?php
    if(isset($_SESSION['msg'])){
      Helper::alert($_SESSION['msg']);
      unset($_SESSION['msg']);
    }

    if(count($array) == 0){
        echo "<h2>Não há cliente no banco!</h2>";
        return;
    }
    ?>

        <form name="filtrar" method="post" action="">

          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="txtfiltro"
                     placeholder="Digite a sua pesquisa" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <select name="selfiltro" class="form-control">
                <option value="todos">Todos</option>
                <option value="codigo">Código</option>
                <option value="nome">Nome</option>
                <option value="cpf">CPF</option>
                <option value="rg">RG</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
          </div>
        </form>
        <?php
        if(isset($_POST['filtrar'])){
          $pesquisa = $_POST['txtfiltro'];
          $filtro = $_POST['selfiltro'];

          if(!empty($pesquisa)){
            $cliDAO = new ClienteDAO();
            $array = $cliDAO->filtrar($pesquisa,$filtro);

            if(count($array) == 0){
              echo "<h3>Sua pesquisa não retornou nenhum cliente!</h3>";
              return;
            }

          }else{
            echo "Digite uma pesquisa!";
          }//fecha else

        }//fecha if
        ?>

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>Código</th>
            <th>nome</th>
            <th>cpf</th>
            <th>rg</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>cpf</th>
            <th>rg</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($array as $c){
            echo "<tr>";
              echo "<td>$c->idCliente</td>";
              echo "<td>$c->nome</td>";
              echo "<td>$c->cpf</td>";
              echo "<td>$c->rg</td>";
              echo "<td><a href='consulta-cliente.php?id=$c->idCliente' class='btn btn-danger'>Excluir</a></td>";
              echo "<td><a href='alterar-cliente.php?id=$c->idCliente' class='btn btn-warning'>Alterar</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
  if(isset($_GET['id'])){
    $cliDAO->deletarCliente($_GET['id']);
    $_SESSION['msg'] = "Cliente excluído com sucesso!";
    header("location:consulta-cliente.php");
  }
  ?>
</body>
</html>
