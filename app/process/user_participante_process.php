<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/habilitar_debug_erro.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';
    
    $metodo_requisicao = $_SERVER['REQUEST_METHOD'];
    
    if($metodo_requisicao === 'POST'){
        $telefone_passado = $_POST['telefone'];
        $user_participante_controler = new UserParticipanteControler($telefone_passado);
        $participante_existente =  $user_participante_controler->verificarExistenciaUserParticipante();
    }
    else{
        echo "<h1 style='text-align: center;'>Método de requisição inválido</h1>";
    }

?>