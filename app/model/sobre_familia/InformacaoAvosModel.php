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
            ':sobre_familia_id' => isset($valores_informacao_avos['sobre_familia_id']) ?
                $valores_informacao_avos['sobre_familia_id'] : null,


            ':tipo_avos' => isset($valores_informacao_avos['tipo_avos']) ?
                $valores_informacao_avos['tipo_avos'] : null,


            ':escolaridade_avo_masc' => isset($valores_informacao_avos['escolaridade_avo_masc']) ?
                $valores_informacao_avos['escolaridade_avo_masc'] : null,

            ':escolaridade_avo_fem' => isset($valores_informacao_avos['escolaridade_avo_fem']) ?
                $valores_informacao_avos['escolaridade_avo_fem'] : null,

            ':profissao_avo_masc' => isset($valores_informacao_avos['profissao_avo_masc']) ?
                $valores_informacao_avos['profissao_avo_masc'] : 'Desconhecido',

            ':profissao_avo_fem' => isset($valores_informacao_avos['profissao_avo_fem']) ?
                $valores_informacao_avos['profissao_avo_fem'] : 'Desconhecido',

            ':naturalidade_avo_masc' => isset($valores_informacao_avos['naturalidade_avo_masc']) ?
                $valores_informacao_avos['naturalidade_avo_masc'] : 'Desconhecido',

            ':naturalidade_avo_fem' => isset($valores_informacao_avos['naturalidade_avo_fem']) ?
                $valores_informacao_avos['naturalidade_avo_fem'] : 'Desconhecido',

            ':religiao_avos' => isset($valores_informacao_avos['religiao_avos']) ?
                $valores_informacao_avos['religiao_avos'] : 'Desconhecido'
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


    function modificarInformacaoAvos() {}

    function excluirInformacaoAvos() {}

    function buscarInformacaoAvos() {}
}
