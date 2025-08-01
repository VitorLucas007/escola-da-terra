<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_familia/InformacaoFilhoModel.php';

class InformacaoFilhoController {
    private $informacao_filho_model;

    public function __construct($id_informacao_filho) {
        $this->informacao_filho_model = new InformacaoFilhoModel($id_informacao_filho);
    }

    public function cadastrarDadosInformacaoFilho($valores_informacao_filho) : string | null {
        try {
            $persistencia_banco = $this->informacao_filho_model->inserirInformacaoFilho($valores_informacao_filho);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoInformacaoFilho();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoInformacaoFilho() : string {
        try {
            return $this->informacao_filho_model->getUltimoIdInsercaoInformacaoFilho();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

}