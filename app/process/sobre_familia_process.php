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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
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

        # Persistindo Tabela 'InformacaoFilho' (múltiplos filhos)
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

                    $filhos_cadastrados++;

                    # Verificar se é filho maior de idade
                    if (isset($_POST['situacao_vida'][$index])) {
                        $valores_filho_maior = [
                            'informacao_filho_id' => $id_informacao_filho,
                            'situacao_vida' => $_POST['situacao_vida'][$index]
                        ];

                        $informacao_filho_maior_controller = new InformacaoFilhoMaiorIdadeController(null);
                        $resultado_maior = $informacao_filho_maior_controller->cadastrarDadosInformacaoFilhoMaior($valores_filho_maior);
                        
                        if (!$resultado_maior) {
                            throw new Exception("Erro ao cadastrar informações do filho maior: $nome_filho");
                        }
                    }

                    # Verificar se é filho menor de idade
                    if (isset($_POST['etapa_educacao'][$index])) {
                        $valores_filho_menor = [
                            'informacao_filho_id' => $id_informacao_filho,
                            'etapa_educacao' => $_POST['etapa_educacao'][$index],
                            'habitacao_fora_escola' => $_POST['habitacao_fora_escola'][$index] ?? null,
                            'acompanhante' => $_POST['acompanhante'][$index] ?? null
                        ];

                        $informacao_filho_menor_controller = new InformacaoFilhoMenorIdadeController(null);
                        $resultado_menor = $informacao_filho_menor_controller->cadastrarDadosInformacaoFilhoMenor($valores_filho_menor);
                        
                        if (!$resultado_menor) {
                            throw new Exception("Erro ao cadastrar informações do filho menor: $nome_filho");
                        }
                    }
                }
            }
        }
        
        # Persistindo Tabela 'InformacaoIrmao' (múltiplos irmãos)
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

    } catch (Exception $e) {
        error_log("Erro no cadastro familiar: " . $e->getMessage());
        echo "Erro ao processar dados familiares: " . $e->getMessage();
    }

} else {
    http_response_code(405);
    echo "Método não permitido";
}
?>