<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_cursista/CompartilhamentoResidenciaModel.php';

class CompartilhamentoResidenciaControler{

    private $compartilhamento_residencia_model;
    
    public function __construct($sobre_cursista_id){
        $this->compartilhamento_residencia_model = new CompartilhamentoResidenciaModel($sobre_cursista_id);
    }

    public function cadastrarCompartilhamentoResidencia($valor_compartilhamento): bool {
        try{
            return $this->compartilhamento_residencia_model->cadastrarCompartilhamentoResidenciaBanco($valor_compartilhamento);
        }
        catch(Exception $exception){
            $_SESSION['mensagem_excecao'] = "Erro ao persistir os dados de compartilhamento de residência\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }



}


?>