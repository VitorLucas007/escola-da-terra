<?php
$host = 'localhost';            // Host do banco (geralmente 'localhost')
$db   = 'nome_do_banco';        // Nome do banco de dados
$user = 'usuario';              // Usuário do banco
$pass = 'senha';                // Senha do banco
$charset = 'utf8mb4';           // Charset recomendado

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mostra erros como exceções
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna dados como array associativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepared statements reais
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Conexão estabelecida com sucesso!";
} catch (PDOException $e) {
    die('Erro ao conectar: ' . $e->getMessage());
}
?>
