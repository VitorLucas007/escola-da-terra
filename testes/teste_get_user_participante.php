<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/habilitar_debug_erro.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/UserParticipanteControler.php';
    
    $metodo_requisicao = $_SERVER['REQUEST_METHOD'];
    
    if($metodo_requisicao === 'POST'){
        $telefone = "(86) 99125-4202";
        $user_participante_controler = new UserParticipanteControler($telefone);
        $participante =  $user_participante_controler->getUserParticipante();
    }
    else{
        echo "<h1 style='text-align: center;'>Método de requisição inválido</h1>";
    }
?>