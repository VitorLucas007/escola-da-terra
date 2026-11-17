<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/PesquisadorController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // Instancia o controller e chama o método de processamento
    $controller = new PesquisadorController();
    $controller->processarCadastro($nome, $email, $senha, $confirmar_senha);
} else {
    // Redireciona se o acesso não for via POST
    header('Location: /views/login/pesquisador_cadastro.php');
    exit;
}
?>