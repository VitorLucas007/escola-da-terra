<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';

class BeneficioOriundoAtividadeDocenciaModel {
    
    private $banco_de_dados;
    private $id_beneficio_oriundo_atividade_docencia;

    public function __construct($id_beneficio_oriundo_atividade_docencia = null){
        $this->id_beneficio_oriundo_atividade_docencia = $id_beneficio_oriundo_atividade_docencia;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function cadastrarBeneficioOriundoAtividadeDocencia(array $valores_beneficio_oriundo_atividade_docencia): bool {
        $sql = "INSERT INTO BeneficioOriundoAtividadesDocencia (
            sobre_exercicio_profissao_id,
            identificacao_beneficio
        ) VALUES (
            :sobre_exercicio_profissao_id,
            :identificacao_beneficio
        )";

        $params = [
            ':sobre_exercicio_profissao_id' => $valores_beneficio_oriundo_atividade_docencia['sobre_exercicio_profissao_id'],
            ':identificacao_beneficio' => $valores_beneficio_oriundo_atividade_docencia['identificacao_beneficio']
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoBeneficioOriundoDocencia(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function atualizarBeneficioOriundoAtividadeDocencia(){
    }

    public function excluirBeneficioOriundoAtividadeDocencia(){
    }

    public function getBeneficioOriundoAtividadeDocenciaPorId(){
    }

    public function listarTodos(){
        $sql = "SELECT * FROM BeneficioOriundoAtividadesDocencia";
        return $this->banco_de_dados->consultar($sql);
    }
}

?>