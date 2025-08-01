<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

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

    function inserirInformacaoAvos($valores_informacao_avos)
    {
        $sql = "INSERT INTO InformacaoAvos (
            id_informacao_avos,
            tipo_avos,
            escolaridade_avo_mascs,
            escolaridade_avo_fem,
            profissao_avo_masc,
            profissao_avo_fem,
            naturalidade_avo_masc,
            naturalidade_avo_fem,
            religiao_avos
        ) VALUES (
            :idInformacaoAvos,
            :tipo_avos,
            :escolaridade_avo_mascs,
            :escolaridade_avo_fem,
            :profissao_avo_masc,
            :profissao_avo_fem,
            :naturalidade_avo_masc,
            :naturalidade_avo_fem,
            :religiao_avos
        )";
        $parametros = [
            ':idInformacaoAvos' => $valores_informacao_avos['id_informacao_avos'],
            ':tipo_avos' => $valores_informacao_avos['tipo_avos'],
            ':escolaridade_avo_mascs' => $valores_informacao_avos['escolaridade_avo_mascs'],
            ':escolaridade_avo_fem' => $valores_informacao_avos['escolaridade_avo_fem'],
            ':profissao_avo_masc' => $valores_informacao_avos['profissao_avo_masc'],
            ':profissao_avo_fem' => $valores_informacao_avos['profissao_avo_fem'],
            ':naturalidade_avo_masc' => $valores_informacao_avos['naturalidade_avo_masc'],
            ':naturalidade_avo_fem' => $valores_informacao_avos['naturalidade_avo_fem'],
            ':religiao_avos' => $valores_informacao_avos['religiao_avos']
        ];

        return $this->banco_de_dados->executar($sql, $parametros);

    }

    public function getUltimoIdInsercaoInformacaoAvos() : string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }   

    function listarInformacaoAvos()
    {
        $sql = "SELECT * FROM InformacaoAvos";
        return $this->banco_de_dados->consultar($sql);
    }


    function modificarInformacaoAvos()
    {

    }

    function excluirInformacaoAvos()
    {

    }

    function buscarInformacaoAvos()
    {

    }
}
