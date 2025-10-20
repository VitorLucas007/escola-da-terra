<?php
// Inicia a sessão para que possamos manipulá-la.
// É importante iniciar a sessão antes de destruí-la.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Limpa todas as variáveis da sessão.
// Isso remove os dados como 'id_pesquisador' e 'nome_pesquisador'.
$_SESSION = array();

// Destrói a sessão.
// Isso invalida o ID da sessão no lado do servidor.
session_destroy();

// Redireciona o usuário para a página de login.
// O usuário agora está efetivamente deslogado.
header('Location: /pesquisa_educacional/index.php');
exit;
?>