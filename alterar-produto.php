<?php
session_start();
ob_start();
include_once 'util/helper.class.php';

if(isset($_GET['id'])){
  include_once "dao/produtodao.class.php";
  include_once "modelo/produto.class.php";

  $prodDAO = new ProdutoDAO();
  $array = $prodDAO->filtrar($_GET['id'], "codigo");

  //var_dump($array);

  $prod = $array[0];

  //echo "<br>".$prod;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Edição de produto</title>
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
        <h1 class="jumbotron bg-info">Produto</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sair</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-produto.php">Cadastrar produto <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-produto.php">Consultar produto</a>
              </li>
            </ul>
          </div>
        </nav>
        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
        ?>
        <form name="cadprod" method="post" action="">
          <div class="form-group">
            <input type="text" required="required" name="nome" placeholder="Nome do produto" class="form-control" pattern="^[a-zA-ZÁ-ù ]{2,20}$">
          </div>
          <div class="form-group">
            <input type="text" required="required" name="fabricante" placeholder="Fabricante" class="form-control" pattern="^[a-zA-ZÁ-ù ]{2,20}$">
          </div>
          <div class="form-group">
          <input type="text" required="required" name="origem" placeholder="Origem" class="form-control" pattern="^[a-zA-ZÁ-ù ]{2,20}$">
          </div>

          <div class="form-group">
            <input type="number" required="numpreco" name="preco" placeholder="Preço" class="form-control" pattern="[0-9]{1,7}$"/>
          </div>
          <div class="form-group">
            <input type="number" required="required" name="quantidade" placeholder="Quantidade" class="form-control" pattern="[0-9]{1,30}$"/>
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          //falta código
          if(isset($_POST['alterar'])){
            include_once 'modelo/produto.class.php';
            include_once 'dao/produtodao.class.php';
            include 'util/padronizacao.class.php';

            $prod = new Produto();
            $prod->idProduto = $_GET['id'];
            $prod->nomeProduto = $_POST['nome'];
            $prod->fabricante = $_POST['fabricante'];
            $prod->origem = $_POST['origem'];
            $prod->preco = $_POST['preco'];
            $prod->quantidade = $_POST['quantidade'];
            $prodDAO = new ProdutoDAO();
            $prodDAO->alterarProduto($prod);

            $_SESSION['msg'] = "Produto alterado com sucesso!";
            header("location:consulta-produto.php");

            ob_end_flush();
          }
        ?>
      </div>
  </body>
</html>
