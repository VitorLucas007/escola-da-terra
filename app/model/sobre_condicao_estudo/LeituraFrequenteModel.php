<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';

class LeituraFrequenteModel {
    
    private $banco_de_dados;
    private $id_ler_frequentemente;
    
    public function __construct($id_ler_frequentemente){
        $this->id_ler_frequentemente = $id_ler_frequentemente;
        $this->banco_de_dados = new BancoDeDados();
    }
    
    // CRUD
    public function cadastrarLeituraFrequente(array $valores_leitura_frequente): bool {
        $sql = "INSERT INTO LeituraFrequente (
            sobre_condicao_estudo_id,
            veiculo_lido,
            frequencia_leitura
        ) VALUES (
            :sobre_condicao_estudo_id,
            :veiculo_lido,
            :frequencia_leitura
        )";
        
        $params = [
            ':sobre_condicao_estudo_id' => $valores_leitura_frequente['sobre_condicao_estudo_id'],
            ':veiculo_lido' => $valores_leitura_frequente['veiculo_lido'],
            ':frequencia_leitura' => $valores_leitura_frequente['frequencia_leitura']
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }
    
    public function getUltimoIdInsercaoLeituraFrequente(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorCondicaoEstudoIdBanco($id_condicao_estudo) {
    $sql = "SELECT * FROM LeituraFrequente WHERE sobre_condicao_estudo_id = :id";
    $parametros = [':id' => $id_condicao_estudo];
    return $this->banco_de_dados->consultar($sql, $parametros);
    }

}
?>