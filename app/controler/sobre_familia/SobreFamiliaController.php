<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_familia/SobreFamiliaModel.php';

class SobreFamiliaController
{
    private $sobre_familia_model;

    public function __construct($id_informacao_familiares)
    {
        $this->sobre_familia_model = new SobreFamiliaModel($id_informacao_familiares);
    }

    public function cadastrarDadosSobreFamilia($valores_sobre_familia): string | null
    {
        try {
            $persistencia_banco = $this->sobre_familia_model->cadastrarSobreFamilia($valores_sobre_familia);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoSobreFamilia();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoSobreFamilia(): string
    {
        try {
            return $this->sobre_familia_model->getUltimoIdInsercaoSobreFamilia();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarSobreFamiliaPorParticipanteId($id_participante) {
    return $this->sobre_familia_model->buscarPorParticipanteIdBanco($id_participante);
    }
}
