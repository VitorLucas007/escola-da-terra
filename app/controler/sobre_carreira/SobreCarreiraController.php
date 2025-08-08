<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_carreira/SobreCarreiraModel.php';

class SobreCarreiraController {
    private $sobre_carreira_model;

    public function __construct($id_informacao_carreira)
    {
        $this->sobre_carreira_model = new SobreCarreiraModel($id_informacao_carreira);
    }

    public function cadastrarDadosSobreCarreira($valores_informacao_carreira) : string | null {
        try {
            $persistencia_banco = $this->sobre_carreira_model->inserirSobreCarreira($valores_informacao_carreira);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoSobreCarreira();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }

        public function getUltimoIdInsercaoSobreCarreira(): string {
            try {
                return $this->sobre_carreira_model->getUltimoIdInsercaoSobreCarreira();
            } catch (Exception $exception) {
                $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
                header("Location: /pesquisa_educacional/views/erro.php");
                exit;
            }
        }
}



?>