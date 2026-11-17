<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';

class SobreVidaGeralModel {
    private $banco_de_dados;
    private $id_sobre_vida_geral;

    public function __construct($id_sobre_vida_geral)
    {
        $this->id_sobre_vida_geral = $id_sobre_vida_geral;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function inserirSobreVidaGeral(array $valores_sobre_vida_geral): bool
    {
        $sql = "INSERT INTO SobreVidaGeral (
            participante_id,
            situacao_saude,
            tem_doenca_cronica,
            tem_plano_saude,
            plano_saude,
            altura,
            peso,
            foi_internado_hospital,
            bebe_alcool,
            tem_alimentacao_equilibrada,
            razao_ausencia_tratamento,
            usa_cigarro,
            quantidade_cigarros_dia,
            gosta_fazer,
            comentario_pesquisa
        ) VALUES (
            :participante_id,
            :situacao_saude,
            :tem_doenca_cronica,
            :tem_plano_saude,
            :plano_saude,
            :altura,
            :peso,
            :foi_internado_hospital,
            :bebe_alcool,
            :tem_alimentacao_equilibrada,
            :razao_ausencia_tratamento,
            :usa_cigarro,
            :quantidade_cigarros_dia,
            :gosta_fazer,
            :comentario_pesquisa
        )";

        $params = [
            'participante_id' => $valores_sobre_vida_geral['participante_id'],
            'situacao_saude' => $valores_sobre_vida_geral['situacao_saude'],
            'tem_doenca_cronica' => $valores_sobre_vida_geral['tem_doenca_cronica'],
            'tem_plano_saude' => $valores_sobre_vida_geral['tem_plano_saude'],
            'plano_saude' => $valores_sobre_vida_geral['plano_saude'],
            'altura' => $valores_sobre_vida_geral['altura'],
            'peso' => $valores_sobre_vida_geral['peso'],
            'foi_internado_hospital' => $valores_sobre_vida_geral['foi_internado_hospital'],
            'bebe_alcool' => $valores_sobre_vida_geral['bebe_alcool'],
            'tem_alimentacao_equilibrada' => $valores_sobre_vida_geral['tem_alimentacao_equilibrada'],
            'razao_ausencia_tratamento' => $valores_sobre_vida_geral['razao_ausencia_tratamento'],
            'usa_cigarro' => $valores_sobre_vida_geral['usa_cigarro'],
            'quantidade_cigarros_dia' => $valores_sobre_vida_geral['quantidade_cigarros_dia'],
            'gosta_fazer' => $valores_sobre_vida_geral['gosta_fazer'],
            'comentario_pesquisa' => $valores_sobre_vida_geral['comentario_pesquisa'],
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoSobreVidaGeral(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorParticipanteIdBanco($id_participante) {
    $sql = "SELECT * FROM SobreVidaGeral WHERE participante_id = :id_participante LIMIT 1";
    $parametros = [':id_participante' => $id_participante];
    $resultado = $this->banco_de_dados->consultar($sql, $parametros);
    return $resultado[0] ?? null;
    }
}