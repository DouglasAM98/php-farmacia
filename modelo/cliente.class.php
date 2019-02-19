<?php
class Cliente{
  private $idCliente;
  private $nome;
  private $cpf;
  private $rg;


  public function __construct(){}
  public function __destruct(){}

  public function __get($a){
    return $this->$a;
  }

  public function __set($a, $v){
    $this->$a = $v;
  }

  public function __toString(){
    return nl2br("Codigo do cliente: $this->idCliente
                  Nome: $this->nome
                  CPF:  $this->cpf
                  RG:   $this->rg");
  }//fecha toString

}//fecha classe
