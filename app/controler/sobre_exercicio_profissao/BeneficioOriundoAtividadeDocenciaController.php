<?php 
   
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// CORRIGIDO: Nome do arquivo model (Docencia em vez de Docente)
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_exercicio_profissao/BeneficioOriundoAtividadeDocenciaModel.php';

class BeneficioOriundoAtividadeDocenciaController {
    private $beneficio_oriundo_atividade_docencia_model;

    public function __construct($id_beneficio_oriundo_atividades_docencia)
    {
        // CORRIGIDO: Nome da classe model (Docencia em vez de Docente)
        $this->beneficio_oriundo_atividade_docencia_model = new BeneficioOriundoAtividadeDocenciaModel($id_beneficio_oriundo_atividades_docencia);
    }

    // CORRIGIDO: Nome do método para coincidir com o que está sendo chamado no process
    public function cadastrarBeneficioOriundoAtividadeDocencia($valores_beneficio_oriundo_atividade_docencia): string | null {
        try {
            $persistencia_banco = $this->beneficio_oriundo_atividade_docencia_model->cadastrarBeneficioOriundoAtividadeDocencia($valores_beneficio_oriundo_atividade_docencia);
            if ($persistencia_banco) {
                // CORRIGIDO: Nome do método (erro de digitação "Insrcao" -> "Insercao")
                $ultimo_id_insercao = $this->getUltimoIdInsercaoBeneficioOriundoAtividadeDocencia();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    // CORRIGIDO: Nome do método (erro de digitação "Insrcao" -> "Insercao")
    public function getUltimoIdInsercaoBeneficioOriundoAtividadeDocencia(): string {
        try {
            // CORRIGIDO: Nome do método no model (assumindo que segue o padrão)
            return $this->beneficio_oriundo_atividade_docencia_model->getUltimoIdInsercaoBeneficioOriundoDocencia();
        } catch (Exception $exception) {
            // CORRIGIDO: Nome da variável de sessão (erro de digitação "execessao" -> "excecao")
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}

?>