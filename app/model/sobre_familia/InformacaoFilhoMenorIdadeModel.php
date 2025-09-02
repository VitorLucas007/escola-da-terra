<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

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

    function inserirInformacaoFilhoMenor(array $valores_informacao_filho_menor): bool
    {
        $sql = "INSERT INTO InformacaoFilhoMenorIdade (
            etapa_educacao,
            habitacao_fora_escola,
            acompanhante
        ) VALUES (
            :etapa_educacao,
            :habitacao_fora_escola,
            :acompanhante
        )";

        $parametros = [
            ':etapa_educacao' => isset($valores_informacao_filho_menor['etapa_educacao']) ?
                $valores_informacao_filho_menor['etapa_educacao'] : null,
            ':habitacao_fora_escola' => isset($valores_informacao_filho_menor['habitacao_fora_escola']) ?
                $valores_informacao_filho_menor['habitacao_fora_escola'] : null,
            ':acompanhante' => isset($valores_informacao_filho_menor['acompanhante']) ?
                $valores_informacao_filho_menor['acompanhante'] : null
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
