<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';


class SobreCarreiraModel
{
    private $banco_de_dados;
    private $id_informacao_carreira;

    public function __construct($id_informacao_carreira)
    {
        $this->id_informacao_carreira = $id_informacao_carreira;
        $this->banco_de_dados = new BancoDeDados();
    }


    // CRUD
    public function cadastrarSobreCarreira(array $valores_sobre_carreira): bool
    {
        $sql = "INSERT INTO SobreCarreira (
            participante_id,
            exercia_trabalho_anteriormente,
            exerce_atividade_paralela,
            atividade_paralela,
            mesmo_estabelecimento_desde_inicio,
            quantidade_estabelecimentos_carreira,
            quantidade_estabelecimentos_atuais,
            tempo_como_professor,
            numero_alunos_maior_turma,
            numero_alunos_menor_turma,
            possui_equipamentos_necessarios,
            equipamentos_desejados 
        ) VALUES (
            :participante_id,
            :exercia_trabalho_anteriormente,
            :exerce_atividade_paralela,
            :atividade_paralela,
            :mesmo_estabelecimento_desde_inicio,
            :quantidade_estabelecimentos_carreira,
            :quantidade_estabelecimentos_atuais,
            :tempo_como_professor,
            :numero_alunos_maior_turma,
            :numero_alunos_menor_turma,
            :possui_equipamentos_necessarios,
            :equipamentos_desejados 
        )";

        $params = [
            ':participante_id' => isset($valores_sobre_carreira['participante_id']) ?
                $valores_sobre_carreira['participante_id'] : null,
            ':exercia_trabalho_anteriormente' => isset($valores_sobre_carreira['exerciaTrabalhoAnteriormente']) ?
                $valores_sobre_carreira['exerciaTrabalhoAnteriormente'] : null,
            ':exerce_atividade_paralela' => isset($valores_sobre_carreira['exerceAtividadeParalela']) ?
                $valores_sobre_carreira['exerceAtividadeParalela'] : null,
            ':atividade_paralela' => isset($valores_sobre_carreira['atividadeParalela']) ?
                $valores_sobre_carreira['atividadeParalela'] : null,
            ':mesmo_estabelecimento_desde_inicio' => isset($valores_sobre_carreira['mesmoEstabelecimentoDesdeInicio']) ?
                $valores_sobre_carreira['mesmoEstabelecimentoDesdeInicio'] : null,
            ':quantidade_estabelecimentos_carreira' => isset($valores_sobre_carreira['quantidadeEstabelecimentosCarreira']) ?
                $valores_sobre_carreira['quantidadeEstabelecimentosCarreira'] : null,
            ':quantidade_estabelecimentos_atuais' =>  isset($valores_sobre_carreira['quantidadeEstabelecimentosAtuais']) ?
                $valores_sobre_carreira['quantidadeEstabelecimentosAtuais'] : null,
            ':tempo_como_professor' => isset($valores_sobre_carreira['tempoComoProfessor']) ?
                $valores_sobre_carreira['tempoComoProfessor'] : null,
            ':numero_alunos_maior_turma' => isset($valores_sobre_carreira['numeroAlunosMaiorTurma']) ?
                $valores_sobre_carreira['numeroAlunosMaiorTurma'] : null,
            ':numero_alunos_menor_turma' => isset($valores_sobre_carreira['numeroAlunosMenorTurma']) ?
                $valores_sobre_carreira['numeroAlunosMenorTurma'] : null,
            ':possui_equipamentos_necessarios' => isset($valores_sobre_carreira['possuiEquipamentosNecessarios']) ?
                $valores_sobre_carreira['possuiEquipamentosNecessarios'] : null,
            ':equipamentos_desejados' => isset($valores_sobre_carreira['equipamentosDesejados']) ?
                $valores_sobre_carreira['equipamentosDesejados'] : null
        ];
        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoSobreCarreira(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}
