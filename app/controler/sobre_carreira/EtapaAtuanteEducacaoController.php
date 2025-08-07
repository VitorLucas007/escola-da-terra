<?php 

if (session_start() == PHP_SESSION_NONE) {
    session_start();
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_carreira/EtapaAtuanteEducacaoControllerModel.php';


class EtapaAtuanteEducacaoController {
    private $etapa_atuante_educacao_model;

    public function __construct($id_etapa_atuante_educacao) {
        $this->etapa_atuante_educacao_model = new EtapaAtuanteEducacaoModel($id_etapa_atuante_educacao);
    }

    public function cadastrarDadosEtapaAtuanteEducacao($valores_etapa_atuante_educacao) : string | null {
        try {
            $persistencia_banco = $this->etapa_atuante_educacao_model->inserirEtapaAtuanteEducacao($valores_etapa_atuante_educacao);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoEtapaAtuanteEducacao();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }
    
    public function getUltimoIdInsercaoEtapaAtuanteEducacao() : string {
        try {
            return $this->etapa_atuante_educacao_model->getUltimoIdInsercaoEtapaAtuante();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
        
}

?>