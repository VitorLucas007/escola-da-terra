<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_condicao_estudo/CategoriaLivroFrequenteModel.php';

class CategoriaLivroFrequenteController {
    private $categoria_livro_frequente_model;

    public function __construct($id_categoria_livro_frequente)
    {
        $this->categoria_livro_frequente_model = new CategoriaLivroFrequenteModel($id_categoria_livro_frequente);
    }

    public function cadastrarDadosCategoriaLivroFrequente($valores_categoria_livro_frequente): string | null {
        try {
            $persistencia_banco = $this->categoria_livro_frequente_model->cadastrarCategoriaLivroFrequente($valores_categoria_livro_frequente);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoCategoriaLivroFrequente();
                return $ultimo_id_insercao;
            }

            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Excessão encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoCategoriaLivroFrequente(): string {
        try {
            return $this->categoria_livro_frequente_model->getUltimoIdInsercaoCategoriaLivroFrequente();
        } catch (Exception $excpetion) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

}

?>