<?php
// Inicia a sessão se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// VERIFICAÇÃO DE SEGURANÇA: Se não houver um pesquisador logado, redireciona para o login
if (!isset($_SESSION['id_pesquisador'])) {
    header('Location: /pesquisa_educacional/index.php');
    exit();
}

// Inclui o seu Controller
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

// Pega o ID do pesquisador logado
$id_pesquisador_logado = $_SESSION['id_pesquisador'];

// Cria uma instância do seu controller
$userController = new UserParticipanteControler();

// Busca APENAS os participantes deste pesquisador
$participantes = $userController->listarParticipantesPorPesquisador($id_pesquisador_logado);

// Define o número total de formulários para o cálculo da barra de progresso
$total_formularios = 7;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Participantes</title>
    
    <?php
        // Inclui o arquivo com os links do Bootstrap e seus ícones
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php';
    ?>
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
</head>
<body>

    <?php
        // Inclui o cabeçalho da sua página
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php';
    ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Meus Participantes</h2>
            <div>
                <a href="/pesquisa_educacional/views/pesquisador/pesquisador_dashboard.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Voltar ao Dashboard
                </a>
            </div>
        </div>

        <!-- Informação do pesquisador logado -->
        <div class="alert alert-info mb-4">
            <i class="bi bi-person-circle me-2"></i>
            <strong>Pesquisador:</strong> <?php echo htmlspecialchars($_SESSION['nome_pesquisador']); ?>
            <span class="ms-3">
                <i class="bi bi-list-ol me-2"></i>
                <strong>Total de participantes:</strong> <?php echo count($participantes); ?>
            </span>
        </div>

        <?php if (!empty($participantes)): ?>
            <div class="row justify-content-center g-4">
                <?php foreach ($participantes as $participante): ?>
                    <?php
                        // Garante que o progresso não ultrapasse o total
                        $progresso_atual = min($participante['progresso_participante'], $total_formularios);
                        // Calcula a largura da barra em porcentagem
                        $largura_percentual = ($progresso_atual / $total_formularios) * 100;
                        
                        // Define a cor da barra baseada no progresso
                        if ($progresso_atual == $total_formularios) {
                            $cor_barra = 'bg-success'; // Verde se completou
                        } elseif ($progresso_atual >= $total_formularios / 2) {
                            $cor_barra = 'bg-info'; // Azul se passou da metade
                        } else {
                            $cor_barra = 'bg-warning'; // Amarelo se está no início
                        }
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
                                        <div class="progress-bar <?php echo $cor_barra; ?>" style="width: <?php echo $largura_percentual; ?>%">
                                            <?php echo $progresso_atual; ?>/<?php echo $total_formularios; ?>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <?php 
                                            if ($progresso_atual == $total_formularios) {
                                                echo '<i class="bi bi-check-circle-fill text-success me-1"></i>Pesquisa completa!';
                                            } else {
                                                echo 'Etapa ' . $progresso_atual . ' de ' . $total_formularios;
                                            }
                                        ?>
                                    </small>
                                </div>

                                <div class="mt-auto pt-3">
                                    <a href="/pesquisa_educacional/views/listagens/listagem_respostas.php?id=<?php echo htmlspecialchars($participante['id_participante']); ?>" class="btn btn-primary w-100">
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
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Você ainda não possui participantes cadastrados.
                <div class="mt-3">
                    <a href="/pesquisa_educacional/views/pages/participante_login.php" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Cadastrar Primeiro Participante
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>