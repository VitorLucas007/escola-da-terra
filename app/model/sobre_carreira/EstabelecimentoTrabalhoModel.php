<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class EstabelecimentoTrabalhoModel
{
    private $banco_de_dados;
    private $id_estabelecimento_trabalho;

    public function __construct($id_estabelecimento_trabalho)
    {
        $this->id_estabelecimento_trabalho = $id_estabelecimento_trabalho;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function inserirEstabelecimentoTrabalho(array $valores_trabalho_estabelecimento): bool
    {
        $sql = "INSERT INTO EstabelecimentoTrabalho (
            sobre_carreira_id,
            nome_escola,
            jornada_trabalho_semanal,
            situacao_funcional,
            tipo_turma,
            localizacao_escola,
            dependencia_administrativa,
            contexto_escolar

        ) VALUES (
            :sobre_carreira_id,
            :nome_escola,
            :jornada_trabalho_semanal,
            :situacao_funcional,
            :tipo_turma,
            :localizacao_escola,
            :dependencia_administrativa,
            :contexto_escolar
        )";

        $params = [
            ':sobre_carreira_id' => $valores_trabalho_estabelecimento['sobre_carreira_id'] ?
                $valores_trabalho_estabelecimento['sobre_carreira_id'] : null,
            ':nome_escola' => $valores_trabalho_estabelecimento['nome_escola'] ?
                $valores_trabalho_estabelecimento['nome_escola'] : null,
            ':jornada_trabalho_semanal' => $valores_trabalho_estabelecimento['jornada_trabalho_semanal'] ?
                $valores_trabalho_estabelecimento['jornada_trabalho_semanal'] : null,
            ':situacao_funcional' => $valores_trabalho_estabelecimento['situacao_funcional'] ?
                $valores_trabalho_estabelecimento['situacao_funcional'] : null,
            ':tipo_turma' => $valores_trabalho_estabelecimento['tipo_turma'] ?
                $valores_trabalho_estabelecimento['tipo_turma'] : null,
            ':localizacao_escola' => $valores_trabalho_estabelecimento['localizacao_escola'] ?
                $valores_trabalho_estabelecimento['localizacao_escola'] : null,
            ':dependencia_administrativa' => $valores_trabalho_estabelecimento['dependencia_administrativa'] ?
                $valores_trabalho_estabelecimento['dependencia_administrativa'] : null,
            ':contexto_escolar' => $valores_trabalho_estabelecimento['contexto_escolar'] ?
                $valores_trabalho_estabelecimento['contexto_escolar'] : null
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoEstabelecimento(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorSobreCarreiraIdBanco($id_sobre_carreira) {
    $sql = "SELECT * FROM EstabelecimentoTrabalho WHERE sobre_carreira_id = :id_sobre_carreira";
    $parametros = [':id_sobre_carreira' => $id_sobre_carreira];
    return $this->banco_de_dados->consultar($sql, $parametros);
    }
}
