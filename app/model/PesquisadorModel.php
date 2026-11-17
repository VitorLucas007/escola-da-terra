<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class PesquisadorModel {

    private $banco_de_dados;

    public function __construct() {
        $this->banco_de_dados = new BancoDeDados();
    }

    public function cadastrarPesquisadorBanco($nome, $email, $senhaPura) {
        $senhaHash = password_hash($senhaPura, PASSWORD_DEFAULT);

        $sql = "INSERT INTO UserAdmin (nome, email, senha) VALUES (:nome, :email, :senha)";

        $parametros = [
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function buscarPorEmailBanco($email) {
        $sql = "SELECT id_user, nome, email, senha FROM UserAdmin WHERE email = :email";
        
        $parametros = [
            ':email' => $email
        ];

        $resultado = $this->banco_de_dados->consultar($sql, $parametros);

        return $resultado[0] ?? null;
    }

    public function verificarSenha($senhaFornecida, $senhaHashDoBanco) {
        return password_verify($senhaFornecida, $senhaHashDoBanco);
    }

    /**
     * Busca os dados de um pesquisador pelo seu ID.
     */
    public function buscarPorIdBanco($id) {
        $sql = "SELECT id_user, nome, email FROM UserAdmin WHERE id_user = :id";
        
        $parametros = [
            ':id' => $id
        ];

        $resultado = $this->banco_de_dados->consultar($sql, $parametros);

        return $resultado[0] ?? null;
    }

    /**
     * Conta o número total de participantes associados a um pesquisador específico.
     */
    public function contarParticipantesPorPesquisadorID($id_pesquisador) {
        $sql = "SELECT COUNT(*) as total FROM UserParticipante WHERE id_pesquisador_responsavel = :id_pesquisador";
        
        $parametros = [
            ':id_pesquisador' => $id_pesquisador
        ];

        $resultado = $this->banco_de_dados->consultar($sql, $parametros);

        return (int) ($resultado[0]['total'] ?? 0);
    }

    /**
 * Busca todos os participantes associados a um pesquisador específico.
 */
public function buscarParticipantesPorPesquisadorId($id_pesquisador) {
    $sql = "SELECT * FROM UserParticipante WHERE id_pesquisador_responsavel = :id_pesquisador ORDER BY id_participante DESC";
    
    $parametros = [
        ':id_pesquisador' => $id_pesquisador
    ];

    return $this->banco_de_dados->consultar($sql, $parametros);
}
}
?>