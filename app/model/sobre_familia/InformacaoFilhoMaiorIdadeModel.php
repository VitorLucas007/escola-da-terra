<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

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
            id_informacao_filho_menor_idade,
            situacao_vida
        ) VALUES (
            :idInformacaoFilhoMaior,
            :situacao_vida
        )";

        $parametros = [
            ':idInformacaoFilhoMaior' => isset($valores_informacao_filho_maior_idade['id_informacao_filho_menor_idade']) ?
                $valores_informacao_filho_maior_idade['id_informacao_filho_menor_idade'] : $this->id_informacao_filho_maior_idade,
            ':situacao_vida' => isset($valores_informacao_filho_maior_idade['situacao_vida']) ?
                $valores_informacao_filho_maior_idade['situacao_vida'] : null
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
