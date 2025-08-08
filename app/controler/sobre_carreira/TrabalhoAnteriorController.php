<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_carreira/TrabalhoAnteriorModel.php';


class TrabalhoAnteriorController
{
    private $trabalho_anterior_model;

    public function __construct($id_trabalho_anterior)
    {
        $this->trabalho_anterior_model = new TrabalhoAnteriorModel($id_trabalho_anterior);
    }

    public function cadastrarDadosTrabalhoAnterior($valores_trabalho_anterior): string | null
    {
        try {
            $persistencia_banco = $this->trabalho_anterior_model->inserirTrabalhoAnterior($valores_trabalho_anterior);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoTrabalhoAnterior();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoTrabalhoAnterior(): string
    {
        try {
            return $this->trabalho_anterior_model->getUltimoIdInsercaoTrabalhoAnterior();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}
