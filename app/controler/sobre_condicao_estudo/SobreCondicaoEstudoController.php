<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_condicao_estudo/SobreCondicaoEstudoModel.php';

class SobreCondicaoEstudoController {
    private $sobre_condicao_estudo_model;

    public function __construct($id_informacao_condicao_estudo)
    {
        $this->sobre_condicao_estudo_model = new SobreCondicaoEstudoModel($id_informacao_condicao_estudo);
    }

    public function cadastrarDadosSobreCondicaoEstudo($valores_sobre_condicao_estudo): string | null {
        try {
            $persistencia_banco = $this->sobre_condicao_estudo_model->cadastrarSobreCondicaoEstudo($valores_sobre_condicao_estudo);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoSobreCondicaoEstudo();
                return $ultimo_id_insercao;
            }

            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Excessão encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoSobreCondicaoEstudo(): string {
        try {
            return $this->sobre_condicao_estudo_model->getUltimoIdInsercaoSobreCondicaoEstudo();
        } catch (Exception $excpetion) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarCondicaoEstudoPorParticipanteId($id_participante) {
    return $this->sobre_condicao_estudo_model->buscarPorParticipanteIdBanco($id_participante);
    }
}

?>