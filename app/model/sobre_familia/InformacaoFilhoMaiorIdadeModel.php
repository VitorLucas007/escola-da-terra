<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class InformacaoFilhoMaiorIdadeModel
{
    private $banco_de_dados;
    private $id_informacao_filho_maior_idade;

    public function __construct($id_informacao_filho_maior_idade)
    {
        $this->banco_de_dados = new BancoDeDados();
        $this->id_informacao_filho_maior_idade = $id_informacao_filho_maior_idade;
    }

    // Funcções de CRUD para persistência

    function inserirInformacaoFilhoMaiorIdade(array $valores_informacao_filho_maior_idade): bool
    {
        $sql = "INSERT INTO InformacaoFilhoMaiorIdade (
            informacao_filho_id,
            situacao_vida
        ) VALUES (
            :informacao_filho_id,
            :situacao_vida
        )";

        $parametros = [
            ':informacao_filho_id' => $valores_informacao_filho_maior_idade['informacao_filho_id'],
            ':situacao_vida' => $valores_informacao_filho_maior_idade['situacao_vida']
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoInformacaoFilhoMaior(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    function listarInformacaoFilhoMaiorIdade()
    {
        $sql = "SELECT * FROM InformacaoFilhoMaiorIdade";
        return $this->banco_de_dados->consultar($sql);
    }

    function modificarInformacaoFilhoMaiorIdade() {}

    function excluirInformacaoFilhoMaiorIdade() {}

    function buscarInformacaoFilhoMaiorIdade() {}
}
