<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_formacao_escolar/SobreFormacaoEscolarModel.php';

class SobreFormacaoEscolarController {
    private $sobre_formacao_escolar_model;

    public function __construct($id_sobre_formacao_escolar) {
        $this->sobre_formacao_escolar_model = new SobreFormacaoEscolarModel($id_sobre_formacao_escolar);
    }

    public function cadastrarDadosSobreFormacaoEscolar($valores_sobre_formacao_escolar) : string | null {
        try {
            $persistencia_banco = $this->sobre_formacao_escolar_model->inserirSobreFormacaoEscolar($valores_sobre_formacao_escolar);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoSobreFormacaoEscolar();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoSobreFormacaoEscolar() : string {
        try {
            return $this->sobre_formacao_escolar_model->getUltimoIdInsercaoSobreFormacaoEscolar();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarSobreFormacaoPorParticipanteId($id_participante) {
    return $this->sobre_formacao_escolar_model->buscarPorParticipanteIdBanco($id_participante);
    }

}

?>