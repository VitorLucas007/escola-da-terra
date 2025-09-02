 <?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_vida_geral/RazaoAlimentacaoDesequilibradaModel.php';

class RazaoAlimentacaoDesequilibradaController {
    private $razao_alimentacao_desequilibrada_model;

    public function __construct($id_razao_alimentacao_desequilibrada)
    {
        $this->razao_alimentacao_desequilibrada_model = new RazaoAlimentacaoDesequilibradaModel($id_razao_alimentacao_desequilibrada);
    }

    public function cadastrarDadosRazaoAlimentacaoDesequilibrada($valores_razao_alimentacao) : string | null {
        try {
            $persistencia_banco = $this->razao_alimentacao_desequilibrada_model->inserirRazaoAlimentacaoDesequilibrada($valores_razao_alimentacao);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoRazaoAlimentacaoDesequilibrada();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }
        
    public function getUltimoIdInsercaoRazaoAlimentacaoDesequilibrada(): string {
        try {
            return $this->razao_alimentacao_desequilibrada_model->getUltimoIdInsercaoRazaoAlimentacaoDesequilibrada();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}

?>