<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';


class InformacaoIrmaoModel
{
    private $banco_de_dados;
    private $id_informacao_irmao;

    public function __construct($id_informacao_irmao)
    {
        $this->id_informacao_irmao = $id_informacao_irmao;
        $this->banco_de_dados = new BancoDeDados();
    }

    // Funções CRUD para persistência

    function inserirInformacaoIrmao(array $valores_sobre_irmao): bool
    {
        $sql = "INSERT INTO InformacaoIrmao (
            sobre_familia_id,
            nome,
            profissao,
            habita_mesma_localidade,
            local_habitacao
        ) VALUES (
            :sobre_familia_id,
            :nome,
            :profissao,
            :habita_mesma_localidade,
            :local_habitacao
        )";

        $parametros = [
            ":sobre_familia_id" => $valores_sobre_irmao['sobre_familia_id'],
            ":nome" => $valores_sobre_irmao['nome'],
            ":profissao" => $valores_sobre_irmao['profissao'],
            ":habita_mesma_localidade" => $valores_sobre_irmao['habita_mesma_localidade'],
            ":local_habitacao" => $valores_sobre_irmao['local_habitacao'],
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoInformacaoIrmao(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    function listarInformacaoIrmao()
    {
        $sql = "SELECT * FROM InformacaoIrmao";
        return $this->banco_de_dados->consultar($sql);
    }

    public function buscarPorSobreFamiliaIdBanco($id_sobre_familia) {
    $sql = "SELECT * FROM InformacaoIrmao WHERE sobre_familia_id = :id";
    $parametros = [':id' => $id_sobre_familia];
    return $this->banco_de_dados->consultar($sql, $parametros);
}
}
