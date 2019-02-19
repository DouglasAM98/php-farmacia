<?php
require 'conexaobanco.class.php';
 class clienteDAO {

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarCliente($cli){
     try{

       $stat=$this->conexao->prepare("insert into cliente
                                    (idCliente,nome,cpf,rg)
                                    values(null,?,?,?)");
       $stat->bindValue(1, $cli->nome);
       $stat->bindValue(2, $cli->cpf);
       $stat->bindValue(3, $cli->rg);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }//fecha catch
   }//fecha cadastrarCliente

   public function buscarCliente(){
     try{
       $stat = $this->conexao->query("select * from cliente");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'cliente');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar cliente! ".$e;
     }//fecha catch
   }//fecha buscarCliente

   public function deletarCliente($id){
     try{
       $stat = $this->conexao->prepare("delete from cliente where idCliente = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao excluir cliente! ".$e;
     }//fecha catch
   }//fecha deletarCliente


   public function filtrar($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos": $query = "";
         break;

         case "codigo": $query = "where idCliente = ".$pesquisa;
         break;

         case "nome": $query = "where nome like '%".$pesquisa."%'";
         break;

         case "cpf": $query = "where cpf like '%".$pesquisa."%'";
         break;

         case "rg": $query = "where rg like '%".$pesquisa."%'";
         break;
       }//fecha filtrar

       $stat = $this->conexao->query("select * from cliente {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Cliente');
       return $array;

     }catch(PDOException $e){
       echo "Erro ao filtrar cliente. ".$e;
     }//fecha catch
   }//fecha filtrar

   public function alterarCliente($cli){
     try {
       $stat = $this->conexao->prepare("update cliente set nome=?, cpf=?, rg=? where idCliente=?");

       $stat->bindValue(1, $cli->nome);
       $stat->bindValue(2, $cli->cpf);
       $stat->bindValue(3, $cli->rg);
       $stat->bindValue(4, $cli->idCliente);

       $stat->execute();

     } catch (PDOException $e) {
        echo "Erro ao alterar cliente ".$e;
     }//fecha catch

   }//fecha alterarCliente

 }//fecha classe
