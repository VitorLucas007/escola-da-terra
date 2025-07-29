<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_cursista/OpiniaoTemaSobreCursistaModel.php';

class OpiniaoTemaSobreCursistaControler{

    private $opiniao_tema_sobre_cursista_model;

    public function __construct($sobre_cursista_id){
        $this->opiniao_tema_sobre_cursista_model = new OpiniaoTemaSobreCursistaModel($sobre_cursista_id);
    }

    public function cadastrarOpiniaoTemaSobreCursista($tema_opiniao, $texto_opiniao): bool{
        try{

        }
        catch(Exception $exception){
            $exception->getMessage()
        }
    }



}

?>