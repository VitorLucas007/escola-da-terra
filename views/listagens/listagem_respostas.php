<?php
// Inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// VERIFICAÇÃO INICIAL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /views/listar_participantes.php");
    exit;
}
$id_participante = $_GET['id'];

// INCLUI O CONTROLLER PRINCIPAL
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/ParticipanteRespostaController.php';

try {
    // Instancia o controller e obtém todos os dados
    $controller = new ParticipanteResponseController($id_participante);
    $dados = $controller->obterDadosCompletos();
    
    // Verifica se o participante existe
    if (!$dados['participante']) {
        header("Location: /views/listar_todos_users_participantes.php");
        exit;
    }
    
    // Extrai o participante para ser usado no cabeçalho
    $participante = $dados['participante'];

} catch (Exception $e) {
    // Log do erro e redirecionamento
    error_log("Erro ao carregar dados do participante {$id_participante}: " . $e->getMessage());
    header("Location: /views/listar_todos_users_participantes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respostas do Participante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="/public/assets/logos/favicon.jpg">
    <style>
        body { background-color: #f8f9fa; }
        .card-header { background-color: #343a40; color: white; }
    </style>

    
</head>

<body>
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
    ?>

    <div class="container my-5">
        <div class="card shadow-sm mb-5">
            <div class="card-header">
                <h4 class="mb-0">Respostas do Participante</h4>
            </div>
            <div class="card-body">
                <p class="fs-5"><strong>ID:</strong> <?php echo htmlspecialchars($participante['id_participante']); ?></p>
                <p class="fs-5 mb-0"><strong>Telefone:</strong> <?php echo htmlspecialchars($participante['telefone']); ?></p>
            </div>
        </div>

        <?php 
        $dados_cursista = $dados['cursista'];
        include $_SERVER['DOCUMENT_ROOT'] . '/views/sections/cursista_section.php'; 
        ?>
        
        <?php 
        $dados_familia = $dados['familia'];
        include $_SERVER['DOCUMENT_ROOT'] . '/views/sections/familia_section.php'; 
        ?>
        
        <?php 
        $dados_formacao = $dados['formacao'];
        include $_SERVER['DOCUMENT_ROOT'] . '/views/sections/formacao_section.php'; 
        ?>
        
        <?php 
        $dados_carreira = $dados['carreira'];
        include $_SERVER['DOCUMENT_ROOT'] . '/views/sections/carreira_section.php'; 
        ?>
        
        <?php 
        $dados_exercicio = $dados['exercicio'];
        include $_SERVER['DOCUMENT_ROOT'] . '/views/sections/exercicio_section.php'; 
        ?>
        
        <?php 
        $dados_condicao_estudo = $dados['condicao_estudo'];
        include $_SERVER['DOCUMENT_ROOT'] . '/views/sections/condicao_estudo_section.php'; 
        ?>
         
        <?php 
        $dados_vida_geral = $dados['vida_geral'];
        include $_SERVER['DOCUMENT_ROOT'] . '/views/sections/vida_geral_section.php'; 
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>