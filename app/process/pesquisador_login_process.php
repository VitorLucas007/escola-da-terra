<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/PesquisadorController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $controller = new PesquisadorController();
    $controller->processarLogin($email, $senha);
} else {
    // Redireciona se o acesso não for via POST
    header('Location: /index.php');
    exit;
}
?>