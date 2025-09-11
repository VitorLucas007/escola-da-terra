 <?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_vida_geral/ProblemaUltimasSemanasModel.php';

class ProblemaUltimasSemanasController {
    private $problema_ultimas_semanas_model;

    public function __construct($id_problema_ultima_semana)
    {
        $this->problema_ultimas_semanas_model = new ProblemaUltimasSemanasModel($id_problema_ultima_semana);
    }

    public function cadastrarDadosProblemaUltimasSemanas($valores_problema_semanas) : string | null {
        try {
            $persistencia_banco = $this->problema_ultimas_semanas_model->inserirProblemaUltimasSemanas($valores_problema_semanas);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoProblemaUltimasSemanas();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }
        
    public function getUltimoIdInsercaoProblemaUltimasSemanas(): string {
        try {
            return $this->problema_ultimas_semanas_model->getUltimoIdInsercaoProblemaUltimasSemanas();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarProblemasPorVidaGeralId($id_vida_geral) {
    return $this->problema_ultimas_semanas_model->buscarPorVidaGeralIdBanco($id_vida_geral);
    }
}

?>