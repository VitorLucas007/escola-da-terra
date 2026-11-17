<?php
// Inicia a sessão se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclui o seu Controller
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/UserParticipanteControler.php';

// Cria uma instância do seu controller
$userController = new UserParticipanteControler();

// Chama a função para buscar todos os participantes
$participantes = $userController->listarTodosUsersParticipantes();

// Define o número total de formulários para o cálculo da barra de progresso
$total_formularios = 7;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Participantes</title>
    
    <?php
        // Inclui o seu arquivo com os links do Bootstrap e seus ícones
        include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/cdn.php';
    ?>
    <link rel="icon" type="image/jpg" href="/public/assets/logos/favicon.jpg">
</head>
<body>

    <?php
        // Inclui o cabeçalho da sua página
        include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
    ?>

    <div class="container mt-5">
        <h2 class="text-center fw-bold mb-4">Participantes da Pesquisa</h2>

        <?php if (!empty($participantes)): ?>
            <div class="row justify-content-center g-4">
                <?php foreach ($participantes as $participante): ?>
                    <?php
                        // Garante que o progresso não ultrapasse o total
                        $progresso_atual = min($participante['progresso_participante'], $total_formularios);
                        // Calcula a largura da barra em porcentagem
                        $largura_percentual = ($progresso_atual / $total_formularios) * 100;
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm border-0 rounded-3 h-100 position-relative">
                            <div class="card-body d-flex flex-column">
                                <span class="position-absolute top-0 end-0 p-2 text-muted fw-bold">
                                    ID: <?php echo htmlspecialchars($participante['id_participante']); ?>
                                </span>
                                
                                <h5 class="card-title mt-3 fs-4">
                                    <i class="bi bi-telephone-fill me-2"></i>
                                    <?php echo htmlspecialchars($participante['telefone']); ?>
                                </h5>
                                
                                <div class="mt-3">
                                    <label class="form-label fw-bold">Progresso:</label>
                                    <div class="progress" role="progressbar" aria-label="Progresso do participante" aria-valuenow="<?php echo $progresso_atual; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_formularios; ?>">
                                        <div class="progress-bar bg-success" style="width: <?php echo $largura_percentual; ?>%">
                                            Etapa <?php echo htmlspecialchars($progresso_atual); ?> de <?php echo $total_formularios; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto pt-3 text-center">
                                    <a href="/views/listagens/listagem_respostas.php?id=<?php echo htmlspecialchars($participante['id_participante']); ?>" class="btn btn-primary w-100">
                                        <i class="bi bi-eye-fill me-2"></i> Ver Respostas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                Nenhum participante encontrado no banco de dados.
            </div>
        <?php endif; ?>
    </div>

</body>
</html>