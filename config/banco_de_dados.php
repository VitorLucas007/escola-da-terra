<?php
$host = 'localhost';            
$db   = 'pesquisa_educacional';        
$user = 'root';              
$pass = '';                
$charset = 'utf8mb4';           

$informacoes_banco = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mostra erros como exceções
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna dados como array associativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepared statements reais
];

try {
    $pdo = new PDO($informacoes_banco, $user, $pass, $options);
    // echo "Conexão estabelecida com sucesso!";
} catch (PDOException $e) {
    die('Erro ao conectar: ' . $e->getMessage());
}
?>
