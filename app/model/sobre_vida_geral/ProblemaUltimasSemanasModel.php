 <?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

class ProblemaUltimasSemanasModel {
    private $banco_de_dados;
    private $id_problema_ultima_semana;

    public function __construct($id_problema_ultima_semana)
    {
        $this->id_problema_ultima_semana = $id_problema_ultima_semana;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function inserirProblemaUltimasSemanas(array $valores_problema_semanas): bool
    {
        $sql = "INSERT INTO ProblemaUltimasSemanas (
            sobre_vida_geral_id,
            descricao_problema
        ) VALUES (
            :sobre_vida_geral_id,
            :descricao_problema
        )";

        $params = [
            'sobre_vida_geral_id' => $valores_problema_semanas['sobre_vida_geral_id'],
            'descricao_problema' => $valores_problema_semanas['descricao_problema'],
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoProblemaUltimasSemanas(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorVidaGeralIdBanco($id_vida_geral) {
    $sql = "SELECT * FROM ProblemaUltimasSemanas WHERE sobre_vida_geral_id = :id";
    $parametros = [':id' => $id_vida_geral];
    return $this->banco_de_dados->consultar($sql, $parametros);
    }
}