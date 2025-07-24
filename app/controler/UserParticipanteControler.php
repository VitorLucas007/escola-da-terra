<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/UserParticipanteModel.php';

class UserParticipanteControler{

    private $user_participante_model;

    public function __construct($telefone_passado=0, $progresso_participante_passado=1){
        $this->user_participante_model = new UserParticipanteModel($ $telefone_passado, $progresso_participante_passado);
    }

    public function cadastrarUserParticipante(){
        $persistencia_banco = $this->user_participante_model->cadastrarUserParticipanteBanco();
        if($persistencia_banco){
            header('Location: /pesquisa_educaional/views/formularios/formulario_sobre_cursista.php');
            exit;
        }
        else{

        }
    }   


}

?>