<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start();
    }
    $mensagem_excecao = $_SESSION['mensagem_excecao'] ?? '';
    unset($mensagem_excecao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro encontrado</title>
        <link rel="stylesheet" href="../public/css/erro.css">
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg"> 
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/habilitar_debug_erro.php'
    ?>
</head>

<body>

    <div class="container">
        <div class="container-body">
            <div class="fw-bold text-center mb-4">
                Desculpe, ocorreu um erro interno, tente a ação novamente.
                <?php if (!empty($mensagem_excecao)): ?>
                    <div class="alert alert-info">
                        <?= htmlspecialchars($mensagem_excecao) ?>
                    </div>    
                <?php endif; ?>
            </div>
            <a class="btn btn-sm btn-secondary" href="<?=$_SESSION['ultima_pagina']?>">Voltar</a>
        </div>
    </div>


</body>
</html>