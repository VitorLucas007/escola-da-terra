<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/PesquisadorModel.php';

class PesquisadorController {

    private $pesquisadorModel;

    public function __construct() {
        $this->pesquisadorModel = new PesquisadorModel();
    }

    /**
     * Processa a tentativa de login de um pesquisador. (VERSÃO FINAL E CORRIGIDA)
     */
    public function processarLogin($email, $senha) {
        try {
            $pesquisador = $this->pesquisadorModel->buscarPorEmailBanco($email);

            if ($pesquisador && $this->pesquisadorModel->verificarSenha($senha, $pesquisador['senha'])) {
                
                session_regenerate_id(true);
                $_SESSION['id_pesquisador'] = $pesquisador['id_user']; 
                $_SESSION['nome_pesquisador'] = $pesquisador['nome'];
                
                // CAMINHO FINAL CORRETO: Apontando para sua pasta "views/pesquisador/"
                header('Location: /pesquisa_educacional/views/pesquisador/pesquisador_dashboard.php');
                exit;

            } else {
                $_SESSION['mensagem_erro_pesquisador'] = "Email ou senha inválidos.";
                header('Location: /pesquisa_educacional/index.php');
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['mensagem_excecao'] = "Erro durante o login: " . $e->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    /**
     * Processa o cadastro de um novo pesquisador.
     */
    public function processarCadastro($nome, $email, $senha, $confirmar_senha) {
        try {
            if ($senha !== $confirmar_senha) {
                $_SESSION['mensagem_erro_cadastro'] = "As senhas não coincidem.";
                // CAMINHO FINAL CORRETO: Apontando para sua pasta "views/login/"
                header('Location: /pesquisa_educacional/views/login/pesquisador_cadastro.php');
                exit;
            }

            if ($this->pesquisadorModel->buscarPorEmailBanco($email)) {
                $_SESSION['mensagem_erro_cadastro'] = "Este email já está em uso.";
                header('Location: /pesquisa_educacional/views/login/pesquisador_cadastro.php');
                exit;
            }

            if ($this->pesquisadorModel->cadastrarPesquisadorBanco($nome, $email, $senha)) {
                $_SESSION['mensagem_sucesso_cadastro'] = "Cadastro realizado com sucesso! Faça o login.";
                header('Location: /pesquisa_educacional/index.php');
                exit;
            } else {
                throw new Exception("A persistência no banco falhou.");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem_excecao'] = "Erro durante o cadastro: " . $e->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}
?>