<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Lógica para mensagens de erro do login do PESQUISADOR (se houver)
    $mensagem_erro_pesquisador = $_SESSION['mensagem_erro_pesquisador'] ?? '';
    unset($_SESSION['mensagem_erro_pesquisador']);

    $_SESSION['ultima_pagina'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Pesquisador - Escola da Terra</title>
    <link rel="stylesheet" href="/pesquisa_educacional/public/css/index.css">
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php';
    ?>
</head>
<body>
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php';
    ?>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login do Pesquisador</h2>

                <?php if (!empty($mensagem_erro_pesquisador)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($mensagem_erro_pesquisador) ?>
                    </div>
                <?php endif; ?>

                <form action="/pesquisa_educacional/app/process/pesquisador_login_process.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@exemplo.com" required autocomplete="email">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label fw-bold">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p class="mt-3 text-center">
                    Não tem uma conta? <a href="/pesquisa_educacional/views/login/pesquisador_cadastro.php">Registre-se aqui</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>