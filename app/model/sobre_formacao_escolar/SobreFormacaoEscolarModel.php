<?php 

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/app/model/BancoDeDados.php';

class SobreFormacaoEscolarModel {
    private $banco_de_dados;
    private $id_informacao_formacao_escolar;

    public function __construct($id_informacao_formacao_escolar) {
        $this->id_informacao_formacao_escolar = $id_informacao_formacao_escolar;
        $this->banco_de_dados = new BancoDeDados();
    }

    public function inserirSobreFormacaoEscolar(array $valores_sobre_formacao_escolar): bool {
        $sql = "INSERT INTO SobreFormacaoEscolar (
        participante_id, 
        quantidade_cursos_graduacao,
        quantidade_especializacoes, 
        fez_curso_aperfeicoamento, 
        quantidade_cursos_aperfeicoamento, 
        fez_mestrado, 
        fez_especializacao
        ) VALUES (
        :participante_id, 
        :quantidade_cursos_graduacao, 
        :quantidade_especializacoes, 
        :fez_curso_aperfeicoamento, 
        :quantidade_cursos_aperfeicoamento, 
        :fez_mestrado, :fez_especializacao
        )";
        
        $params = [
            ':participante_id' => $valores_sobre_formacao_escolar['participante_id'],
            ':quantidade_cursos_graduacao' => $valores_sobre_formacao_escolar['quantidade_cursos_graduacao'],
            ':quantidade_especializacoes' => $valores_sobre_formacao_escolar['quantidade_especializacoes'],
            ':fez_curso_aperfeicoamento' => $valores_sobre_formacao_escolar['fez_curso_aperfeicoamento'],
            ':quantidade_cursos_aperfeicoamento' => $valores_sobre_formacao_escolar['quantidade_cursos_aperfeicoamento'],
            ':fez_mestrado' => $valores_sobre_formacao_escolar['fez_mestrado'],
            ':fez_especializacao' => $valores_sobre_formacao_escolar['fez_especializacao'],
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }


    public function getUltimoIdInsercaoSobreFormacaoEscolar(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorParticipanteIdBanco($id_participante) {
    $sql = "SELECT * FROM SobreFormacaoEscolar WHERE participante_id = :id_participante LIMIT 1";
    $parametros = [':id_participante' => $id_participante];
    $resultado = $this->banco_de_dados->consultar($sql, $parametros);
    return $resultado[0] ?? null;
    }   
}

?>