<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// $_SESSION['id_participante'] = 1;

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/SobreVidaGeralController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/FrequenciaBebidaAlcoolicaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/RazaoAlimentacaoDesequilibradaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/ProblemaUltimasSemanasController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/AtividadeForaTrabalhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        # Dados da tabela 'SobreVidaGeral'
        $valores_sobre_vida_geral = [
            'participante_id' => $_SESSION['id_participante'],
            'situacao_saude' => $_POST['situacao_saude'] ?? null,
            'tem_doenca_cronica' => $_POST['tem_doenca_cronica'] ?? null,
            'tem_plano_saude' => $_POST['tem_plano_saude'] ?? null,
            'plano_saude' => $_POST['plano_saude'] ?? null,
            'altura' => $_POST['altura'] ?? null,
            'peso' => $_POST['peso'] ?? null,
            'foi_internado_hospital' => $_POST['foi_internado_hospital'] ?? null,
            'bebe_alcool' => $_POST['bebe_alcool'] ?? null,
            'tem_alimentacao_equilibrada' => $_POST['tem_alimentacao_equilibrada'] ?? null,
            'razao_ausencia_tratamento' => $_POST['razao_ausencia_tratamento'] ?? null,
            'usa_cigarro' => $_POST['usa_cigarro'] ?? null,
            'quantidade_cigarros_dia' => $_POST['quantidade_cigarros_dia'] ?? null,
            'gosta_fazer' => $_POST['gosta_fazer'] ?? null,
            'comentario_pesquisa' => $_POST['comentario_pesquisa'] ?? null,
        ];

        # Persistindo Tabela 'SobreVidaGeral'
        $sobre_vida_geral_controller = new SobreVidaGeralController($_SESSION['id_participante']);
        $id_insercao_sobre_vida_geral = $sobre_vida_geral_controller->cadastrarDadosSobreVidaGeral($valores_sobre_vida_geral);

        if (!$id_insercao_sobre_vida_geral) {
            throw new Exception("Erro ao cadastrar informações sobre vida geral");
        }


        # BLOCO COMENTADO - Processamento de Múltiplas Bebidas Alcóolicas
        $bebidas = $_POST['bebida'] ?? [];
        $bebidas_cadastradas = 0;

        if (is_array($bebidas) && !empty($bebidas)) {

            $frequencia_bebida_controller = new FrequenciaBebidaAlcoolicaController($id_insercao_sobre_vida_geral);

            foreach ($bebidas as $index => $bebida) {
                if (!empty($bebida)) {

                    # Dados da bebida atual
                    $valores_frequencia_bebida = [
                        'sobre_vida_geral_id' => $id_insercao_sobre_vida_geral,
                        'bebida' => $bebida,
                        'nivel_frequencia' => $_POST['nivel_frequencia'][$index] ?? null,
                    ];

                    # Inserir frequência de bebida alcóolica
                    $id_insercao_frequencia_bebida = $frequencia_bebida_controller->cadastrarDadosFrequenciaBebidaAlcoolica($valores_frequencia_bebida);

                    if (!$id_insercao_frequencia_bebida) {
                        throw new Exception("Erro ao cadastrar frequência de bebida: $bebida");
                    }

                    $bebidas_cadastradas++;
                }
            }
        }



        # BLOCO COMENTADO - Processamento de Múltiplas Razões de Alimentação Desequilibrada
        $razoes_alimentacao = $_POST['descricao_razao'] ?? [];
        $razoes_cadastradas = 0;

        if (is_array($razoes_alimentacao) && !empty($razoes_alimentacao)) {

            $razao_alimentacao_controller = new RazaoAlimentacaoDesequilibradaController($id_insercao_sobre_vida_geral);

            foreach ($razoes_alimentacao as $descricao_razao) {
                if (!empty($descricao_razao)) {

                    # Dados da razão atual
                    $valores_razao_alimentacao = [
                        'sobre_vida_geral_id' => $id_insercao_sobre_vida_geral,
                        'descricao_razao' => $descricao_razao,
                    ];

                    # Inserir razão de alimentação desequilibrada
                    $id_insercao_razao_alimentacao = $razao_alimentacao_controller->cadastrarDadosRazaoAlimentacaoDesequilibrada($valores_razao_alimentacao);

                    if (!$id_insercao_razao_alimentacao) {
                        throw new Exception("Erro ao cadastrar razão de alimentação: $descricao_razao");
                    }

                    $razoes_cadastradas++;
                }
            }
        }


        # BLOCO COMENTADO - Processamento de Múltiplos Problemas das Últimas Semanas
        $problemas_semanas = $_POST['descricao_problema'] ?? [];
        $problemas_cadastrados = 0;

        if (is_array($problemas_semanas) && !empty($problemas_semanas)) {

            $problema_semanas_controller = new ProblemaUltimasSemanasController($id_insercao_sobre_vida_geral);

            foreach ($problemas_semanas as $descricao_problema) {
                if (!empty($descricao_problema)) {

                    # Dados do problema atual
                    $valores_problema_semanas = [
                        'sobre_vida_geral_id' => $id_insercao_sobre_vida_geral,
                        'descricao_problema' => $descricao_problema,
                    ];

                    # Inserir problema das últimas semanas
                    $id_insercao_problema_semanas = $problema_semanas_controller->cadastrarDadosProblemaUltimasSemanas($valores_problema_semanas);

                    if (!$id_insercao_problema_semanas) {
                        throw new Exception("Erro ao cadastrar problema: $descricao_problema");
                    }

                    $problemas_cadastrados++;
                }
            }
        }


        # BLOCO COMENTADO - Processamento de Múltiplas Atividades Fora do Trabalho
        $atividades_fora_trabalho = $_POST['descricao_atividade'] ?? [];
        $atividades_cadastradas = 0;

        if (is_array($atividades_fora_trabalho) && !empty($atividades_fora_trabalho)) {

            $atividade_fora_trabalho_controller = new AtividadeForaTrabalhoController($id_insercao_sobre_vida_geral);

            foreach ($atividades_fora_trabalho as $descricao_atividade) {
                if (!empty($descricao_atividade)) {

                    # Dados da atividade atual
                    $valores_atividade_fora_trabalho = [
                        'sobre_vida_geral_id' => $id_insercao_sobre_vida_geral,
                        'descricao_atividade' => $descricao_atividade,
                    ];

                    # Inserir atividade fora do trabalho
                    $id_insercao_atividade_fora_trabalho = $atividade_fora_trabalho_controller->cadastrarDadosAtividadeForaTrabalho($valores_atividade_fora_trabalho);

                    if (!$id_insercao_atividade_fora_trabalho) {
                        throw new Exception("Erro ao cadastrar atividade: $descricao_atividade");
                    }

                    $atividades_cadastradas++;
                }
            }
        }

        # Mudando o progresso do participante após ter sucesso na inserção de dados:
        $user_participante_controler = new UserParticipanteControler();
        $atualizacao_progresso = $user_participante_controler->atualizarProgressoParticipante($_SESSION['id_participante'], 7);
        if (!$atualizacao_progresso) {
            echo "erro ao atualizar o progresso do participante";
            exit;
        }

        echo "Dados cadastrados com sucesso!";
    } catch (Exception $e) {

        error_log("Erro no cadastro: " . $e->getMessage());
        echo "Erro ao processar dados: " . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo "Método não permitido";
}
