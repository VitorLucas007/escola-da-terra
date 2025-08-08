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
    public function inserirSobreCarreira(array $valores_sobre_carreira): bool
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
            'participante_id' => $valores_sobre_carreira['participante_id'],
            'exercia_trabalho_anteriormente' => $valores_sobre_carreira['exercia_trabalho_anteriormente'],
            'exerce_atividade_paralela' => $valores_sobre_carreira['exerce_atividade_paralela'],
            'atividade_paralela' => $valores_sobre_carreira['atividade_paralela'],
            'mesmo_estabelecimento_desde_inicio' => $valores_sobre_carreira['mesmo_estabelecimento_desde_inicio'],
            'quantidade_estabelecimentos_carreira' => $valores_sobre_carreira['quantidade_estabelecimentos_carreira'],
            'quantidade_estabelecimentos_atuais' => $valores_sobre_carreira['quantidade_estabelecimentos_atuais'],
            'tempo_como_professor' => $valores_sobre_carreira['tempo_como_professor'],
            'numero_alunos_maior_turma' => $valores_sobre_carreira['numero_alunos_maior_turma'],
            'numero_alunos_menor_turma' => $valores_sobre_carreira['numero_alunos_menor_turma'],
            'possui_equipamentos_necessarios' => $valores_sobre_carreira['possui_equipamentos_necessarios'],
            'equipamentos_desejados' => $valores_sobre_carreira['equipamentos_desejados'],
        ];
        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoSobreCarreira(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}
