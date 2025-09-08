<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

class FormacaoSuperiorModel {
    private $banco_de_dados;
    private $id_informacao_formacao_superior; 

    public function __construct($id_informacao_formacao_superior){
        $this->id_informacao_formacao_superior = $id_informacao_formacao_superior;
        $this->banco_de_dados = new BancoDeDados();
    }

    public function inserirFormacaoSuperior(array $valores_formacao_superior): bool {
        $sql = "INSERT INTO FormacaoSuperior (
            sobre_formacao_escolar_id,
            nivel_formacao,
            nome_instituicao,
            curso,
            modalidade,
            tipo_instituicao,
            foi_bolsista,
            ano_inicio,
            ano_conclusao,
            carga_horaria
        ) VALUES (
            :sobre_formacao_escolar_id,
            :nivel_formacao,
            :nome_instituicao,
            :curso,
            :modalidade,
            :tipo_instituicao,
            :foi_bolsista,
            :ano_inicio,
            :ano_conclusao,
            :carga_horaria
        )";
        
        $params = [
            ':sobre_formacao_escolar_id' => $valores_formacao_superior['sobre_formacao_escolar_id'],
            ':nivel_formacao' => $valores_formacao_superior['nivel_formacao'],
            ':nome_instituicao' => $valores_formacao_superior['nome_instituicao'],
            ':curso' => $valores_formacao_superior['curso'],
            ':modalidade' => $valores_formacao_superior['modalidade'],
            ':tipo_instituicao' => $valores_formacao_superior['tipo_instituicao'],
            ':foi_bolsista' => $valores_formacao_superior['foi_bolsista'],
            ':ano_inicio' => $valores_formacao_superior['ano_inicio'],
            ':ano_conclusao' => $valores_formacao_superior['ano_conclusao'],
            'carga_horaria' => $valores_formacao_superior['carga_horaria'],
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoFormacaoSuperior(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}

?>