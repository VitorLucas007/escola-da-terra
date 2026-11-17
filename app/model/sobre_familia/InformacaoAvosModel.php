<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class InformacaoAvosModel
{
    private $banco_de_dados;
    private $id_informacao_avos;


    public function __construct($id_informacao_avos)
    {
        $this->banco_de_dados = new BancoDeDados();
        $this->id_informacao_avos = $id_informacao_avos;
    }

    // Funções CRUD para persistência

    function inserirInformacaoAvos(array $valores_informacao_avos) : bool
{
    $sql = "INSERT INTO InformacaoAvos (
        sobre_familia_id,
        tipo_avos,
        escolaridade_avo_masc,
        escolaridade_avo_fem,
        profissao_avo_masc,
        profissao_avo_fem,
        naturalidade_avo_masc,
        naturalidade_avo_fem,
        religiao_avos
    ) VALUES (
        :sobre_familia_id,
        :tipo_avos,
        :escolaridade_avo_masc,
        :escolaridade_avo_fem,
        :profissao_avo_masc,
        :profissao_avo_fem,
        :naturalidade_avo_masc,
        :naturalidade_avo_fem,
        :religiao_avos
    )";

    $parametros = [
        ':sobre_familia_id' => $valores_informacao_avos['sobre_familia_id'],
        ':tipo_avos' => $valores_informacao_avos['tipo_avos'],
        ':escolaridade_avo_masc' => $valores_informacao_avos['escolaridade_avo_masc'] ?? null,
        ':escolaridade_avo_fem' => $valores_informacao_avos['escolaridade_avo_fem'] ?? null,
        ':profissao_avo_masc' => $valores_informacao_avos['profissao_avo_masc'] ?? null,
        ':profissao_avo_fem' => $valores_informacao_avos['profissao_avo_fem'] ?? null,
        ':naturalidade_avo_masc' => $valores_informacao_avos['naturalidade_avo_masc'] ?? null,
        ':naturalidade_avo_fem' => $valores_informacao_avos['naturalidade_avo_fem'] ?? null,
        ':religiao_avos' => $valores_informacao_avos['religiao_avos'] ?? null
    ];

    return $this->banco_de_dados->executar($sql, $parametros);
}

    public function getUltimoIdInsercaoInformacaoAvos(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    function listarInformacaoAvos()
    {
        $sql = "SELECT * FROM InformacaoAvos";
        return $this->banco_de_dados->consultar($sql);
    }

    public function buscarPorSobreFamiliaIdBanco($id_sobre_familia) {
    $sql = "SELECT * FROM InformacaoAvos WHERE sobre_familia_id = :id";
    $parametros = [':id' => $id_sobre_familia];
    return $this->banco_de_dados->consultar($sql, $parametros);
}
}
