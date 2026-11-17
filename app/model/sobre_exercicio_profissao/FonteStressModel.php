<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/app/model/BancoDeDados.php';

class FonteStressModel {
    
    private $banco_de_dados;
    private $id_fonte_stress;

    public function __construct($id_fonte_stress = null){
        $this->id_fonte_stress = $id_fonte_stress;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function cadastrarFonteStress(array $valores_fonte_stress): bool {
        $sql = "INSERT INTO FonteStress (
            sobre_exercicio_profissao_id,
            descricao_fonte
        ) VALUES (
            :sobre_exercicio_profissao_id,
            :descricao_fonte
        )";

        $params = [
            ':sobre_exercicio_profissao_id' => $valores_fonte_stress['sobre_exercicio_profissao_id'],
            ':descricao_fonte' => $valores_fonte_stress['descricao_fonte']
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoFonteStress(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function listarTodos(){
        $sql = "SELECT * FROM FonteStress";
        return $this->banco_de_dados->consultar($sql);
    }

    public function buscarPorExercicioProfissaoIdBanco($id_exercicio_profissao) {
    $sql = "SELECT * FROM FonteStress WHERE sobre_exercicio_profissao_id = :id";
    $parametros = [':id' => $id_exercicio_profissao];
    return $this->banco_de_dados->consultar($sql, $parametros);
    }
}

?>