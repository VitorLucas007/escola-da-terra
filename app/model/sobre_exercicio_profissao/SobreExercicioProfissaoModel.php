<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';

class SobreExercicioProfissaoModel {
    
    private $banco_de_dados;
    private $id_informacao_exercicio_profissao;

    public function __construct($id_informacao_exercicio_profissao){
        $this->id_informacao_exercicio_profissao = $id_informacao_exercicio_profissao;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function cadastrarSobreExercicioProfissao(array $valores_sobre_exercicio_profissao): bool {
        $sql = "INSERT INTO SobreExercicioProfissao (
            participante_id,
            docencia_como_projeto_vida,
            justificativa_escolha_docencia,
            identificacao_docencia,
            horas_planejamento_semana,
            trabalha_final_semana,
            gosta_do_trabalho,
            indicaria_docencia,
            informa_profissao,
            periodo_trabalhoso_ano,
            doenca_oriunda_docencia,
            descricao_doenca,
            comentarios_injustos_noticiarios,
            reacao_problema_profissional,
            acolhido_em_problema_escolar,
            causa_prazer_docencia,
            causa_desgosto_docencia,
            grau_dedicacao_trabalho,
            relacao_com_diretoria_escolar,
            acha_remuneracao_justa,
            justificativa_satisfacao_remuneracao,
            salario_recebido,
            mudaria_de_profissao,
            profissao_mudanca,
            existe_programa_paz_diversidade,
            sofreu_agressao_na_escola,
            providencia_tomada_agressao,
            houve_caso_bullying,
            providencia_tomada_bullying
        ) VALUES (
            :participante_id,
            :docencia_como_projeto_vida,
            :justificativa_escolha_docencia,
            :identificacao_docencia,
            :horas_planejamento_semana,
            :trabalha_final_semana,
            :gosta_do_trabalho,
            :indicaria_docencia,
            :informa_profissao,
            :periodo_trabalhoso_ano,
            :doenca_oriunda_docencia,
            :descricao_doenca,
            :comentarios_injustos_noticiarios,
            :reacao_problema_profissional,
            :acolhido_em_problema_escolar,
            :causa_prazer_docencia,
            :causa_desgosto_docencia,
            :grau_dedicacao_trabalho,
            :relacao_com_diretoria_escolar,
            :acha_remuneracao_justa,
            :justificativa_satisfacao_remuneracao,
            :salario_recebido,
            :mudaria_de_profissao,
            :profissao_mudanca,
            :existe_programa_paz_diversidade,
            :sofreu_agressao_na_escola,
            :providencia_tomada_agressao,
            :houve_caso_bullying,
            :providencia_tomada_bullying
        )";

        $params = [
            ':participante_id' => $valores_sobre_exercicio_profissao['participante_id'],
            ':docencia_como_projeto_vida' => $valores_sobre_exercicio_profissao['docencia_como_projeto_vida'] ? $valores_sobre_exercicio_profissao['docencia_como_projeto_vida'] : 0,
            ':justificativa_escolha_docencia' => $valores_sobre_exercicio_profissao['justificativa_escolha_docencia'] ? $valores_sobre_exercicio_profissao['justificativa_escolha_docencia'] : '',
            ':identificacao_docencia' => $valores_sobre_exercicio_profissao['identificacao_docencia'] ? $valores_sobre_exercicio_profissao['identificacao_docencia'] : '',
            ':horas_planejamento_semana' => $valores_sobre_exercicio_profissao['horas_planejamento_semana'] ? $valores_sobre_exercicio_profissao['horas_planejamento_semana'] : 0,
            ':trabalha_final_semana' => $valores_sobre_exercicio_profissao['trabalha_final_semana'] ? $valores_sobre_exercicio_profissao['trabalha_final_semana'] : '',
            ':gosta_do_trabalho' => $valores_sobre_exercicio_profissao['gosta_do_trabalho'] ? $valores_sobre_exercicio_profissao['gosta_do_trabalho'] : '',
            ':indicaria_docencia' => $valores_sobre_exercicio_profissao['indicaria_docencia'] ? $valores_sobre_exercicio_profissao['indicaria_docencia'] : '',
            ':informa_profissao' => $valores_sobre_exercicio_profissao['informa_profissao'] ? $valores_sobre_exercicio_profissao['informa_profissao'] : '',
            ':periodo_trabalhoso_ano' => $valores_sobre_exercicio_profissao['periodo_trabalhoso_ano'] ? $valores_sobre_exercicio_profissao['periodo_trabalhoso_ano'] : '',
            ':doenca_oriunda_docencia' => $valores_sobre_exercicio_profissao['doenca_oriunda_docencia'] ? $valores_sobre_exercicio_profissao['doenca_oriunda_docencia'] : 0,
            ':descricao_doenca' => $valores_sobre_exercicio_profissao['descricao_doenca'], // pode ser null
            ':comentarios_injustos_noticiarios' => $valores_sobre_exercicio_profissao['comentarios_injustos_noticiarios'] ? $valores_sobre_exercicio_profissao['comentarios_injustos_noticiarios'] : '',
            ':reacao_problema_profissional' => $valores_sobre_exercicio_profissao['reacao_problema_profissional'] ? $valores_sobre_exercicio_profissao['reacao_problema_profissional'] : '',
            ':acolhido_em_problema_escolar' => $valores_sobre_exercicio_profissao['acolhido_em_problema_escolar'] ? $valores_sobre_exercicio_profissao['acolhido_em_problema_escolar'] : 0,
            ':causa_prazer_docencia' => $valores_sobre_exercicio_profissao['causa_prazer_docencia'] ? $valores_sobre_exercicio_profissao['causa_prazer_docencia'] : '',
            ':causa_desgosto_docencia' => $valores_sobre_exercicio_profissao['causa_desgosto_docencia'] ? $valores_sobre_exercicio_profissao['causa_desgosto_docencia'] : '',
            ':grau_dedicacao_trabalho' => $valores_sobre_exercicio_profissao['grau_dedicacao_trabalho'] ? $valores_sobre_exercicio_profissao['grau_dedicacao_trabalho'] : '',
            ':relacao_com_diretoria_escolar' => $valores_sobre_exercicio_profissao['relacao_com_diretoria_escolar'] ? $valores_sobre_exercicio_profissao['relacao_com_diretoria_escolar'] : '',
            ':acha_remuneracao_justa' => $valores_sobre_exercicio_profissao['acha_remuneracao_justa'] ? $valores_sobre_exercicio_profissao['acha_remuneracao_justa'] : 0,
            ':justificativa_satisfacao_remuneracao' => $valores_sobre_exercicio_profissao['justificativa_satisfacao_remuneracao'] ? $valores_sobre_exercicio_profissao['justificativa_satisfacao_remuneracao'] : '',
            ':salario_recebido' => $valores_sobre_exercicio_profissao['salario_recebido'] ? $valores_sobre_exercicio_profissao['salario_recebido'] : '',
            ':mudaria_de_profissao' => $valores_sobre_exercicio_profissao['mudaria_de_profissao'] ? $valores_sobre_exercicio_profissao['mudaria_de_profissao'] : 0,
            ':profissao_mudanca' => $valores_sobre_exercicio_profissao['profissao_mudanca'], // pode ser null
            ':existe_programa_paz_diversidade' => $valores_sobre_exercicio_profissao['existe_programa_paz_diversidade'] ? $valores_sobre_exercicio_profissao['existe_programa_paz_diversidade'] : 0,
            ':sofreu_agressao_na_escola' => $valores_sobre_exercicio_profissao['sofreu_agressao_na_escola'] ? $valores_sobre_exercicio_profissao['sofreu_agressao_na_escola'] : 0,
            ':providencia_tomada_agressao' => $valores_sobre_exercicio_profissao['providencia_tomada_agressao'], // pode ser null
            ':houve_caso_bullying' => $valores_sobre_exercicio_profissao['houve_caso_bullying'] ? $valores_sobre_exercicio_profissao['houve_caso_bullying'] : 0,
            ':providencia_tomada_bullying' => $valores_sobre_exercicio_profissao['providencia_tomada_bullying'] // pode ser null
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoSobreExercicioProfissao(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function listarTodos(){
        $sql = "SELECT * FROM SobreExercicioProfissao";
        return $this->banco_de_dados->consultar($sql);
    }

    public function buscarPorParticipanteIdBanco($id_participante) {
    $sql = "SELECT * FROM SobreExercicioProfissao WHERE participante_id = :id_participante LIMIT 1";
    $parametros = [':id_participante' => $id_participante];
    $resultado = $this->banco_de_dados->consultar($sql, $parametros);
    return $resultado[0] ?? null;
    }   
}

?>