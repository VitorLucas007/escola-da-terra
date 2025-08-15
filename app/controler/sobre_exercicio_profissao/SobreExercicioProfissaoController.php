<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_exercicio_profissao/SobreExercicioProfissaoModel.php';

class SobreExercicioProfissaoController {
    private $sobre_exercicio_profissao_model;

    public function __construct($id_sobre_exercicio_profissao)
    {
        $this->sobre_exercicio_profissao_model = new SobreExercicioProfissaoModel($id_sobre_exercicio_profissao);
    }

    public function cadastrarDadosSobreExercicioProfissao($valores_sobre_exercicio_profissao): string | null{
        try {
            $persistencia_banco = $this->sobre_exercicio_profissao_model->cadastrarSobreExercicioProfissao($valores_sobre_exercicio_profissao);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoSobreExercicioProfissao();
                return $ultimo_id_insercao;
            } 
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Excessão encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoSobreExercicioProfissao(): string {
        try {
            return $this->sobre_exercicio_profissao_model->getUltimoIdInsercaoSobreExercicioProfissao();
        } catch (Exception $excpetion) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}


?>