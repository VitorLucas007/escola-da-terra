<?php

class SuccessController {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function verificarSessaoValida() {
        return isset($_SESSION['id_participante']) && !empty($_SESSION['id_participante']);
    }
    
    public function obterDadosParticipante() {
        if (!$this->verificarSessaoValida()) {
            return null;
        }
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/UserParticipanteControler.php';
        
        $userController = new UserParticipanteControler();
        return $userController->buscarParticipantePorId($_SESSION['id_participante']);
    }
    
    public function atualizarProgressoFinalizado() {
        if (!$this->verificarSessaoValida()) {
            return false;
        }
        return true;
    }
    
    public function finalizarSessao() {
        $_SESSION = array();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        return true;
    }
    
    public function redirecionarParaInicio() {
        header("Location: /index.php");
        exit;
    }
}

// Verifica se o arquivo está sendo acessado diretamente por uma requisição
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['finalizar_sessao'])) {
        $controller = new SuccessController();
        $controller->finalizarSessao();
        $controller->redirecionarParaInicio();
    }
}