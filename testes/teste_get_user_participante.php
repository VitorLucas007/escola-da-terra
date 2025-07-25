<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/habilitar_debug_erro.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';
    
    $metodo_requisicao = $_SERVER['REQUEST_METHOD'];
    
    if($metodo_requisicao === 'POST'){
        $telefone = "(86) 99525-420";
        $user_participante_controler = new UserParticipanteControler();
        $participante =  $user_participante_controler->getUserParticipante($telefone);
        echo "Telefone -> " . $participante->getTelefone();
    }
    else{
        echo "<h1 style='text-align: center;'>Método de requisição inválido</h1>";
    }
?>