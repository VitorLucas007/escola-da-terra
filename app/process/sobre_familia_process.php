<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// $_SESSION['id_participante'] = 1;

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/SobreFamiliaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoMaiorIdadeController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoMenorIdadeController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoIrmaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoGenitorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoAvosController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    try {
        # Dados da tabela 'SobreFamilia'
        $valores_sobre_familia = [
            'participante_id' => $_SESSION['id_participante'],
            'possui_filhos' => isset($_POST['possui_filhos']) ? (int)$_POST['possui_filhos'] : 0,
            'quantidade_irmaos' => isset($_POST['quantidade_irmaos']) ? (int)$_POST['quantidade_irmaos'] : 0,
        ];

        # Persistindo Tabela 'SobreFamilia'
        $sobre_familia_controller = new SobreFamiliaController($_SESSION['id_participante']);
        $id_insercao_sobre_familia = $sobre_familia_controller->cadastrarDadosSobreFamilia($valores_sobre_familia);

        if (!$id_insercao_sobre_familia) {
            throw new Exception("Erro ao cadastrar informações sobre família");
        }

                # Processamento de Filhos (se houver)
        if (isset($_POST['possui_filhos']) && $_POST['possui_filhos'] == 1) {
            $nomesFilhos = $_POST['nome_filho'] ?? [];
            $sexos = $_POST['sexo'] ?? [];
            $datasNascimento = $_POST['data_nascimento'] ?? [];
            $viveComParticipante = $_POST['vive_com_participante'] ?? [];
            $solteiros = $_POST['solteiro'] ?? [];
            $idadesSaiuCasa = $_POST['idade_saiu_casa'] ?? [];

            if (!empty($nomesFilhos)) {
                $informacao_filho_controller = new InformacaoFilhoController($id_insercao_sobre_familia);

                foreach ($nomesFilhos as $index => $nome) {
                    if (!empty($nome)) {
                        $valores_filho = [
                            'sobre_familia_id' => $id_insercao_sobre_familia,
                            'nome' => $nome,
                            'sexo' => $sexos[$index] ?? null,
                            'data_nascimento' => $datasNascimento[$index] ?? null,
                            'vive_com_participante' => isset($viveComParticipante[$index]) ? (int)$viveComParticipante[$index] : 0,
                            'solteiro' => isset($solteiros[$index]) ? (int)$solteiros[$index] : 0,
                            'idade_saiu_casa' => isset($idadesSaiuCasa[$index]) && $idadesSaiuCasa[$index] !== '' ? (int)$idadesSaiuCasa[$index] : null,
                        ];
                        
                        $id_insercao_filho = $informacao_filho_controller->cadastrarDadosInformacaoFilho($valores_filho);

                        if (!$id_insercao_filho) {
                            throw new Exception("Erro ao cadastrar informações do filho: " . $nome);
                        }

                        if (!empty($datasNascimento[$index])) {
                            $dataNascimentoObj = new DateTime($datasNascimento[$index]);
                            $hoje = new DateTime();
                            $idade = $hoje->diff($dataNascimentoObj)->y;

                            if ($idade >= 18) {
                                // ### LÓGICA CORRIGIDA E MAIS ROBUSTA ###
                                $nomesMaioresIdade = $_POST['nome_filho_maior_idade'] ?? [];
                                $situacoesVida = $_POST['situacao_vida'] ?? [];
                                
                                // Procura o nome do filho atual na lista de nomes de filhos maiores de idade
                                $keyMaiorIdade = array_search(trim($nome), array_map('trim', $nomesMaioresIdade));

                                if ($keyMaiorIdade !== false && isset($situacoesVida[$keyMaiorIdade]) && !empty($situacoesVida[$keyMaiorIdade])) {
                                    $valores_filho_maior_idade = [
                                        'informacao_filho_id' => $id_insercao_filho,
                                        'situacao_vida' => $situacoesVida[$keyMaiorIdade],
                                    ];
                                    $filho_maior_idade_controller = new InformacaoFilhoMaiorIdadeController($id_insercao_filho);
                                    if (!$filho_maior_idade_controller->cadastrarDadosInformacaoFilhoMaior($valores_filho_maior_idade)) {
                                        throw new Exception("Erro ao cadastrar detalhes do filho maior de idade: " . $nome);
                                    }
                                }
                            } else {
                                // Lógica para filhos menores de idade (se necessário, pode ser melhorada da mesma forma)
                                $nomesMenoresIdade = $_POST['nome_filho_menor_idade'] ?? [];
                                $etapasEducacao = $_POST['etapa_educacao'] ?? [];
                                $habitacoesForaEscola = $_POST['habitacao_fora_escola'] ?? [];
                                $acompanhantes = $_POST['acompanhante'] ?? [];
                                
                                $keyMenorIdade = array_search(trim($nome), array_map('trim', $nomesMenoresIdade));

                                if ($keyMenorIdade !== false) {
                                     $valores_filho_menor_idade = [
                                        'informacao_filho_id' => $id_insercao_filho,
                                        'etapa_educacao' => $etapasEducacao[$keyMenorIdade] ?? null,
                                        'habitacao_fora_escola' => $habitacoesForaEscola[$keyMenorIdade] ?? null,
                                        'acompanhante' => $acompanhantes[$keyMenorIdade] ?? null,
                                    ];
                                    $filho_menor_idade_controller = new InformacaoFilhoMenorIdadeController($id_insercao_filho);
                                    if (!$filho_menor_idade_controller->cadastrarDadosInformacaoFilhoMenor($valores_filho_menor_idade)) {
                                        throw new Exception("Erro ao cadastrar detalhes do filho menor de idade: " . $nome);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        # Processamento de Irmãos
        $nomesIrmaos = $_POST['nome_irmao'] ?? [];
        $profissoesIrmaos = $_POST['profissao_irmao'] ?? [];
        $habitaMesmaLocalidade = $_POST['habita_mesma_localidade'] ?? [];
        $locaisHabitacao = $_POST['local_habitacao'] ?? [];

        if (!empty($nomesIrmaos)) {
            $informacao_irmao_controller = new InformacaoIrmaoController($id_insercao_sobre_familia);

            foreach ($nomesIrmaos as $index => $nome) {
                if (!empty($nome)) {
                    # Dados do irmão atual
                    $valores_irmao = [
                        'sobre_familia_id' => $id_insercao_sobre_familia,
                        'nome' => $nome,
                        'profissao' => $profissoesIrmaos[$index] ?? 'Desconhecido',
                        'habita_mesma_localidade' => isset($habitaMesmaLocalidade[$index]) ? (int)$habitaMesmaLocalidade[$index] : 0,
                        'local_habitacao' => $locaisHabitacao[$index] ?? null,
                    ];
                    
                    # Inserir informações do irmão
                    $id_insercao_irmao = $informacao_irmao_controller->cadastrarDadosInformacaoIrmao($valores_irmao);

                    if (!$id_insercao_irmao) {
                        throw new Exception("Erro ao cadastrar informações do irmão: " . $nome);
                    }
                }
            }
        }

        # Processamento de Genitores (Pai e Mãe)
        $informacao_genitor_controller = new InformacaoGenitorController($id_insercao_sobre_familia);

        # Processar Pai
        if (!empty($_POST['escolaridade_pai'])) {
            $valores_pai = [
                'sobre_familia_id' => $id_insercao_sobre_familia,
                'tipo_genitor' => 'Pai',
                'escolaridade' => $_POST['escolaridade_pai'] ?? null,
                'profissao' => $_POST['profissao_pai'] ?? 'Desconhecido',
                'naturalidade' => $_POST['naturalidade_pai'] ?? 'Desconhecido',
                'religiao' => $_POST['religiao_pai'] ?? 'Desconhecido',
                'participa_grupo' => isset($_POST['participa_grupo_pai']) ? (int)$_POST['participa_grupo_pai'] : null,
                'grupos_participacao' => $_POST['grupo_participacao_pai'] ?? null,
            ];
            
            $id_insercao_pai = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_pai);
            
            if (!$id_insercao_pai) {
                throw new Exception("Erro ao cadastrar informações do pai");
            }
        }

        # Processar Mãe
        if (!empty($_POST['escolaridade_mae'])) {
            $valores_mae = [
                'sobre_familia_id' => $id_insercao_sobre_familia,
                'tipo_genitor' => 'Mae',
                'escolaridade' => $_POST['escolaridade_mae'] ?? null,
                'profissao' => $_POST['profissao_mae'] ?? 'Desconhecido',
                'naturalidade' => $_POST['naturalidade_mae'] ?? 'Desconhecido',
                'religiao' => $_POST['religiao_mae'] ?? 'Desconhecido',
                'participa_grupo' => isset($_POST['participa_grupo_mae']) ? (int)$_POST['participa_grupo_mae'] : null,
                'grupos_participacao' => $_POST['grupo_participacao_mae'] ?? null,
            ];
            
            $id_insercao_mae = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_mae);
            
            if (!$id_insercao_mae) {
                throw new Exception("Erro ao cadastrar informações da mãe");
            }
        }

        # Processamento de Avós
        $informacao_avos_controller = new InformacaoAvosController($id_insercao_sobre_familia);

        # Processar Avós Paternos
        if (!empty($_POST['escolaridade_avo_masc_paterno']) || !empty($_POST['escolaridade_avo_fem_paterno'])) {
            $valores_avos_paternos = [
                'sobre_familia_id' => $id_insercao_sobre_familia,
                'tipo_avos' => 'Paternos',
                'escolaridade_avo_masc' => $_POST['escolaridade_avo_masc_paterno'] ?? null,
                'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_paterno'] ?? null,
                'profissao_avo_masc' => $_POST['profissao_avo_masc_paterno'] ?? 'Desconhecido',
                'profissao_avo_fem' => $_POST['profissao_avo_fem_paterno'] ?? 'Desconhecido',
                'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_paterno'] ?? 'Desconhecido',
                'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_paterno'] ?? 'Desconhecido',
                'religiao_avos' => $_POST['religiao_avos_paternos'] ?? 'Desconhecido',
            ];
            
            $id_insercao_avos_paternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_avos_paternos);
            
            if (!$id_insercao_avos_paternos) {
                throw new Exception("Erro ao cadastrar informações dos avós paternos");
            }
        }

        # Processar Avós Maternos
        if (!empty($_POST['escolaridade_avo_masc_materno']) || !empty($_POST['escolaridade_avo_fem_materno'])) {
            $valores_avos_maternos = [
                'sobre_familia_id' => $id_insercao_sobre_familia,
                'tipo_avos' => 'Maternos',
                'escolaridade_avo_masc' => $_POST['escolaridade_avo_masc_materno'] ?? null,
                'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_materno'] ?? null,
                'profissao_avo_masc' => $_POST['profissao_avo_masc_materno'] ?? 'Desconhecido',
                'profissao_avo_fem' => $_POST['profissao_avo_fem_materno'] ?? 'Desconhecido',
                'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_materno'] ?? 'Desconhecido',
                'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_materno'] ?? 'Desconhecido',
                'religiao_avos' => $_POST['religiao_avos_maternos'] ?? 'Desconhecido',
            ];
            
            $id_insercao_avos_maternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_avos_maternos);
            
            if (!$id_insercao_avos_maternos) {
                throw new Exception("Erro ao cadastrar informações dos avós maternos");
            }
        }

        # Mudando o progresso do participante após ter sucesso na inserção de dados:
        $user_participante_controler = new UserParticipanteControler();
        $atualizacao_progresso = $user_participante_controler->atualizarProgressoParticipante($_SESSION['id_participante'], 2);
        
        if (!$atualizacao_progresso) {
            throw new Exception("Erro ao atualizar o progresso do participante");
        }

        # Redirecionamento automático para próximo formulário
        header("Location: /pesquisa_educacional/views/formularios/formulario_sobre_formacao_escolar.php");
        exit;
        
    } catch (Exception $e) {
        error_log("Erro no cadastro de informações familiares: " . $e->getMessage());
        $_SESSION['mensagem_erro'] = "Erro ao processar dados familiares: " . $e->getMessage();
        header("Location: /pesquisa_educacional/views/erro.php");
        exit;
    }
} else {
    http_response_code(405);
    header("Location: /pesquisa_educacional/views/erro.php");
    exit;
}
?>