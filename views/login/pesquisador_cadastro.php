<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Lógica para buscar e limpar mensagens de erro da sessão
    $mensagem_erro_cadastro = $_SESSION['mensagem_erro_cadastro'] ?? '';
    unset($_SESSION['mensagem_erro_cadastro']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pesquisador - Escola da Terra</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="icon" type="image/jpg" href="/public/assets/logos/favicon.jpg">
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/cdn.php';
    ?>
</head>
<body>
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
    ?>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card p-4 shadow-sm" style="max-width: 450px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Cadastro de Pesquisador</h2>

                <?php if (!empty($mensagem_erro_cadastro)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($mensagem_erro_cadastro) ?>
                    </div>
                <?php endif; ?>

                <form action="/app/process/pesquisador_cadastro_process.php" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label fw-bold">Nome Completo:</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label fw-bold">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label fw-bold">Confirmar Senha:</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control" required>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
                <p class="mt-3 text-center">
                    Já tem uma conta? <a href="/index.php">Faça o login</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>