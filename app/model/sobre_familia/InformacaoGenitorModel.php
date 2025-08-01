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

    function listarTodos() {
        $sql = "SELECT * FROM InformacaoGenitor";
        return $this->banco_de_dados->consultar($sql);
    }

    function inserirInformacaoGenitor(array $valores_sobre_genitor): bool {
        $sql = "INSERT INTO InformacaoGenitor (
            sobre_familia_id,
            tipo_genitor,
            escolaridade,
            naturalidade,
            religiao,
            participa_grupo,
            grupo_participa
        ) VALUES (
            :sobre_familia_id,
            :tipo_genitor,
            :escolaridade,
            :naturalidade,
            :religiao,
            :participa_grupo,
            :grupo_participa
        )";

        $parametros = [
            ":sobre_familia_id" => $valores_sobre_genitor['sobre_genitor_id'],
            ":tipo_genitor" => $valores_sobre_genitor['tipo_genitor'],
            ":escolaridade" => $valores_sobre_genitor['escolaridade'],
            ":naturalidade" => $valores_sobre_genitor['naturalidade'],
            ":religiao" => $valores_sobre_genitor['religiao'],
            ":participa_grupo" => $valores_sobre_genitor['participa_grupo'],
            ":grupo_participa" => $valores_sobre_genitor['grupo_participa']
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoInformacaoGenitor() : string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}
