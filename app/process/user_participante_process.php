<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

    if($_REQUEST['METHOD'] === 'POST'){
        $telefone_passado = $_POST['telefone'];
        $user_participante_controler = new UserParticipanteControler($telefone_passado);
        $user_participante_controler->cadastrarUserParticipante();
    }
    else{

    }





?>