<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/app/model/BancoDeDados.php';

class SobreCondicaoEstudoModel {
    
    private $banco_de_dados;
    private $id_informacao_condicao_estudo;
    
    public function __construct($id_informacao_condicao_estudo){
        $this->id_informacao_condicao_estudo = $id_informacao_condicao_estudo;
        $this->banco_de_dados = new BancoDeDados();
    }
    
    // CRUD
    public function cadastrarSobreCondicaoEstudo(array $valores_condicao_estudo): bool {
        $sql = "INSERT INTO SobreCondicaoEstudo (
            participante_id,
            estuda_mais_frequencia,
            frequenta_biblioteca,
            local_biblioteca_frequentada,
            frequencia_leitura_livros,
            livros_lidos_este_ano,
            possui_biblioteca_particular,
            tem_sala_trabalho,
            quantidade_estimada_livros,
            utiliza_computador_proprio,
            frequencia_conexao_internet
        ) VALUES (
            :participante_id,
            :estuda_mais_frequencia,
            :frequenta_biblioteca,
            :local_biblioteca_frequentada,
            :frequencia_leitura_livros,
            :livros_lidos_este_ano,
            :possui_biblioteca_particular,
            :tem_sala_trabalho,
            :quantidade_estimada_livros,
            :utiliza_computador_proprio,
            :frequencia_conexao_internet
        )";
        
        $params = [
            ':participante_id' => $valores_condicao_estudo['participante_id'],
            ':estuda_mais_frequencia' => $valores_condicao_estudo['estuda_mais_frequencia'],
            ':frequenta_biblioteca' => $valores_condicao_estudo['frequenta_biblioteca'],
            ':local_biblioteca_frequentada' => $valores_condicao_estudo['local_biblioteca_frequentada'] ?? null,
            ':frequencia_leitura_livros' => $valores_condicao_estudo['frequencia_leitura_livros'],
            ':livros_lidos_este_ano' => $valores_condicao_estudo['livros_lidos_este_ano'],
            ':possui_biblioteca_particular' => $valores_condicao_estudo['possui_biblioteca_particular'],
            ':tem_sala_trabalho' => $valores_condicao_estudo['tem_sala_trabalho'],
            ':quantidade_estimada_livros' => $valores_condicao_estudo['quantidade_estimada_livros'],
            ':utiliza_computador_proprio' => $valores_condicao_estudo['utiliza_computador_proprio'],
            ':frequencia_conexao_internet' => $valores_condicao_estudo['frequencia_conexao_internet']
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }
    
    public function getUltimoIdInsercaoSobreCondicaoEstudo(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorParticipanteIdBanco($id_participante) {
    $sql = "SELECT * FROM SobreCondicaoEstudo WHERE participante_id = :id_participante LIMIT 1";
    $parametros = [':id_participante' => $id_participante];
    $resultado = $this->banco_de_dados->consultar($sql, $parametros);
    return $resultado[0] ?? null;
    }

}

?>