<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

class InformacaoGenitorModel
{
    private $banco_de_dados;
    private $id_informacao_genitor;

    public function __construct($id_informacao_genitor)
    {
        $this->id_informacao_genitor = $id_informacao_genitor;
        $this->banco_de_dados = new BancoDeDados();
    }

    // Funções CRUD para persistência

    function listarTodos()
    {
        $sql = "SELECT * FROM InformacaoGenitor";
        return $this->banco_de_dados->consultar($sql);
    }

    function inserirInformacaoGenitor(array $valores_sobre_genitor): bool
    {
        $sql = "INSERT INTO InformacaoGenitor (
        sobre_familia_id,
        tipo_genitor,
        escolaridade,
        profissao,
        naturalidade,
        religiao,
        participa_grupo,
        grupos_participacao
    ) VALUES (
        :sobre_familia_id,
        :tipo_genitor,
        :escolaridade,
        :profissao,
        :naturalidade,
        :religiao,
        :participa_grupo,
        :grupos_participacao
    )";

        $parametros = [

            ":sobre_familia_id" => isset($valores_sobre_genitor['sobre_familia_id']) ?
                $valores_sobre_genitor['sobre_familia_id'] : null,

            ":tipo_genitor" => isset($valores_sobre_genitor['tipo_genitor']) ?
                $valores_sobre_genitor['tipo_genitor'] : null,

            ":escolaridade" => isset($valores_sobre_genitor['escolaridade']) ?
                $valores_sobre_genitor['escolaridade'] : null,


            ":profissao" => isset($valores_sobre_genitor['profissao']) ?
                $valores_sobre_genitor['profissao'] : 'Desconhecido',

            ":naturalidade" => isset($valores_sobre_genitor['naturalidade']) ?
                $valores_sobre_genitor['naturalidade'] : 'Desconhecido',

            ":religiao" => isset($valores_sobre_genitor['religiao']) ?
                $valores_sobre_genitor['religiao'] : 'Desconhecido',

            ":participa_grupo" => isset($valores_sobre_genitor['participa_grupo']) ?
                $valores_sobre_genitor['participa_grupo'] : null,

            ":grupos_participacao" => isset($valores_sobre_genitor['grupos_participacao']) ?
                $valores_sobre_genitor['grupos_participacao'] : null
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoInformacaoGenitor(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}
