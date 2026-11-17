<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_formacao_escolar/FormacaoSuperiorModel.php';

class FormacaoSuperiorController {
    private $formacao_superior_model;

    public function __construct($id_formacao_superior) {
        $this->formacao_superior_model = new FormacaoSuperiorModel($id_formacao_superior);
    }

    public function cadastrarDadosFormacaoSuperior($valores_formacao_superior) : string | null {
        try {
            $persistencia_banco = $this->formacao_superior_model->inserirFormacaoSuperior($valores_formacao_superior);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoFormacaoSuperior();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoFormacaoSuperior() : string {
        try {
            return $this->formacao_superior_model->getUltimoIdInsercaoFormacaoSuperior();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarFormacaoSuperiorPorId($id_formacao_escolar) {
    return $this->formacao_superior_model->buscarPorFormacaoEscolarIdBanco($id_formacao_escolar);
    }

}

?>