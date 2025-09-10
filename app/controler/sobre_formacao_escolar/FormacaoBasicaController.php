<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_formacao_escolar/FormacaoBasicaModel.php';


class FormacaoBasicaController {
    private $formacao_basica_model;

    public function __construct($id_formacao_basica) {
        $this->formacao_basica_model = new FormacaoBasicaModel($id_formacao_basica);
    }

    public function cadastrarDadosFormacaoBasica($valores_formacao_basica) : string | null {
        try {
            $persistencia_banco = $this->formacao_basica_model->inserirFormacaoBasica($valores_formacao_basica);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoFormacaoBasica();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoFormacaoBasica() : string {
        try {
            return $this->formacao_basica_model->getUltimoIdInsercaoFormacaoBasica();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

}


?>