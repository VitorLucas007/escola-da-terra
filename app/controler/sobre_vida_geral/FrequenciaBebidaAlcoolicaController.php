<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_vida_geral/FrequenciaBebidaAlcoolicaModel.php';

class FrequenciaBebidaAlcoolicaController {
    private $frequencia_bebida_alcoolica_model;

    public function __construct($id_frequencia_bebida_alcoolica)
    {
        $this->frequencia_bebida_alcoolica_model = new FrequenciaBebidaAlcoolicaModel($id_frequencia_bebida_alcoolica);
    }

    public function cadastrarDadosFrequenciaBebidaAlcoolica($valores_frequencia_bebida) : string | null {
        try {
            $persistencia_banco = $this->frequencia_bebida_alcoolica_model->inserirFrequenciaBebidaAlcoolica($valores_frequencia_bebida);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoFrequenciaBebidaAlcoolica();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }
        
    public function getUltimoIdInsercaoFrequenciaBebidaAlcoolica(): string {
        try {
            return $this->frequencia_bebida_alcoolica_model->getUltimoIdInsercaoFrequenciaBebidaAlcoolica();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarFrequenciasBebidaPorVidaGeralId($id_vida_geral) {
    return $this->frequencia_bebida_alcoolica_model->buscarPorVidaGeralIdBanco($id_vida_geral);
    }
}

?>