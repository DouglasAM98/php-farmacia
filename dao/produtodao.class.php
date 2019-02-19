<?php
require 'conexaobanco.class.php';
 class produtoDAO { 
   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarProduto($prod){
     try{
       $stat=$this->conexao->prepare("insert into produto
                                    (idProduto,nomeProduto,fabricante,origem, preco,quantidade)
                                    values(null,?,?,?,?,?)");
       $stat->bindValue(1, $prod->nomeProduto);
       $stat->bindValue(2, $prod->fabricante);
       $stat->bindValue(3, $prod->origem);
       $stat->bindValue(4, $prod->preco);
       $stat->bindValue(5, $prod->quantidade);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }//fecha catch
   }//fecha cadastrarProduto

   public function buscarProduto(){
     try{
       $stat = $this->conexao->query("select * from produto");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'produto');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar produto! ".$e;
     }//fecha catch
   }

   public function deletarProduto($id){
     try{
       $stat = $this->conexao->prepare("delete from produto where idProduto = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao excluir produto! ".$e;
     }//fecha catch
   }//fecha deletarProduto

   public function filtrar($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos": $query = "";
         break;

         case "codigo": $query = "where idProduto = ".$pesquisa;
         break;

         case "nomeProduto": $query = "where nomeProduto like '%".$pesquisa."%'";
         break;

         case "fabricante": $query = "where fabricante like '%".$pesquisa."%'";
         break;

         case "origem": $query = "where origem like '%".$pesquisa."%'";
         break;

         case "preco": $query = "where preco like '%".$pesquisa."%'";
         break;

         case "quantidade": $query = "where quantidade like '%".$pesquisa."%'";
         break;
       }//fecha filtrar

       $stat = $this->conexao->query("select * from produto {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Produto');
       return $array;

     }catch(PDOException $e){
       echo "Erro ao filtrar produto. ".$e;
     }//fecha catch
   }//fecha filtrar

   public function alterarProduto($prod){
     try {
       $stat = $this->conexao->prepare("update produto set nomeProduto=?, fabricante=?, origem=?, preco=?, quantidade=? where idProduto=?");

       $stat->bindValue(1, $prod->nomeProduto);
       $stat->bindValue(2, $prod->fabricante);
       $stat->bindValue(3, $prod->origem);
       $stat->bindValue(4, $prod->preco);
       $stat->bindValue(5, $prod->quantidade);
       $stat->bindValue(6, $prod->idProduto);

       $stat->execute();
     } catch (PDOException $e) {
        echo "Erro ao alterar produto ".$e;
     }//fecha catch

   }//fecha alterarProduto

 }//fecha classe
