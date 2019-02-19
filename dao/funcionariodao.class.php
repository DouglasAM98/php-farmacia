<?php
require 'conexaobanco.class.php';
 class funcionarioDAO {

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarFuncionario($fun){
     try{

       $stat=$this->conexao->prepare("insert into funcionario
                                    (idFuncionario,nome,cpf,rg,cargo)
                                    values(null,?,?,?,?)");
       $stat->bindValue(1, $fun->nome);
       $stat->bindValue(2, $fun->cpf);
       $stat->bindValue(3, $fun->rg);
       $stat->bindValue(4, $fun->cargo);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }
   }

   public function buscarFuncionario(){
     try{
       $stat = $this->conexao->query("select * from funcionario");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'funcionario');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar funcionario! ".$e;
     }//fecha catch
   }

   public function deletarFuncionario($id){
     try{
       $stat = $this->conexao->prepare("delete from funcionario where idFuncionario = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao excluir funcionario! ".$e;
     }//fecha catch
   }//fecha deletarFuncionario


   public function filtrar($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos": $query = "";
         break;

         case "codigo": $query = "where idFuncionario = ".$pesquisa;
         break;

         case "nome": $query = "where nome like '%".$pesquisa."%'";
         break;

         case "cpf": $query = "where cpf like '%".$pesquisa."%'";
         break;

         case "rg": $query = "where rg like '%".$pesquisa."%'";
         break;

         case "cargo": $query = "where cargo like '%".$pesquisa."%'";
         break;


       }//fecha filtrar

       $stat = $this->conexao->query("select * from funcionario {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Funcionario');
       return $array;

     }catch(PDOException $e){
       echo "Erro ao filtrar funcionario. ".$e;
     }//fecha catch
   }//fecha filtrar

   public function alterarFuncionario($fun){
     try {
       $stat = $this->conexao->prepare("update funcionario set nome=?, cpf=?, rg=?, cargo=? where idFuncionario=?");

       $stat->bindValue(1, $fun->nome);
       $stat->bindValue(2, $fun->cpf);
       $stat->bindValue(3, $fun->rg);
       $stat->bindValue(4, $fun->cargo);
       $stat->bindValue(5, $fun->idFuncionario);

       $stat->execute();

     } catch (PDOException $e) {
        echo "Erro ao alterar funcionario ".$e;
     }//fecha catch

   }//fecha alterarFuncionario

 }//fecha classe
