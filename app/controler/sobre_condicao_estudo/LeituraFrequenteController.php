<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_condicao_estudo/LeituraFrequenteModel.php';

class LeituraFrequenteController {
    private $leitura_frequente_model;

    public function __construct($id_ler_frequentemente)
    {
        $this->leitura_frequente_model = new LeituraFrequenteModel($id_ler_frequentemente);
    }

    public function cadastrarDadosLeituraFrequente($valores_leitura_frequente): string | null {
        try {
            $persistencia_banco = $this->leitura_frequente_model->cadastrarLeituraFrequente($valores_leitura_frequente);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoLeituraFrequente();
                return $ultimo_id_insercao;
            }

            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Excessão encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoLeituraFrequente(): string {
        try {
            return $this->leitura_frequente_model->getUltimoIdInsercaoLeituraFrequente();
        } catch (Exception $excpetion) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarLeiturasPorCondicaoEstudoId($id_condicao_estudo) {
    return $this->leitura_frequente_model->buscarPorCondicaoEstudoIdBanco($id_condicao_estudo);
    }
    
}

?>