<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_cursista/SobreCursistaModel.php';

class SobreCursistaControler{
    private $sobre_cursista_model; 

    public function __construct($participante_id){
        $this->sobre_cursista_model = new SobreCursistaModel($participante_id);
    }

    public function cadastrarDadosSobreCursista($valores_sobre_cursista) : void {
        try{
            $persistencia_banco = $this->sobre_cursista_model->cadastrarDadosSobreCursistaBanco($valores_sobre_cursista);
            if($persistencia_banco){
                return;
            }
            $_SESSION['mensagem_excecao'] = "Ocorreu um erro ao cadastrar os dados do formulário, tente novamente.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
        catch(Exception $exception){
            $_SESSION['mensagem_excecao'] = $exception;
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function getUltimoIdIsercaoSobreCursista() : string{
        try{
            return $this->sobre_cursista_model->getUltimoIdInsercaoSobreCursistaBanco();
        }
        catch(Exception $exception){
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
        
    }



}


?>

