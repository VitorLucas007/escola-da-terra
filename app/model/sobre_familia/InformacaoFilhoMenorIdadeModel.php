<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class InformacaoFilhoMenorIdadeModel
{
    private $banco_de_dados;
    private $id_informacao_filho_menor_idade;


    public function __construct($id_informacao_filho_menor_idade)
    {
        $this->id_informacao_filho_menor_idade = $id_informacao_filho_menor_idade;
        $this->banco_de_dados = new BancoDeDados();
    }

    // Funções CRUD para persistência

   function inserirInformacaoFilhoMenor(array $valores_informacao_filho_menor_idade): bool
{
    $sql = "INSERT INTO InformacaoFilhoMenorIdade (
        informacao_filho_id,
        etapa_educacao,
        habitacao_fora_escola,
        acompanhante
    ) VALUES (
        :informacao_filho_id,
        :etapa_educacao,
        :habitacao_fora_escola,
        :acompanhante
    )";

    $parametros = [
        ':informacao_filho_id' => $valores_informacao_filho_menor_idade['informacao_filho_id'],
        ':etapa_educacao' => $valores_informacao_filho_menor_idade['etapa_educacao'] ?? null,
        ':habitacao_fora_escola' => $valores_informacao_filho_menor_idade['habitacao_fora_escola'] ?? null,
        ':acompanhante' => $valores_informacao_filho_menor_idade['acompanhante'] ?? null
    ];

    return $this->banco_de_dados->executar($sql, $parametros);
}

    public function getUltimoIdInsercaoInformacaoFilhoMenor(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    function listarInformacaoFilhoMenor()
    {
        $sql = "SELECT * FROM InformacaoFilhoMenorIdade";
        return $this->banco_de_dados->consultar($sql);
    }

    function modificarInformacaoFilhoMenor() {}

    function excluirInformacaoFilhoMenor() {}

    function buscarInformacaoFilhoMenor() {}
}
