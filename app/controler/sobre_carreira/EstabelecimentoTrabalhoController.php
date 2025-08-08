<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_carreira/EstabelecimentoTrabalhoModel.php';


class EstabelecimentoTrabalhoController {
    private $estabelecimento_trabalho_model;

    public function __construct($id_estabelecimento_trabalho)
    {
        $this->estabelecimento_trabalho_model = new EstabelecimentoTrabalhoModel($id_estabelecimento_trabalho);
    }

    public function cadastrarEstabelecimentoTrabalho($valores_estabelecimento_trabalho) : string | null {
        try {
            $persistencia_banco = $this->estabelecimento_trabalho_model->inserirEstabelecimentoTrabalho($valores_estabelecimento_trabalho);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoEstabelecimentoTrabalho();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Excessão encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoEstabelecimentoTrabalho() : string {
        try {
            return $this->estabelecimento_trabalho_model->getUltimoIdInsercaoEstabelecimento();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}

?>