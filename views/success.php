<!-- success.php -->
<?php
// Exemplo: captura de dados do formulário (se necessário)
// $nome = $_POST['nome'] ?? '';
// $email = $_POST['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sucesso</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow-lg border-0 rounded-4 p-4 text-center" style="max-width: 450px; width: 100%;">
    <div class="card-body">
      <div class="mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
      </div>
      
      <h3 class="fw-bold text-success">Dados enviados com sucesso!</h3>
      <p class="text-muted mt-2">Seu formulário foi processado corretamente. O que deseja fazer agora?</p>

      <div class="d-grid gap-3 mt-4">
        <a href="continuar.php" class="btn btn-primary btn-lg rounded-pill">Continuar</a>
        <a href="salvar.php" class="btn btn-outline-secondary btn-lg rounded-pill">Salvar progresso</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
