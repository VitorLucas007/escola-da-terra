<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class FrequenciaBebidaAlcoolicaModel {
    private $banco_de_dados;
    private $id_frequencia_bebida_alcoolica;

    public function __construct($id_frequencia_bebida_alcoolica)
    {
        $this->id_frequencia_bebida_alcoolica = $id_frequencia_bebida_alcoolica;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function inserirFrequenciaBebidaAlcoolica(array $valores_frequencia_bebida): bool
    {
        $sql = "INSERT INTO FrequenciaBebidaAlcoolica (
            sobre_vida_geral_id,
            bebida,
            nivel_frequencia
        ) VALUES (
            :sobre_vida_geral_id,
            :bebida,
            :nivel_frequencia
        )";

        $params = [
            'sobre_vida_geral_id' => $valores_frequencia_bebida['sobre_vida_geral_id'],
            'bebida' => $valores_frequencia_bebida['bebida'],
            'nivel_frequencia' => $valores_frequencia_bebida['nivel_frequencia'],
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoFrequenciaBebidaAlcoolica(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorVidaGeralIdBanco($id_vida_geral) {
    $sql = "SELECT * FROM FrequenciaBebidaAlcoolica WHERE sobre_vida_geral_id = :id";
    $parametros = [':id' => $id_vida_geral];
    return $this->banco_de_dados->consultar($sql, $parametros);
    }
}