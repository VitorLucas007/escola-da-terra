<?php
// ARQUIVO TEMPORÁRIO DE DIAGNÓSTICO - APAGUE DEPOIS DE USAR
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=utf-8');

echo "PHP: " . PHP_VERSION . "\n";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "pdo_mysql: " . (extension_loaded('pdo_mysql') ? 'sim' : 'NAO') . "\n\n";

$arquivos = [
    '/config/ConexaoBanco.php',
    '/app/model/BancoDeDados.php',
    '/app/model/PesquisadorModel.php',
    '/app/controler/PesquisadorController.php',
];
foreach ($arquivos as $a) {
    echo $a . ': ' . (file_exists($_SERVER['DOCUMENT_ROOT'] . $a) ? 'existe' : 'NAO EXISTE') . "\n";
}

echo "\nConectando ao banco...\n";
try {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/ConexaoBanco.php';
    $pdo = (new ConexaoBanco())->getConexaoBanco();
    echo "Conexao OK\n\nTabelas:\n";
    foreach ($pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN) as $t) {
        echo " - $t\n";
    }

    session_start();
    echo "\nSessao: id_pesquisador = " . var_export($_SESSION['id_pesquisador'] ?? null, true)
        . " | nome = " . var_export($_SESSION['nome_pesquisador'] ?? null, true) . "\n";

    echo "\nUserAdmin:\n";
    foreach ($pdo->query('SELECT id_user, nome, email FROM UserAdmin')->fetchAll() as $r) {
        echo " - id_user={$r['id_user']} | {$r['nome']} | {$r['email']}\n";
    }

    echo "\nUserParticipante:\n";
    foreach ($pdo->query('SELECT id_participante, telefone, progresso_participante, id_pesquisador_responsavel FROM UserParticipante')->fetchAll() as $r) {
        echo " - id={$r['id_participante']} | tel={$r['telefone']} | progresso={$r['progresso_participante']} | dono=" . var_export($r['id_pesquisador_responsavel'], true) . "\n";
    }
} catch (Throwable $e) {
    echo "ERRO: " . $e->getMessage() . "\n";
}
