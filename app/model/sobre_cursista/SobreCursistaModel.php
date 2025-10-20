<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';    


class SobreCursistaModel{
    private $banco_de_dados;
    private $participante_id;

    public function __construct($participante_id = null){
        $this->participante_id = $participante_id;
        $this->banco_de_dados = new BancoDeDados(); 
    }


    public function cadastrarDadosSobreCursistaBanco(array $valores_sobre_cursista): bool{
        $sql = "INSERT INTO SobreCursista (
            participante_id,
            ano_nascimento,
            sexo,
            estado_naturalidade,
            municipio_naturalidade,
            estado_reside_atualmente,
            municipio_reside_atualmente,
            anos_reside_atualmente,
            residencia_propria,
            tem_filhos,
            quantidade_filhos,
            vive_com_filhos,
            filhos_vivem_com,
            estado_civil,
            anos_tempo_casado,
            anos_uniao_estavel,
            data_nascimento_conjuge,
            profissao_conjuge,
            casou_varias_vezes,
            quantidade_casamentos,
            sindicalizado,
            tempo_sindicalizado,
            transporte_frequente,
            tem_religiao,
            religiao_praticada,
            tem_opcao_partidaria,
            opcao_partidaria,
            partidos_votados_ultimas_eleicoes,
            escala_politica_esquerda_direita
        ) VALUES (
            :participante_id,
            :ano_nascimento,
            :sexo,
            :estado_naturalidade,
            :municipio_naturalidade,
            :estado_reside_atualmente,
            :municipio_reside_atualmente,
            :anos_reside_atualmente,
            :residencia_propria,
            :tem_filhos,
            :quantidade_filhos,
            :vive_com_filhos,
            :filhos_vivem_com,
            :estado_civil,
            :anos_tempo_casado,
            :anos_uniao_estavel,
            :data_nascimento_conjuge,
            :profissao_conjuge,
            :casou_varias_vezes,
            :quantidade_casamentos,
            :sindicalizado,
            :tempo_sindicalizado,
            :transporte_frequente,
            :tem_religiao,
            :religiao_praticada,
            :tem_opcao_partidaria,
            :opcao_partidaria,
            :partidos_votados_ultimas_eleicoes,
            :escala_politica_esquerda_direita
        )";    

        $parametros = [
            ':participante_id' => $valores_sobre_cursista['participante_id'],
            ':ano_nascimento' => $valores_sobre_cursista['ano_nascimento'],
            ':sexo' => $valores_sobre_cursista['sexo'],
            ':estado_naturalidade' => $valores_sobre_cursista['estado_naturalidade'],
            ':municipio_naturalidade' => $valores_sobre_cursista['municipio_naturalidade'],
            ':estado_reside_atualmente' => $valores_sobre_cursista['estado_reside_atualmente'],
            ':municipio_reside_atualmente' => $valores_sobre_cursista['municipio_reside_atualmente'],
            ':anos_reside_atualmente' => $valores_sobre_cursista['anos_reside_atualmente'],
            ':residencia_propria' => $valores_sobre_cursista['residencia_propria'],
            ':tem_filhos' => $valores_sobre_cursista['tem_filhos'],
            ':quantidade_filhos' => $valores_sobre_cursista['quantidade_filhos'],
            ':vive_com_filhos' => $valores_sobre_cursista['vive_com_filhos'],
            ':filhos_vivem_com' => $valores_sobre_cursista['filhos_vivem_com'],
            ':estado_civil' => $valores_sobre_cursista['estado_civil'],
            ':anos_tempo_casado' => $valores_sobre_cursista['anos_tempo_casado'],
            ':anos_uniao_estavel' => $valores_sobre_cursista['anos_uniao_estavel'],
            ':data_nascimento_conjuge' => $valores_sobre_cursista['data_nascimento_conjuge'],
            ':profissao_conjuge' => $valores_sobre_cursista['profissao_conjuge'],
            ':casou_varias_vezes' => $valores_sobre_cursista['casou_varias_vezes'],
            ':quantidade_casamentos' => $valores_sobre_cursista['quantidade_casamentos'],
            ':sindicalizado' => $valores_sobre_cursista['sindicalizado'],
            ':tempo_sindicalizado' => $valores_sobre_cursista['tempo_sindicalizado'],
            ':transporte_frequente' => $valores_sobre_cursista['transporte_frequente'],
            ':tem_religiao' => $valores_sobre_cursista['tem_religiao'],
            ':religiao_praticada' => $valores_sobre_cursista['religiao_praticada'],
            ':tem_opcao_partidaria' => $valores_sobre_cursista['tem_opcao_partidaria'],
            ':opcao_partidaria' => $valores_sobre_cursista['opcao_partidaria'],
            ':partidos_votados_ultimas_eleicoes' => $valores_sobre_cursista['partidos_votados_ultimas_eleicoes'],
            ':escala_politica_esquerda_direita' => $valores_sobre_cursista['escala_politica_esquerda_direita']
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoSobreCursistaBanco() : string{
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function listarTodosOsCursistasDoBanco(): array {
        $sql = "SELECT * FROM SobreCursista";
        return $this->banco_de_dados->consultar($sql);
    }

    public function buscarDadosPorParticipanteIdBanco($id_participante) {
    $sql = "SELECT * FROM SobreCursista WHERE participante_id = :id_participante LIMIT 1";
    $parametros = [':id_participante' => $id_participante];
    $resultado = $this->banco_de_dados->consultar($sql, $parametros);
    return $resultado[0] ?? null;
}

}


?>
