<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/config/ConexaoBanco.php';

class BancoDeDados{
    
    private $conexao_banco;

    public function __construct(){
        $inicializacao_conexao = new ConexaoBanco();
        $this->conexao_banco = $inicializacao_conexao->getConexaoBanco();
    }

    public function executar(string $sql, array $params = []): bool {
        $stmt = $this->conexao_banco->prepare($sql);
        return $stmt->execute($params);
    }

    public function getUltimoIdInsercao(): string {
        return $this->conexao_banco->lastInsertId();
    }

}


?>