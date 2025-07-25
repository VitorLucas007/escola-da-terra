<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

class UserParticipanteModel {

    private $banco_de_dados;
    private $id_participante;
    private $telefone;
    private $progresso_participante;

    public function __construct($telefone_passado, $progresso_participante_passado){
        $this->banco_de_dados = new BancoDeDados();
        $this->telefone = $telefone_passado;
        $this->progresso_participante = $progresso_participante_passado;
    }

    public function setIdParticipante($id) {
        $this->id_participante = $id;
    }

    public function getIdParticipante() {
        return $this->id_participante;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setProgressoParticipante($progresso) {
        $this->progresso_participante = $progresso;
    }

    public function getProgressoParticipante() {
        return $this->progresso_participante;
    }

    // Métodos de interação com o banco:
    public function cadastrarUserParticipanteBanco() : bool{
        $sql = "INSERT INTO UserParticipante(telefone, progresso_participante) VALUES(:telefone, :progresso_participante)";
        $parametros_insercao = [
            ':telefone' => $this->telefone,
            ':progresso_participante' => $this->progresso_participante,
        ];
        return $this->banco_de_dados->executar($sql, $parametros_insercao);
    }

    public function atualizarProgressoParticipanteBanco($id_usuario_participante, $novo_progresso): bool{
        $sql = "UPDATE UserParticipante
            SET progresso_participante = :novo_progresso
            WHERE id_participante = :id_usuario_participante
        ";

        $parametros_atualizacao = [
            ':novo_progresso' => $novo_progresso,
            ':id_usuario_participante' => $id_usuario_participante
        ];

        return $this->banco_de_dados->executar($sql, $parametros_atualizacao);
    }


}

?>