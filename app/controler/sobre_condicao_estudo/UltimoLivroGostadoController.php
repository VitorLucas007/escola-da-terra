<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_condicao_estudo/UltimoLivroGostadoModel.php';

class UltimoLivroGostadoController {
    private $ultimo_livro_gostado_model;

    public function __construct($id_ultimo_livro_gostado)
    {
        $this->ultimo_livro_gostado_model = new UltimoLivroGostadoModel($id_ultimo_livro_gostado);
    }

    public function cadastrarDadosUltimoLivroGostado($valores_ultimo_livro_gostado): string | null {
        try {
            $persistencia_banco = $this->ultimo_livro_gostado_model->cadastrarUltimoLivroGostado($valores_ultimo_livro_gostado);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoUltimoLivroGostado();
                return $ultimo_id_insercao;
            }

            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Excessão encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoUltimoLivroGostado(): string {
        try {
            return $this->ultimo_livro_gostado_model->getUltimoIdInsercaoUltimoLivroGostado();
        } catch (Exception $excpetion) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

}

?>