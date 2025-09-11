<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';

class AcessoInternetModel {
    
    private $banco_de_dados;
    private $id_acesso_internet;
    
    public function __construct($id_acesso_internet){
        $this->id_acesso_internet = $id_acesso_internet;
        $this->banco_de_dados = new BancoDeDados();
    }
    
    // CRUD
    public function cadastrarAcessoInternet(array $valores_acesso_internet): bool {
        $sql = "INSERT INTO AcessoInternet (
            sobre_condicao_estudo_id,
            local_acesso
        ) VALUES (
            :sobre_condicao_estudo_id,
            :local_acesso
        )";
        
        $params = [
            ':sobre_condicao_estudo_id' => $valores_acesso_internet['sobre_condicao_estudo_id'],
            ':local_acesso' => $valores_acesso_internet['local_acesso']
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }
    
    public function getUltimoIdInsercaoAcessoInternet(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorCondicaoEstudoIdBanco($id_condicao_estudo) {
    $sql = "SELECT * FROM AcessoInternet WHERE sobre_condicao_estudo_id = :id";
    $parametros = [':id' => $id_condicao_estudo];
    return $this->banco_de_dados->consultar($sql, $parametros);
    }
    
}