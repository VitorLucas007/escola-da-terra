<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/pesquisa_educacional/config/ConexaoBanco.php';

class BancoDeDados{
    
    private $conexao_banco;

    public function __construct(){
        $inicializacao_conexao = new ConexaoBanco();
        $inicializacao_conexao->setConexaoBanco();
        $this->conexao_banco = $inicializacao_conexao->getConexaoBanco();
    }

    public function cadastrarDadosBanco($comando_sql){
        
    }

}


?>