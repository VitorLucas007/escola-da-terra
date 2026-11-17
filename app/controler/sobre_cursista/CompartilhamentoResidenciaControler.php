<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_cursista/CompartilhamentoResidenciaModel.php';

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
<<<<<<< HEAD
            $_SESSION['mensagem_excecao'] = "Erro ao persistir os dados de compartilhamento de residência\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
=======
            echo "Erro encontrado -> " . $exception->getMessage();
            $_SESSION['mensagem_excecao'] = "Erro ao persistir os dados de compartilhamento de residência";
            header("Location: /views/erro.php");
>>>>>>> lucas
            exit;
        }
    }

    public function buscarCompartilhamentosPorCursistaId($id_sobre_cursista) {
    try {
        return $this->compartilhamento_residencia_model->buscarPorCursistaIdBanco($id_sobre_cursista);
    } catch (Exception $e) {
        return []; 
    }
}

}


?>