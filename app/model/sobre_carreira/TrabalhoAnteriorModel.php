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
    public function cadastrarTrabalhoAnterior(array $valores_trabalho_anterior): bool
    {
        $sql = "INSERT INTO TrabalhoAnterior (
            participante_id,
            sobre_carreira_id,
            nome_profissao,
            como_exercia
        ) VALUES (
            :participante_id,
            :sobre_carreira_id,
            :nome_profissao,
            :como_exercia
        )";

        $params = [
            ':participante_id' => isset($valores_trabalho_anterior['participante_id']) ?
                $valores_trabalho_anterior['participante_id'] : null,
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
}
