<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';

class BeneficioRecebidoSalarioModel {
    
    private $banco_de_dados;
    private $id_beneficio_recebido_salario;

    public function __construct($id_beneficio_recebido_salario = null){
        $this->id_beneficio_recebido_salario = $id_beneficio_recebido_salario;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function cadastrarBeneficioRecebidoSalario(array $valores_beneficio_recebido_salario): bool {
        $sql = "INSERT INTO BeneficioRecebidoSalario (
            sobre_exercicio_profissao_id,
            descricao_beneficio
        ) VALUES (
            :sobre_exercicio_profissao_id,
            :descricao_beneficio
        )";

        $params = [
            ':sobre_exercicio_profissao_id' => $valores_beneficio_recebido_salario['sobre_exercicio_profissao_id'],
            ':descricao_beneficio' => $valores_beneficio_recebido_salario['descricao_beneficio']
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoBeneficioRecebidoSalario(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function atualizarBeneficioRecebidoSalario(){
    }

    public function excluirBeneficioRecebidoSalario(){
    }

    public function getBeneficioRecebidoSalarioPorId(){
    }

    public function listarTodos(){
        $sql = "SELECT * FROM BeneficioRecebidoSalario";
        return $this->banco_de_dados->consultar($sql);
    }
}

?>