<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// $_SESSION['id_participante'] = 1; # Valor para testes.
// Verificar se existe sessão de participante
// if (!isset($_SESSION['id_participante'])) {
//     header("Location: /pesquisa_educacional/views/erro.php");
//     exit;
// }

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_formacao_escolar/SobreFormacaoEscolarController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_formacao_escolar/FormacaoBasicaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_formacao_escolar/FormacaoSuperiorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    try {
        # Dados da tabela 'SobreFormacaoEscolar'
        $valores_sobre_formacao = [
            'participante_id' => $_SESSION['id_participante'],
            'quantidade_cursos_graduacao' => isset($_POST['quantidade_cursos_graduacao']) ? (int)$_POST['quantidade_cursos_graduacao'] : 0,
            'quantidade_especializacoes' => isset($_POST['quantidade_especializacoes']) ? (int)$_POST['quantidade_especializacoes'] : 0,
            'fez_curso_aperfeicoamento' => isset($_POST['fez_curso_aperfeicoamento']) ? (int)$_POST['fez_curso_aperfeicoamento'] : 0,
            'quantidade_cursos_aperfeicoamento' => isset($_POST['quantidade_cursos_aperfeicoamento']) ? (int)$_POST['quantidade_cursos_aperfeicoamento'] : 0,
            'fez_mestrado' => isset($_POST['fez_mestrado']) ? (int)$_POST['fez_mestrado'] : 0,
            'fez_especializacao' => isset($_POST['fez_especializacao']) ? (int)$_POST['fez_especializacao'] : 0,
        ];

        # Persistindo Tabela 'SobreFormacaoEscolar'
        $sobre_formacao_controller = new SobreFormacaoEscolarController($_SESSION['id_participante']);
        $id_insercao_sobre_formacao = $sobre_formacao_controller->cadastrarDadosSobreFormacaoEscolar($valores_sobre_formacao);

        if (!$id_insercao_sobre_formacao) {
            throw new Exception("Erro ao cadastrar informações sobre formação escolar");
        }

        # Processamento de Formação Básica
        $formacao_basica_controller = new FormacaoBasicaController($id_insercao_sobre_formacao);

        # Processar Ensino Fundamental Menor
        if (!empty($_POST['tipo_escola_fundamental_menor'])) {
            $valores_fundamental_menor = [
                'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                'nivel_formacao' => 'Fundamental_Menor',
                'tipo_escola' => $_POST['tipo_escola_fundamental_menor'],
                'municipio_formacao' => $_POST['municipio_fundamental_menor'] ?? 'Não informado',
                'ano_conclusao' => !empty($_POST['ano_conclusao_fundamental_menor']) ? (int)$_POST['ano_conclusao_fundamental_menor'] : null,
            ];
            
            $id_insercao_fundamental_menor = $formacao_basica_controller->cadastrarDadosFormacaoBasica($valores_fundamental_menor);

            if (!$id_insercao_fundamental_menor) {
                throw new Exception("Erro ao cadastrar informações do ensino fundamental menor");
            }
        }

        # Processar Ensino Fundamental Maior
        if (!empty($_POST['tipo_escola_fundamental_maior'])) {
            $valores_fundamental_maior = [
                'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                'nivel_formacao' => 'Fundamental_Maior',
                'tipo_escola' => $_POST['tipo_escola_fundamental_maior'],
                'municipio_formacao' => $_POST['municipio_fundamental_maior'] ?? 'Não informado',
                'ano_conclusao' => !empty($_POST['ano_conclusao_fundamental_maior']) ? (int)$_POST['ano_conclusao_fundamental_maior'] : null,
            ];
            
            $id_insercao_fundamental_maior = $formacao_basica_controller->cadastrarDadosFormacaoBasica($valores_fundamental_maior);

            if (!$id_insercao_fundamental_maior) {
                throw new Exception("Erro ao cadastrar informações do ensino fundamental maior");
            }
        }

        # Processar Ensino Médio
        if (!empty($_POST['tipo_escola_ensino_medio'])) {
            $valores_ensino_medio = [
                'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                'nivel_formacao' => 'Ensino_Medio',
                'tipo_escola' => $_POST['tipo_escola_ensino_medio'],
                'municipio_formacao' => $_POST['municipio_ensino_medio'] ?? 'Não informado',
                'ano_conclusao' => !empty($_POST['ano_conclusao_ensino_medio']) ? (int)$_POST['ano_conclusao_ensino_medio'] : null,
            ];
            
            $id_insercao_ensino_medio = $formacao_basica_controller->cadastrarDadosFormacaoBasica($valores_ensino_medio);

            if (!$id_insercao_ensino_medio) {
                throw new Exception("Erro ao cadastrar informações do ensino médio");
            }
        }

        # Processamento de Graduações
        $nomesInstituicoesGraduacao = $_POST['nome_instituicao_graduacao'] ?? [];
        $cursosGraduacao = $_POST['curso_graduacao'] ?? [];
        $modalidadesGraduacao = $_POST['modalidade_graduacao'] ?? [];
        $tiposInstituicoesGraduacao = $_POST['tipo_instituicao_graduacao'] ?? [];
        $foiBolsistasGraduacao = $_POST['foi_bolsista_graduacao'] ?? [];
        $anosConclusaoGraduacao = $_POST['ano_conclusao_graduacao'] ?? [];

        if (!empty($nomesInstituicoesGraduacao)) {
            $formacao_superior_controller = new FormacaoSuperiorController($id_insercao_sobre_formacao);

            foreach ($nomesInstituicoesGraduacao as $index => $nomeInstituicao) {
                if (!empty($nomeInstituicao) && !empty($cursosGraduacao[$index])) {
                    $valores_graduacao = [
                        'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                        'nivel_formacao' => 'Graduacao',
                        'nome_instituicao' => $nomeInstituicao,
                        'curso' => $cursosGraduacao[$index],
                        'modalidade' => $modalidadesGraduacao[$index] ?? null,
                        'tipo_instituicao' => $tiposInstituicoesGraduacao[$index] ?? null,
                        'foi_bolsista' => isset($foiBolsistasGraduacao[$index]) ? (int)$foiBolsistasGraduacao[$index] : 0,
                        'ano_inicio' => null,
                        'ano_conclusao' => !empty($anosConclusaoGraduacao[$index]) ? (int)$anosConclusaoGraduacao[$index] : null,
                        'carga_horaria' => null,
                    ];
                    
                    $id_insercao_graduacao = $formacao_superior_controller->cadastrarDadosFormacaoSuperior($valores_graduacao);

                    if (!$id_insercao_graduacao) {
                        throw new Exception("Erro ao cadastrar graduação: " . $cursosGraduacao[$index]);
                    }
                }
            }
        }

        # Processamento de Especializações (se houver)
        if (isset($_POST['fez_especializacao']) && $_POST['fez_especializacao'] == 1) {
            $nomesInstituicoesEspecializacao = $_POST['nome_instituicao_especializacao'] ?? [];
            $cursosEspecializacao = $_POST['curso_especializacao'] ?? [];
            $modalidadesEspecializacao = $_POST['modalidade_especializacao'] ?? [];
            $tiposInstituicoesEspecializacao = $_POST['tipo_instituicao_especializacao'] ?? [];
            $foiBolsistasEspecializacao = $_POST['foi_bolsista_especializacao'] ?? [];
            $anosIngressoEspecializacao = $_POST['ano_ingresso_especializacao'] ?? [];
            $anosConclusaoEspecializacao = $_POST['ano_conclusao_especializacao'] ?? [];

            if (!empty($nomesInstituicoesEspecializacao)) {
                $formacao_superior_controller = new FormacaoSuperiorController($id_insercao_sobre_formacao);

                foreach ($nomesInstituicoesEspecializacao as $index => $nomeInstituicao) {
                    if (!empty($nomeInstituicao) && !empty($cursosEspecializacao[$index])) {
                        $valores_especializacao = [
                            'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                            'nivel_formacao' => 'Especializacao',
                            'nome_instituicao' => $nomeInstituicao,
                            'curso' => $cursosEspecializacao[$index],
                            'modalidade' => $modalidadesEspecializacao[$index] ?? null,
                            'tipo_instituicao' => $tiposInstituicoesEspecializacao[$index] ?? null,
                            'foi_bolsista' => isset($foiBolsistasEspecializacao[$index]) ? (int)$foiBolsistasEspecializacao[$index] : 0,
                            'ano_inicio' => !empty($anosIngressoEspecializacao[$index]) ? (int)$anosIngressoEspecializacao[$index] : null,
                            'ano_conclusao' => !empty($anosConclusaoEspecializacao[$index]) ? (int)$anosConclusaoEspecializacao[$index] : null,
                            'carga_horaria' => null,
                        ];
                        
                        $id_insercao_especializacao = $formacao_superior_controller->cadastrarDadosFormacaoSuperior($valores_especializacao);

                        if (!$id_insercao_especializacao) {
                            throw new Exception("Erro ao cadastrar especialização: " . $cursosEspecializacao[$index]);
                        }
                    }
                }
            }
        }

        # Processamento de Cursos de Aperfeiçoamento (se houver)
        if (isset($_POST['fez_curso_aperfeicoamento']) && $_POST['fez_curso_aperfeicoamento'] == 1) {
            $nomesInstituicoesAperfeicoamento = $_POST['nome_instituicao_aperfeicoamento'] ?? [];
            $cursosAperfeicoamento = $_POST['curso_aperfeicoamento'] ?? [];
            $modalidadesAperfeicoamento = $_POST['modalidade_aperfeicoamento'] ?? [];
            $tiposInstituicoesAperfeicoamento = $_POST['tipo_instituicao_aperfeicoamento'] ?? [];
            $foiBolsistasAperfeicoamento = $_POST['foi_bolsista_aperfeicoamento'] ?? [];
            $anosIngressoAperfeicoamento = $_POST['ano_ingresso_aperfeicoamento'] ?? [];
            $anosConclusaoAperfeicoamento = $_POST['ano_conclusao_aperfeicoamento'] ?? [];
            $cargasHorariasAperfeicoamento = $_POST['carga_horaria_aperfeicoamento'] ?? [];

            if (!empty($nomesInstituicoesAperfeicoamento)) {
                $formacao_superior_controller = new FormacaoSuperiorController($id_insercao_sobre_formacao);

                foreach ($nomesInstituicoesAperfeicoamento as $index => $nomeInstituicao) {
                    if (!empty($nomeInstituicao) && !empty($cursosAperfeicoamento[$index])) {
                        $valores_aperfeicoamento = [
                            'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                            'nivel_formacao' => 'Aperfeicoamento',
                            'nome_instituicao' => $nomeInstituicao,
                            'curso' => $cursosAperfeicoamento[$index],
                            'modalidade' => $modalidadesAperfeicoamento[$index] ?? null,
                            'tipo_instituicao' => $tiposInstituicoesAperfeicoamento[$index] ?? null,
                            'foi_bolsista' => isset($foiBolsistasAperfeicoamento[$index]) ? (int)$foiBolsistasAperfeicoamento[$index] : 0,
                            'ano_inicio' => !empty($anosIngressoAperfeicoamento[$index]) ? (int)$anosIngressoAperfeicoamento[$index] : null,
                            'ano_conclusao' => !empty($anosConclusaoAperfeicoamento[$index]) ? (int)$anosConclusaoAperfeicoamento[$index] : null,
                            'carga_horaria' => !empty($cargasHorariasAperfeicoamento[$index]) ? (int)$cargasHorariasAperfeicoamento[$index] : null,
                        ];
                        
                        $id_insercao_aperfeicoamento = $formacao_superior_controller->cadastrarDadosFormacaoSuperior($valores_aperfeicoamento);

                        if (!$id_insercao_aperfeicoamento) {
                            throw new Exception("Erro ao cadastrar curso de aperfeiçoamento: " . $cursosAperfeicoamento[$index]);
                        }
                    }
                }
            }
        }

        # Processamento de Mestrado (se houver)
        if (isset($_POST['fez_mestrado']) && $_POST['fez_mestrado'] == 1) {
            if (!empty($_POST['nome_instituicao_mestrado']) && !empty($_POST['curso_mestrado'])) {
                $formacao_superior_controller = new FormacaoSuperiorController($id_insercao_sobre_formacao);
                
                $valores_mestrado = [
                    'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                    'nivel_formacao' => 'Mestrado',
                    'nome_instituicao' => $_POST['nome_instituicao_mestrado'],
                    'curso' => $_POST['curso_mestrado'],
                    'modalidade' => $_POST['modalidade_mestrado'] ?? null,
                    'tipo_instituicao' => $_POST['tipo_instituicao_mestrado'] ?? null,
                    'foi_bolsista' => isset($_POST['foi_bolsista_mestrado']) ? (int)$_POST['foi_bolsista_mestrado'] : 0,
                    'ano_inicio' => !empty($_POST['ano_ingresso_mestrado']) ? (int)$_POST['ano_ingresso_mestrado'] : null,
                    'ano_conclusao' => !empty($_POST['ano_conclusao_mestrado']) ? (int)$_POST['ano_conclusao_mestrado'] : null,
                    'carga_horaria' => null,
                ];
                
                $id_insercao_mestrado = $formacao_superior_controller->cadastrarDadosFormacaoSuperior($valores_mestrado);

                if (!$id_insercao_mestrado) {
                    throw new Exception("Erro ao cadastrar mestrado: " . $_POST['curso_mestrado']);
                }
            }
        }

        # Processamento de Doutorado (se houver)
        if (!empty($_POST['nome_instituicao_doutorado']) && !empty($_POST['curso_doutorado'])) {
            $formacao_superior_controller = new FormacaoSuperiorController($id_insercao_sobre_formacao);
            
            $valores_doutorado = [
                'sobre_formacao_escolar_id' => $id_insercao_sobre_formacao,
                'nivel_formacao' => 'Doutorado',
                'nome_instituicao' => $_POST['nome_instituicao_doutorado'],
                'curso' => $_POST['curso_doutorado'],
                'modalidade' => $_POST['modalidade_doutorado'] ?? null,
                'tipo_instituicao' => $_POST['tipo_instituicao_doutorado'] ?? null,
                'foi_bolsista' => isset($_POST['foi_bolsista_doutorado']) ? (int)$_POST['foi_bolsista_doutorado'] : 0,
                'ano_inicio' => !empty($_POST['ano_ingresso_doutorado']) ? (int)$_POST['ano_ingresso_doutorado'] : null,
                'ano_conclusao' => !empty($_POST['ano_conclusao_doutorado']) ? (int)$_POST['ano_conclusao_doutorado'] : null,
                'carga_horaria' => null,
            ];
            
            $id_insercao_doutorado = $formacao_superior_controller->cadastrarDadosFormacaoSuperior($valores_doutorado);

            if (!$id_insercao_doutorado) {
                throw new Exception("Erro ao cadastrar doutorado: " . $_POST['curso_doutorado']);
            }
        }

        # Mudando o progresso do participante após ter sucesso na inserção de dados
        $user_participante_controler = new UserParticipanteControler();
        $atualizacao_progresso = $user_participante_controler->atualizarProgressoParticipante($_SESSION['id_participante'], 3);
        
        if (!$atualizacao_progresso) {
            throw new Exception("Erro ao atualizar o progresso do participante");
        }

        # Redirecionamento automático para próximo formulário
        header("Location: /pesquisa_educacional/views/formularios/formulario_sobre_carreira.php");
        exit;
        
    } catch (Exception $e) {
        error_log("Erro no cadastro de informações de formação escolar: " . $e->getMessage());
        $_SESSION['mensagem_erro'] = "Erro ao processar dados de formação escolar: " . $e->getMessage();
        header("Location: /pesquisa_educacional/views/erro.php");
        exit;
    }
} else {
    http_response_code(405);
    header("Location: /pesquisa_educacional/views/erro.php");
    exit;
}
?>