<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class AtividadeForaTrabalhoModel {
    private $banco_de_dados;
    private $id_atividade_fora_trabalho;

    public function __construct($id_atividade_fora_trabalho)
    {
        $this->id_atividade_fora_trabalho = $id_atividade_fora_trabalho;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function inserirAtividadeForaTrabalho(array $valores_atividade_fora_trabalho): bool
    {
        $sql = "INSERT INTO AtividadeForaTrabalho (
            sobre_vida_geral_id,
            descricao_atividade
        ) VALUES (
            :sobre_vida_geral_id,
            :descricao_atividade
        )";

        $params = [
            'sobre_vida_geral_id' => $valores_atividade_fora_trabalho['sobre_vida_geral_id'],
            'descricao_atividade' => $valores_atividade_fora_trabalho['descricao_atividade'],
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoAtividadeForaTrabalho(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorVidaGeralIdBanco($id_vida_geral) {
    $sql = "SELECT * FROM AtividadeForaTrabalho WHERE sobre_vida_geral_id = :id";
    $parametros = [':id' => $id_vida_geral];
    return $this->banco_de_dados->consultar($sql, $parametros);
}
}