<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_familia/InformacaoFilhoMenorIdadeModel.php';

class InformacaoFilhoMenorIdadeController
{
    private $informacao_filho_menor_idade_model;

    public function __construct($id_informacao_filho_menor_idade)
    {
        $this->informacao_filho_menor_idade_model = new InformacaoFilhoMenorIdadeModel($id_informacao_filho_menor_idade);
    }

    public function cadastrarDadosInformacaoFilhoMenor($valores_informacao_filho_menor): string | null
    {
        try {
            $persistencia_banco = $this->informacao_filho_menor_idade_model->inserirInformacaoFilhoMenor($valores_informacao_filho_menor);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoInformacaoFilhoMenor();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoInformacaoFilhoMenor(): string
    {
        try {
            return $this->informacao_filho_menor_idade_model->getUltimoIdInsercaoInformacaoFilhoMenor();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}
