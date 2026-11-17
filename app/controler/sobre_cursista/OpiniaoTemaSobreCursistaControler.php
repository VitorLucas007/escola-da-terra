<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_cursista/OpiniaoTemaSobreCursistaModel.php';

class OpiniaoTemaSobreCursistaControler{

    private $opiniao_tema_sobre_cursista_model;

    public function __construct($sobre_cursista_id){
        $this->opiniao_tema_sobre_cursista_model = new OpiniaoTemaSobreCursistaModel($sobre_cursista_id);
    }

    public function cadastrarOpiniaoTemaSobreCursista($tema_opiniao, $texto_opiniao): bool{
        try{
            return $this->opiniao_tema_sobre_cursista_model->cadastrarOpiniaoTemaSobreCursistaBanco($tema_opiniao, $texto_opiniao);
        }
        catch(Exception $exception){
            $_SESSION['mensagem_excecao'] = "Erro ao persistir os dados de opiniões sobre temas.";
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarOpinioesPorCursistaId($id_sobre_cursista) {
    try {
        return $this->opiniao_tema_sobre_cursista_model->buscarPorCursistaIdBanco($id_sobre_cursista);
    } catch (Exception $e) {
        return [];
    }
}

}

?>