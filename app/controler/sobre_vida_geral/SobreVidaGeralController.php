<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_vida_geral/SobreVidaGeralModel.php';

class SobreVidaGeralController {
    private $sobre_vida_geral_model;

    public function __construct($id_sobre_vida_geral)
    {
        $this->sobre_vida_geral_model = new SobreVidaGeralModel($id_sobre_vida_geral);
    }

    public function cadastrarDadosSobreVidaGeral($valores_sobre_vida_geral) : string | null {
        try {
            $persistencia_banco = $this->sobre_vida_geral_model->inserirSobreVidaGeral($valores_sobre_vida_geral);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoSobreVidaGeral();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }
        
    public function getUltimoIdInsercaoSobreVidaGeral(): string {
        try {
            return $this->sobre_vida_geral_model->getUltimoIdInsercaoSobreVidaGeral();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}

?>