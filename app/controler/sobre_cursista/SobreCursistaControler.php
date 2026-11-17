<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_cursista/SobreCursistaModel.php';

class SobreCursistaControler{
    private $sobre_cursista_model; 

    public function __construct($participante_id = null){
        $this->sobre_cursista_model = new SobreCursistaModel($participante_id);
    }

    public function cadastrarDadosSobreCursista($valores_sobre_cursista) : string | null {
        try{
            $persistencia_banco = $this->sobre_cursista_model->cadastrarDadosSobreCursistaBanco($valores_sobre_cursista);
            if($persistencia_banco){
                $ultimo_id_insercao = $this->getUltimoIdIsercaoSobreCursista();
                return $ultimo_id_insercao;
            }
            // $_SESSION['mensagem_excecao'] = "Ocorreu um erro ao cadastrar os dados do formulário, tente novamente.";
            // header("Location: /views/erro.php");
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        }
        catch(Exception $exception){
            // $_SESSION['mensagem_excecao'] = $exception->getMessage();
            // header("Location: /views/erro.php");
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdIsercaoSobreCursista() : string{
        try{
            return $this->sobre_cursista_model->getUltimoIdInsercaoSobreCursistaBanco();
        }
        catch(Exception $exception){
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarCursistaPorParticipanteId($id_participante) {
    try {
        return $this->sobre_cursista_model->buscarDadosPorParticipanteIdBanco($id_participante);
    } catch (Exception $e) {
        return null;
    }
}

}


?>

