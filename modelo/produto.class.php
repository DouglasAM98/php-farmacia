<?php
class Produto{
  private $idProduto;
  private $nomeProduto;
  private $fabricante;
  private $origem;
  private $preco;
  private $quantidade;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){
    return $this->$a;
  }

  public function __set($a, $v){
    $this->$a = $v;
  }

  public function calcular(){
    return $this->preco * $this->quantidade;
  }

  public function __toString(){
    return nl2br("Codigo do produto: $this->idProduto
                  Nome do produto: $this->nomeProduto
                  Fabricante:  $this->fabricante
                  Origem: $this->origem
                  Preço:   $this->preco
                  Quantidade: $this->quantidade");
  }//fecha toString

}//fecha classe
