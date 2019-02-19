<?php

class Funcionario{
  private $idFuncionario;
  private $nome;
  private $cpf;
  private $rg;
  private $cargo;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){
    return $this->$a;
  }

  public function __set($a, $v){
    $this->$a = $v;
  }

  public function __toString(){
    return nl2br("Codigo do funcionário: $this->idFuncionario
                  Nome: $this->nome
                  CPF:  $this->cpf
                  RG:   $this->rg
                  Cargo:$this->cargo");
  }//fecha toString

}//fecha classe



