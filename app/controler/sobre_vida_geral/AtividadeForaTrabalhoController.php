<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_vida_geral/AtividadeForaTrabalhoModel.php';

class AtividadeForaTrabalhoController {
    private $atividade_fora_trabalho_model;

    public function __construct($id_atividade_fora_trabalho)
    {
        $this->atividade_fora_trabalho_model = new AtividadeForaTrabalhoModel($id_atividade_fora_trabalho);
    }

    public function cadastrarDadosAtividadeForaTrabalho($valores_atividade_fora_trabalho) : string | null {
        try {
            $persistencia_banco = $this->atividade_fora_trabalho_model->inserirAtividadeForaTrabalho($valores_atividade_fora_trabalho);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoAtividadeForaTrabalho();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }
        
    public function getUltimoIdInsercaoAtividadeForaTrabalho(): string {
        try {
            return $this->atividade_fora_trabalho_model->getUltimoIdInsercaoAtividadeForaTrabalho();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarAtividadesPorVidaGeralId($id_vida_geral) {
    return $this->atividade_fora_trabalho_model->buscarPorVidaGeralIdBanco($id_vida_geral);
    }
}

?>