<?php 
   
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_exercicio_profissao/BeneficioOriundoAtividadeDocenteModel.php';

class BeneficioOriundoAtividadeDocenciaController {
    private $beneficio_oriundo_atividade_docencia_model;

    public function __construct($id_beneficio_oriundo_atividades_docencia)
    {
        $this->beneficio_oriundo_atividade_docencia_model = new BeneficioOriundoAtividadeDocenciaModel($id_beneficio_oriundo_atividades_docencia);
    }

    public function cadastrarDadosBeneficioOriundoAtividadeDocencia($valores_beneficio_oriundo_atividade_docencia): string | null {
        try {
            $persistencia_banco = $this->beneficio_oriundo_atividade_docencia_model->cadastrarBeneficioOriundoAtividadeDocencia($valores_beneficio_oriundo_atividade_docencia);
            if ($persistencia_banco) {
                $ultimo_id_insercao =
                $this->getUltimoIdInsrcaoBeneficioOriundoAtividadeDocencia();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsrcaoBeneficioOriundoAtividadeDocencia(): string {
        try {
            return $this->beneficio_oriundo_atividade_docencia_model->getUltimoIdInsercaoBeneficioOriundoDocencia();
        } catch (Exception $exception) {
            $_SESSION['mensagem_execessao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}
   
   
   
   
   
?>