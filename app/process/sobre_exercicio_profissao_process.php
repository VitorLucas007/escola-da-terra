<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// $_SESSION['id_participante'] = 1;

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/sobre_exercicio_profissao/SobreExercicioProfissaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/sobre_exercicio_profissao/FonteStressController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/sobre_exercicio_profissao/BeneficioRecebidoSalarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/sobre_exercicio_profissao/BeneficioOriundoAtividadeDocenciaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controler/UserParticipanteControler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        # Dados da tabela 'SobreExercicioProfissao'
        $valores_sobre_exercicio_profissao = [
            'participante_id' => $_SESSION['id_participante'],
            'docencia_como_projeto_vida' => $_POST['docencia_como_projeto_vida'] ?? null,
            'justificativa_escolha_docencia' => $_POST['justificativa_escolha_docencia'] ?? null,
            'identificacao_docencia' => $_POST['identificacao_docencia'] ?? null,
            'horas_planejamento_semana' => $_POST['horas_planejamento_semana'] ?? null,
            'trabalha_final_semana' => $_POST['trabalha_final_semana'] ?? null,
            'gosta_do_trabalho' => $_POST['gosta_do_trabalho'] ?? null,
            'indicaria_docencia' => $_POST['indicaria_docencia'] ?? null,
            'informa_profissao' => $_POST['informa_profissao'] ?? null,
            'periodo_trabalhoso_ano' => $_POST['periodo_trabalhoso_ano'] ?? null,
            'doenca_oriunda_docencia' => $_POST['doenca_oriunda_docencia'] ?? null,
            'descricao_doenca' => $_POST['descricao_doenca'] ?? null,
            'comentarios_injustos_noticiarios' => $_POST['comentarios_injustos_noticiarios'] ?? null,
            'reacao_problema_profissional' => $_POST['reacao_problema_profissional'] ?? null,
            'acolhido_em_ambiente_escolar' => $_POST['acolhido_em_ambiente_escolar'] ?? null,
            'causa_prazer_docencia' => $_POST['causa_prazer_docencia'] ?? null,
            'causa_desgosto_docencia' => $_POST['causa_desgosto_docencia'] ?? null,
            'grau_dedicacao_trabalho' => $_POST['grau_dedicacao_trabalho'] ?? null,
            'relacao_com_diretoria_escolar' => $_POST['relacao_com_diretoria_escolar'] ?? null,
            'acha_remuneracao_justa' => $_POST['acha_remuneracao_justa'] ?? null,
            'justificativa_satisfacao_remuneracao' => $_POST['justificativa_satisfacao_remuneracao'] ?? null,
            'salario_recebido' => $_POST['salario_recebido'] ?? null,
            'mudaria_de_profissao' => $_POST['mudaria_de_profissao'] ?? null,
            'profissao_mudanca' => $_POST['profissao_mudanca'] ?? null,
            'existe_programa_paz_diversidade' => $_POST['existe_programa_paz_diversidade'] ?? null,
            'sofreu_agressao_na_escola' => $_POST['sofreu_agressao_na_escola'] ?? null,
            'providencia_tomada_agressao' => $_POST['providencia_tomada_agressao'] ?? null,
            'houve_caso_bullying' => $_POST['houve_caso_bullying'] ?? null,
            'providencia_tomada_bullying' => $_POST['providencia_tomada_bullying'] ?? null,
        ];

        # Persistindo Tabela 'SobreExercicioProfissao'
        $sobre_exercicio_profissao_controller = new SobreExercicioProfissaoController($_SESSION['id_participante']);
        $id_insercao_sobre_exercicio_profissao = $sobre_exercicio_profissao_controller->cadastrarDadosSobreExercicioProfissao($valores_sobre_exercicio_profissao);

        if (!$id_insercao_sobre_exercicio_profissao) {
            throw new Exception("Erro ao cadastrar dados sobre exercício da profissão");
        }

        $registros_secundarios_cadastrados = 0;

        # Persistindo Tabela 'FonteStress' - CORRIGIDO
        if (isset($_POST['descricao_fonte']) && is_array($_POST['descricao_fonte']) && !empty($_POST['descricao_fonte'])) {
            $fonte_stress_controller = new FonteStressController($id_insercao_sobre_exercicio_profissao);

            foreach ($_POST['descricao_fonte'] as $fonte) {
                if (!empty(trim($fonte))) {
                    $valores_fonte_stress = [
                        'sobre_exercicio_profissao_id' => $id_insercao_sobre_exercicio_profissao,
                        'descricao_fonte' => trim($fonte),
                    ];

                    $resultado_fonte_stress = $fonte_stress_controller->cadastrarDadosFonteStress($valores_fonte_stress);

                    if (!$resultado_fonte_stress) {
                        throw new Exception("Erro ao cadastrar fonte de stress");
                    }
                }
            }
            $registros_secundarios_cadastrados++;
        }

        # Persistindo Tabela 'BeneficioRecebidoSalario' - CORRIGIDO
        if (isset($_POST['descricao_beneficio']) && is_array($_POST['descricao_beneficio']) && !empty($_POST['descricao_beneficio'])) {
            $beneficio_recebido_salario_controller = new BeneficioRecebidoSalarioController($id_insercao_sobre_exercicio_profissao);

            foreach ($_POST['descricao_beneficio'] as $beneficio) {
                if (!empty(trim($beneficio))) {
                    $valores_beneficio_recebido_salario = [
                        'sobre_exercicio_profissao_id' => $id_insercao_sobre_exercicio_profissao,
                        'descricao_beneficio' => trim($beneficio),
                    ];

                    $resultado_beneficio_salario = $beneficio_recebido_salario_controller->cadastrarBeneficioRecebidoSalario($valores_beneficio_recebido_salario);

                    if (!$resultado_beneficio_salario) {
                        throw new Exception("Erro ao cadastrar benefício recebido além do salário");
                    }
                }
            }
            $registros_secundarios_cadastrados++;
            echo " [BeneficioRecebidoSalario cadastrado]"; // Debug
        } else {
            echo " [BeneficioRecebidoSalario não selecionado ou array vazio]"; // Debug
        }

        # Persistindo Tabela 'BeneficioOriundoAtividadeDocencia' - CORRIGIDO
        if (isset($_POST['identificacao_beneficio']) && is_array($_POST['identificacao_beneficio']) && !empty($_POST['identificacao_beneficio'])) {
            $beneficio_oriundo_atividade_docencia_controller = new BeneficioOriundoAtividadeDocenciaController($id_insercao_sobre_exercicio_profissao);

            foreach ($_POST['identificacao_beneficio'] as $beneficio) {
                if (!empty(trim($beneficio))) {
                    $valores_beneficio_oriundo_atividade_docencia = [
                        'sobre_exercicio_profissao_id' => $id_insercao_sobre_exercicio_profissao,
                        'identificacao_beneficio' => trim($beneficio),
                    ];

                    $resultado_beneficio_docencia = $beneficio_oriundo_atividade_docencia_controller->cadastrarBeneficioOriundoAtividadeDocencia($valores_beneficio_oriundo_atividade_docencia);

                    if (!$resultado_beneficio_docencia) {
                        throw new Exception("Erro ao cadastrar benefício oriundo da atividade de docência");
                    }
                }
            }
            $registros_secundarios_cadastrados++;
        }

        # Progresso 5 = 5 formulários concluídos; próximo é condição de estudo
        $user_participante_controler = new UserParticipanteControler();
        $atualizacao_progresso = $user_participante_controler->atualizarProgressoParticipante($_SESSION['id_participante'], 5);
        if (!$atualizacao_progresso) {
            echo "erro ao atualizar o progresso do participante";
            exit;
        }

        # Redirecionamento automático para próximo formulário
        header("Location: /views/formularios/formulario_sobre_condicao_estudo.php");
        exit;


    } catch (Exception $e) {
        error_log("Erro no cadastro de exercício da profissão: " . $e->getMessage());
        echo "Erro ao processar dados: " . $e->getMessage();
        header("Location: /views/erro.php");
        exit;
    }
} else {
    http_response_code(405);
    echo "Método não permitido";
}
