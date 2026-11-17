<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_condicao_estudo/AcessoInternetModel.php';

class AcessoInternetController {
    private $acesso_internet_model;

    public function __construct($id_acesso_internet)
    {
        $this->acesso_internet_model = new AcessoInternetModel($id_acesso_internet);
    }

    public function cadastrarDadosAcessoInternet($valores_acesso_internet): string | null {
        try {
            $persistencia_banco = $this->acesso_internet_model->cadastrarAcessoInternet($valores_acesso_internet);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoAcessoInternet();
                return $ultimo_id_insercao;
            }

            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Excessão encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoAcessoInternet(): string {
        try {
            return $this->acesso_internet_model->getUltimoIdInsercaoAcessoInternet();
        } catch (Exception $excpetion) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarAcessoInternetPorCondicaoEstudoId($id_condicao_estudo) {
    return $this->acesso_internet_model->buscarPorCondicaoEstudoIdBanco($id_condicao_estudo);
    }

}

?>