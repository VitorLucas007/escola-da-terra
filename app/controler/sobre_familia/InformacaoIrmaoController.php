<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_familia/InformacaoIrmaoModel.php';

class InformacaoIrmaoController {
    private $informacao_irmao_model;

    public function __construct($id_informacao_irmao) {
        $this->informacao_irmao_model = new InformacaoIrmaoModel($id_informacao_irmao);
    }

    public function cadastrarDadosInformacaoIrmao($valores_informacao_irmao) : string | null {
        try {
            $persistencia_banco = $this->informacao_irmao_model->inserirInformacaoIrmao($valores_informacao_irmao);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoInformacaoIrmao();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoInformacaoIrmao() : string {
        try {
            return $this->informacao_irmao_model->getUltimoIdInsercaoInformacaoIrmao();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarIrmaosPorFamiliaId($id_sobre_familia) {
    return $this->informacao_irmao_model->buscarPorSobreFamiliaIdBanco($id_sobre_familia);
    }

}



?>