<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['id_participante'] = 1; 

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/SobreFamiliaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoMaiorIdadeController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoMenorIdadeController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoIrmaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoAvosController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoGenitorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        // Adicionar debug
        error_log("POST recebido: " . print_r($_POST, true));

        # Dados da tabela 'SobreFamilia'
        $valores_sobre_familia = [
            'participante_id' => $_SESSION['id_participante'],
            'possuiFilhos' => $_POST['possui_filhos'] ?? null,
            'quantidadeIrmaos' => $_POST['quantidade_irmaos'] ?? null
        ];

        # Persistindo Tabela 'SobreFamilia'
        $sobre_familia_controller = new SobreFamiliaController($_SESSION['id_participante']);
        $id_insercao_sobre_familia = $sobre_familia_controller->cadastrarDadosSobreFamilia($valores_sobre_familia);

        if (!$id_insercao_sobre_familia) {
            throw new Exception("Erro ao cadastrar dados sobre família");
        }

        $filhos_cadastrados = 0;
        $irmaos_cadastrados = 0;

        # Array para armazenar IDs dos filhos por índice
        $ids_filhos = [];

        # Persistindo Tabela 'InformacaoFilho' - USANDO ÍNDICES
        $nomes_filhos = $_POST['nome_filho'] ?? [];
        if (is_array($nomes_filhos) && !empty($nomes_filhos)) {
            $informacao_filho_controller = new InformacaoFilhoController($id_insercao_sobre_familia);
            
            foreach ($nomes_filhos as $index => $nome_filho) {
                if (!empty($nome_filho)) {
                    $valores_informacao_filho = [
                        'sobre_familia_id' => $id_insercao_sobre_familia, 
                        'nome' => $nome_filho,
                        'sexo' => $_POST['sexo'][$index] ?? null,
                        'data_nascimento' => $_POST['data_nascimento'][$index] ?? null,
                        'vive_com_participante' => $_POST['vive_com_participante'][$index] ?? null,
                        'solteiro' => $_POST['solteiro'][$index] ?? null,
                        'idade_saiu_casa' => $_POST['idade_saiu_casa'][$index] ?? null
                    ];

                    $id_informacao_filho = $informacao_filho_controller->cadastrarDadosInformacaoFilho($valores_informacao_filho);
                    
                    if (!$id_informacao_filho) {
                        throw new Exception("Erro ao cadastrar dados do filho: $nome_filho");
                    }

                    # Armazenar ID do filho por ÍNDICE
                    $ids_filhos[$index] = $id_informacao_filho;
                    $filhos_cadastrados++;
                }
            }
        }

        # Persistindo filhos MAIORES de idade - USANDO ÍNDICES
        $nomes_filhos_maiores = $_POST['nome_filho_maior_idade'] ?? [];
        if (is_array($nomes_filhos_maiores) && !empty($nomes_filhos_maiores)) {
            foreach ($nomes_filhos_maiores as $index => $nome_filho_maior) {
                if (!empty($nome_filho_maior)) {
                    
                    # Buscar ID do filho pelo ÍNDICE no array principal
                    # Assumindo que os índices correspondem entre as tabelas
                    $informacao_filho_id = null;
                    
                    # Procurar o filho pelo nome nos IDs armazenados
                    foreach ($ids_filhos as $filho_index => $filho_id) {
                        if (isset($nomes_filhos[$filho_index]) && $nomes_filhos[$filho_index] === $nome_filho_maior) {
                            $informacao_filho_id = $filho_id;
                            break;
                        }
                    }
                    
                    if (!$informacao_filho_id) {
                        error_log("Filho maior de idade não encontrado: $nome_filho_maior");
                        continue; // Pula este filho ao invés de parar tudo
                    }
                    
                    $situacao_vida = $_POST['situacao_vida'][$index] ?? null;
                    if (!empty($situacao_vida)) {
                        $valores_filho_maior = [
                            'informacao_filho_id' => $informacao_filho_id,
                            'situacao_vida' => $situacao_vida
                        ];

                        $informacao_filho_maior_controller = new InformacaoFilhoMaiorIdadeController($informacao_filho_id);
                        $resultado_maior = $informacao_filho_maior_controller->cadastrarDadosInformacaoFilhoMaior($valores_filho_maior);
                        
                        if (!$resultado_maior) {
                            throw new Exception("Erro ao cadastrar informações do filho maior: $nome_filho_maior");
                        }
                    }
                }
            }
        }

        # Persistindo filhos MENORES de idade - USANDO ÍNDICES
        $nomes_filhos_menores = $_POST['nome_filho_menor_idade'] ?? [];
        if (is_array($nomes_filhos_menores) && !empty($nomes_filhos_menores)) {
            foreach ($nomes_filhos_menores as $index => $nome_filho_menor) {
                if (!empty($nome_filho_menor)) {
                    
                    # Buscar ID do filho pelo nome nos IDs armazenados
                    $informacao_filho_id = null;
                    foreach ($ids_filhos as $filho_index => $filho_id) {
                        if (isset($nomes_filhos[$filho_index]) && $nomes_filhos[$filho_index] === $nome_filho_menor) {
                            $informacao_filho_id = $filho_id;
                            break;
                        }
                    }
                    
                    if (!$informacao_filho_id) {
                        error_log("Filho menor de idade não encontrado: $nome_filho_menor");
                        continue; // Pula este filho ao invés de parar tudo
                    }
                    
                    $etapa_educacao = $_POST['etapa_educacao'][$index] ?? null;
                    $habitacao_fora_escola = $_POST['habitacao_fora_escola'][$index] ?? null;
                    $acompanhante = $_POST['acompanhante'][$index] ?? null;
                    
                    # Validar apenas se todos os campos estão preenchidos
                    if (!empty($etapa_educacao) && !empty($habitacao_fora_escola) && !empty($acompanhante)) {
                        $valores_filho_menor = [
                            'informacao_filho_id' => $informacao_filho_id,
                            'etapa_educacao' => $etapa_educacao,
                            'habitacao_fora_escola' => $habitacao_fora_escola,
                            'acompanhante' => $acompanhante
                        ];

                        $informacao_filho_menor_controller = new InformacaoFilhoMenorIdadeController($informacao_filho_id);
                        $resultado_menor = $informacao_filho_menor_controller->cadastrarDadosInformacaoFilhoMenor($valores_filho_menor);
                        
                        if (!$resultado_menor) {
                            throw new Exception("Erro ao cadastrar informações do filho menor: $nome_filho_menor");
                        }
                    }
                }
            }
        }
        
        # Persistindo Tabela 'InformacaoIrmao' - MESMA LÓGICA DO ARQUIVO QUE FUNCIONA
        $nomes_irmaos = $_POST['nome_irmao'] ?? [];
        if (is_array($nomes_irmaos) && !empty($nomes_irmaos)) {
            $informacao_irmao_controller = new InformacaoIrmaoController($id_insercao_sobre_familia);
            
            foreach ($nomes_irmaos as $index => $nome_irmao) {
                if (!empty($nome_irmao)) {
                    $valores_informacao_irmao = [
                        'sobre_familia_id' => $id_insercao_sobre_familia, 
                        'nome' => $nome_irmao,
                        'profissao' => $_POST['profissao_irmao'][$index] ?? null, 
                        'habita_mesma_localidade' => $_POST['habita_mesma_localidade'][$index] ?? null,
                        'local_habitacao' => $_POST['local_habitacao'][$index] ?? null
                    ];

                    $resultado_irmao = $informacao_irmao_controller->cadastrarDadosInformacaoIrmao($valores_informacao_irmao);
                    
                    if (!$resultado_irmao) {
                        throw new Exception("Erro ao cadastrar dados do irmão: $nome_irmao");
                    }

                    $irmaos_cadastrados++;
                }
            }
        }
        
        # Persistindo Tabela 'InformacaoGenitor' - PAI
        $valores_informacao_pai = [
            'sobre_familia_id' => $id_insercao_sobre_familia,
            'tipo_genitor' => 'Pai',
            'escolaridade' => $_POST['escolaridade_pai'] ?? null,
            'profissao' => $_POST['profissao_pai'] ?? null,
            'naturalidade' => $_POST['naturalidade_pai'] ?? null,
            'religiao' => $_POST['religiao_pai'] ?? null,
            'participa_grupo' => $_POST['participa_grupo_pai'] ?? null,
            'grupos_participacao' => $_POST['grupo_participacao_pai'] ?? null
        ];

        $informacao_genitor_controller = new InformacaoGenitorController($id_insercao_sobre_familia);
        $resultado_pai = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_informacao_pai);
        
        if (!$resultado_pai) {
            throw new Exception("Erro ao cadastrar dados do pai");
        }

        # Persistindo Tabela 'InformacaoGenitor' - MÃE
        $valores_informacao_mae = [
            'sobre_familia_id' => $id_insercao_sobre_familia, 
            'tipo_genitor' => 'Mae', 
            'escolaridade' => $_POST['escolaridade_mae'] ?? null,
            'profissao' => $_POST['profissao_mae'] ?? null, 
            'naturalidade' => $_POST['naturalidade_mae'] ?? null,
            'religiao' => $_POST['religiao_mae'] ?? null,
            'participa_grupo' => $_POST['participa_grupo_mae'] ?? null,
            'grupos_participacao' => $_POST['grupo_participacao_mae'] ?? null
        ];

        $resultado_mae = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_informacao_mae);
        
        if (!$resultado_mae) {
            throw new Exception("Erro ao cadastrar dados da mãe");
        }
        
        # Persistindo Tabela 'InformacaoAvos' - AVÓS PATERNOS
        $valores_avos_paternos = [
            'sobre_familia_id' => $id_insercao_sobre_familia, 
            'tipo_avos' => 'Paternos',
            'escolaridade_avo_masc' => $_POST['escolaridade_avo_masc_paterno'] ?? null,
            'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_paterno'] ?? null,
            'profissao_avo_masc' => $_POST['profissao_avo_masc_paterno'] ?? null,
            'profissao_avo_fem' => $_POST['profissao_avo_fem_paterno'] ?? null,
            'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_paterno'] ?? null,
            'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_paterno'] ?? null,
            'religiao_avos' => $_POST['religiao_avos_paternos'] ?? null
        ];

        $informacao_avos_controller = new InformacaoAvosController($id_insercao_sobre_familia);
        $resultado_avos_paternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_avos_paternos);
        
        if (!$resultado_avos_paternos) {
            throw new Exception("Erro ao cadastrar dados dos avós paternos");
        }

        # Persistindo Tabela 'InformacaoAvos' - AVÓS MATERNOS
        $valores_avos_maternos = [
            'sobre_familia_id' => $id_insercao_sobre_familia,
            'tipo_avos' => 'Maternos',  
            'escolaridade_avo_masc' => $_POST['escolaridade_avo_masc_materno'] ?? null,
            'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_materno'] ?? null,
            'profissao_avo_masc' => $_POST['profissao_avo_masc_materno'] ?? null,
            'profissao_avo_fem' => $_POST['profissao_avo_fem_materno'] ?? null,
            'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_materno'] ?? null,
            'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_materno'] ?? null,
            'religiao_avos' => $_POST['religiao_avos_maternos'] ?? null
        ];

        $resultado_avos_maternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_avos_maternos);
        
        if (!$resultado_avos_maternos) {
            throw new Exception("Erro ao cadastrar dados dos avós maternos");
        }

        # Mensagem de sucesso
        echo "Dados familiares cadastrados com sucesso!";
        if ($filhos_cadastrados > 0) {
            echo " ($filhos_cadastrados filhos cadastrados)";
        }
        if ($irmaos_cadastrados > 0) {
            echo " ($irmaos_cadastrados irmãos cadastrados)";
        }

        # Mudando o progresso do participante após ter sucesso na inserção de dados:
        $user_participante_controler = new UserParticipanteControler();       
        $atualizacao_progresso = $user_participante_controler->atualizarProgressoParticipante($_SESSION['id_participante'], 2);
        if(!$atualizacao_progresso){
            echo "erro ao atualizar o progresso do participante";
            exit;
        }

    } catch (Exception $e) {
        error_log("Erro no cadastro familiar: " . $e->getMessage());
        echo "Erro ao processar dados familiares: " . $e->getMessage();
    }

} else {
    http_response_code(405);
    echo "Método não permitido";
}
?>