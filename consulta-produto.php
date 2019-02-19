<?php
session_start();
ob_start();

include_once 'dao/produtodao.class.php';
include_once 'modelo/produto.class.php';
include_once 'util/helper.class.php';

$livDAO = new produtoDAO();
$array = $livDAO->buscarProduto();

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
    <h1 class="jumbotron bg-info">Consultar produto</h1>

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
            <a class="nav-link" href="cadastro-produto.php">Cadastrar produto</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="consulta-produto.php">Consultar produto <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <h2>Consultar produto</h2>
    <?php
    if(isset($_SESSION['msg'])){
      Helper::alert($_SESSION['msg']);
      unset($_SESSION['msg']);
    }

    if(count($array) == 0){
        echo "<h2>Não há produto no banco!</h2>";
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
              <option value="nomeProduto">Nome</option>
              <option value="fabricante">Fabricante</option>
              <option value="origem">Origem</option>
              <option value="preco">Preco</option>
              <option value="quantidade">quantidade</option>
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
                $prodDAO = new ProdutoDAO();
                $array = $prodDAO->filtrar($pesquisa,$filtro);

                if(count($array) == 0){
                  echo "<h3>Sua pesquisa não retornou nenhum produto!</h3>";
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
            <th>Nome</th>
            <th>Fabricante</th>
            <th>Origem</th>
            <th>Preco</th>
            <th>Quantidade</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Codigo</th>
            <th>Nome</th>
            <th>Fabricante</th>
            <th>Origem</th>
            <th>Preco</th>
            <th>Quantidade</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($array as $p){
            echo "<tr>";
              echo "<td>$p->idProduto</td>";
              echo "<td>$p->nomeProduto</td>";
              echo "<td>$p->fabricante</td>";
              echo "<td>$p->origem</td>";
              echo "<td>$p->preco</td>";
              echo "<td>$p->quantidade</td>";
              //echo "<td>{$p->calcular()}</td>";
              echo "<td><a href='consulta-produto.php?id=$p->idProduto' class='btn btn-danger'>Excluir</a></td>";
              echo "<td><a href='alterar-produto.php?id=$p->idProduto' class='btn btn-warning'>Alterar</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
  if(isset($_GET['id'])){
    $livDAO->deletarProduto($_GET['id']);
    $_SESSION['msg'] = "Produto excluído com sucesso!";
    ob_end_flush();
    header("location:consulta-produto.php");
  }
  ?>
</body>
</html>
