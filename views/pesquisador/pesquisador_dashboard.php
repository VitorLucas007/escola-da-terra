<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. VERIFICAÇÃO DE SEGURANÇA
// Se não houver um pesquisador logado, redireciona para a página de login.
if (!isset($_SESSION['id_pesquisador'])) {
    header('Location: /pesquisa_educacional/index.php');
    exit();
}

// 2. BUSCAR OS DADOS
// Inclui o Model para podermos usá-lo
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/PesquisadorModel.php';

// Pega o ID do pesquisador da sessão
$id_pesquisador_logado = $_SESSION['id_pesquisador'];

// Cria uma instância do Model
$pesquisadorModel = new PesquisadorModel();

// Busca os dados completos do pesquisador (para garantir que temos o email mais atual)
$pesquisador = $pesquisadorModel->buscarPorIdBanco($id_pesquisador_logado);

// Se por algum motivo o pesquisador não for encontrado no banco, desloga por segurança
if (!$pesquisador) {
    session_destroy();
    header('Location: /pesquisa_educacional/index.php');
    exit();
}

// Busca a contagem de participantes associados a este pesquisador
$quantidade_participantes = $pesquisadorModel->contarParticipantesPorPesquisadorID($id_pesquisador_logado);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Pesquisador</title>
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php'; ?>
    <style>
        .dashboard-card {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard do Pesquisador</h2>
            <a href="/pesquisa_educacional/app/process/logout_process.php" class="btn btn-danger">Sair</a>
        </div>
        
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Pesquisador</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nome:</strong> <?php echo htmlspecialchars($pesquisador['nome']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($pesquisador['email']); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-4 mt-md-0">
                <div class="card text-center dashboard-card">
                     <div class="card-body">
                        <h5 class="card-title">Participantes Coletados</h5>
                        <p class="display-4 fw-bold"><?php echo $quantidade_participantes; ?></p>
                        <p class="card-text">Total de questionários associados a você.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3>Ações</h3>
            <div class="d-grid gap-2 d-md-flex">
                <a href="/pesquisa_educacional/views/login/participante_login.php" class="btn btn-success btn-lg flex-grow-1">
                    <i class="bi bi-play-circle-fill me-2"></i> Iniciar Pesquisa com Novo Participante
                </a>
                <a href="/pesquisa_educacional/views/listagens/listar_participantes.php" class="btn btn-primary btn-lg flex-grow-1 mt-2 mt-md-0">
                    <i class="bi bi-people-fill me-2"></i> Ver Todos os Meus Participantes
                </a>
            </div>
        </div>

    </div>
</body>
</html>