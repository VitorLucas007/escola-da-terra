<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

class TrabalhoAnteriorModel
{
    private $id_trabalho_anterior;
    private $banco_de_dados;


    public function __construct($id_trabalho_anterior)
    {
        $this->id_trabalho_anterior = $id_trabalho_anterior;
        $this->banco_de_dados = new BancoDeDados();
    }


    // CRUD
    public function inserirTrabalhoAnterior(array $valores_trabalho_anterior): bool
    {
        $sql = "INSERT INTO TrabalhoAnterior (
            sobre_carreira_id,
            nome_profissao,
            como_exercia
        ) VALUES (
            :sobre_carreira_id,
            :nome_profissao,
            :como_exercia
        )";

        $params = [
            ':sobre_carreira_id' => isset($valores_trabalho_anterior['sobre_carreira_id']) ?
                $valores_trabalho_anterior['sobre_carreira_id'] : null,
            ':nome_profissao' => isset($valores_trabalho_anterior['nome_profissao']) ?
                $valores_trabalho_anterior['nome_profissao'] : null,
            ':como_exercia' => isset($valores_trabalho_anterior['como_exercia']) ?
                $valores_trabalho_anterior['como_exercia'] : null
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoTrabalhoAnterior(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorSobreCarreiraIdBanco($id_sobre_carreira) {
    $sql = "SELECT * FROM TrabalhoAnterior WHERE sobre_carreira_id = :id_sobre_carreira LIMIT 1";
    $parametros = [':id_sobre_carreira' => $id_sobre_carreira];
    $resultado = $this->banco_de_dados->consultar($sql, $parametros, true);
    return $resultado[0] ?? null;
    }
}
