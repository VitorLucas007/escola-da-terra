<?php
// Bloco para processar o logout
if (isset($_POST['finalizar_sessao'])) {
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/SucessController.php';
    
    $controller = new SuccessController();
    
    // Executa as funções de logout e redirecionamento
    $controller->finalizarSessao();
    $controller->redirecionarParaInicio();
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa Concluída</title>
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php'; ?>
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
</head>

<body class="bg-light">
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php'; ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5 shadow">
                    <div class="card-body text-center p-5">
                        
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        
                        <h2 class="card-title text-success mb-4">Pesquisa Concluída!</h2>
                        
                        <p class="card-text mb-4 text-muted">
                            Obrigado por participar da nossa pesquisa educacional. 
                            Suas respostas são muito importantes para nosso estudo.
                        </p>
                        
                        <form action="" method="POST">
                            <button type="submit" name="finalizar_sessao" class="btn btn-danger btn-lg">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Finalizar e Sair
                            </button>
                        </form>
                        
                        <p class="text-muted small mt-3">
                            Ao clicar em "Finalizar e Sair", sua sessão será encerrada.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>