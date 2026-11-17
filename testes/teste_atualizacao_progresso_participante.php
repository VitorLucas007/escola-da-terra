<?php 


    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/habilitar_debug_erro.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/UserParticipanteControler.php';
    
    $metodo_requisicao = $_SERVER['REQUEST_METHOD'];
    
    if($metodo_requisicao === 'POST'){
        $progresso = 7;
        $user_participante_controler = new UserParticipanteControler();
        $user_participante_controler->atualizarProgressoParticipante(1, $progresso);
    }
    else{
        echo "<h1 style='text-align: center;'>Método de requisição inválido</h1>";
    }
?>