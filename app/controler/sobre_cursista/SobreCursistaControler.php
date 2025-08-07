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

    public function cadastrarDadosSobreCursista($valores_sobre_cursista) : string | null {
        try{
            $persistencia_banco = $this->sobre_cursista_model->cadastrarDadosSobreCursistaBanco($valores_sobre_cursista);
            if($persistencia_banco){
                $ultimo_id_insercao = $this->getUltimoIdIsercaoSobreCursista();
                return $ultimo_id_insercao;
            }
            $_SESSION['mensagem_excecao'] = "Infelizmente não foi possível cadastrar os dados sobre o cursista, tente novamente.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
        catch(Exception $exception){
            $_SESSION['mensagem_excecao'] = "Erro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function getUltimoIdIsercaoSobreCursista() : string{
        try{
            return $this->sobre_cursista_model->getUltimoIdInsercaoSobreCursistaBanco();
        }
        catch(Exception $exception){
            $_SESSION['mensagem_excecao'] = "Infelizmente ocorreu um erro interno ao obter dados auxiliáres de ID.\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
        
    }



}


?>

