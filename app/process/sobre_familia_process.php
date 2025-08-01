<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificação de sessão (comentada para testes, igual ao segundo arquivo)
// if (!isset($_SESSION['id_participante'])){
//     $_SESSION['mensagem_excecao'] = 'Requisição inválida, tente novamente.';
//     header("Location: /pesquisa_educacional/views/erro.php");
//     exit;
// }

$_SESSION['id_participante'] = 1; # Valor para testes.

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/habilitar_debug_erro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/SobreFamiliaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoMaiorIdadeController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoMenorIdadeController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoIrmaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoAvosController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoGenitorController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    # Dados da tabela 'SobreFamilia':
    $valores_sobre_familia = [
        'participante_id' => $_SESSION['id_participante'],
        'possuiFilhos' => $_POST['possui_filhos'] ?? null,
        'quantidadeIrmaos' => $_POST['quantidade_irmaos'] ?? null
    ];

    # Persistindo Tabela 'SobreFamilia':
    $sobre_familia_controller = new SobreFamiliaController($_SESSION['id_participante']);
    $id_insercao_sobre_familia = $sobre_familia_controller->cadastrarDadosSobreFamilia($valores_sobre_familia);

    # Persistindo Tabela 'InformacaoFilho' (múltiplos filhos):
    $nomes_filhos = $_POST['nome_filho'] ?? [];
    if (is_array($nomes_filhos) && !empty($nomes_filhos)) {
        $informacao_filho_controller = new InformacaoFilhoController($id_insercao_sobre_familia);
        
        foreach ($nomes_filhos as $index => $nome_filho) {
            if (!empty($nome_filho)) {
                $valores_informacao_filho = [
                    'id_informacao_filho' => null, // Auto increment
                    'nome' => $nome_filho,
                    'sexo' => $_POST['sexo'][$index] ?? null,
                    'data_nascimento' => $_POST['data_nascimento'][$index] ?? null,
                    'vive_com_participante' => $_POST['vive_com_participante'][$index] ?? null,
                    'idade_saiu_casa' => $_POST['idade_saiu_casa'][$index] ?? null
                ];

                $id_insercao_informacao_filho = $informacao_filho_controller->cadastrarDadosInformacaoFilho($valores_informacao_filho);
                if (!$id_insercao_informacao_filho) {
                    echo "Erro ao cadastrar dados do filho: $nome_filho";
                    exit;
                }
            }
        }
    }

    # Persistindo Tabela 'InformacaoFilhoMaiorIdade' (múltiplos filhos maiores):
    $nomes_filhos_maiores = $_POST['nome_filho_maior_idade'] ?? [];
    if (is_array($nomes_filhos_maiores) && !empty($nomes_filhos_maiores)) {
        foreach ($nomes_filhos_maiores as $index => $nome_filho_maior) {
            if (!empty($nome_filho_maior)) {
                $valores_informacao_filho_maior_idade = [
                    'id_informacao_filho_menor_idade' => null, // Este campo parece estar com nome errado no model
                    'situacao_vida' => $_POST['situacao_vida'][$index] ?? null
                ];

                $informacao_filho_maior_idade_controller = new InformacaoFilhoMaiorIdadeController(null);
                $persistencia_filho_maior = $informacao_filho_maior_idade_controller->cadastrarDadosInformacaoFilhoMaior($valores_informacao_filho_maior_idade);
                
                if (!$persistencia_filho_maior) {
                    echo "Erro ao cadastrar dados do filho maior de idade: $nome_filho_maior";
                    exit;
                }
            }
        }
    }

    # Persistindo Tabela 'InformacaoFilhoMenorIdade' (múltiplos filhos menores):
    $nomes_filhos_menores = $_POST['nome_filho_menor_idade'] ?? [];
    if (is_array($nomes_filhos_menores) && !empty($nomes_filhos_menores)) {
        foreach ($nomes_filhos_menores as $index => $nome_filho_menor) {
            if (!empty($nome_filho_menor)) {
                $valores_informacao_filho_menor_idade = [
                    'id_informacao_filho_menor_idade' => null,
                    'etapa_educacao' => $_POST['etapa_educacao'][$index] ?? null,
                    'habitacao_fora_escola' => $_POST['habitacao_fora_escola'][$index] ?? null,
                    'acompanhante' => $_POST['acompanhante'][$index] ?? null
                ];

                $informacao_filho_menor_idade_controller = new InformacaoFilhoMenorIdadeController(null);
                $persistencia_filho_menor = $informacao_filho_menor_idade_controller->cadastrarDadosInformacaoFilhoMenor($valores_informacao_filho_menor_idade);
                
                if (!$persistencia_filho_menor) {
                    echo "Erro ao cadastrar dados do filho menor de idade: $nome_filho_menor";
                    exit;
                }
            }
        }
    }
    
    # Persistindo Tabela 'InformacaoIrmao' (múltiplos irmãos):
    $nomes_irmaos = $_POST['nome_irmao'] ?? [];
    if (is_array($nomes_irmaos) && !empty($nomes_irmaos)) {
        $informacao_irmao_controller = new InformacaoIrmaoController($id_insercao_sobre_familia);
        
        foreach ($nomes_irmaos as $index => $nome_irmao) {
            if (!empty($nome_irmao)) {
                $valores_informacao_irmao = [
                    'sobre_irmao_id' => $id_insercao_sobre_familia,
                    'nome' => $nome_irmao,
                    'profissao' => $_POST['profissao_irmao'][$index] ?? null,
                    'habita_mesma_localidade' => $_POST['habita_mesma_localidade'][$index] ?? null,
                    'local_habitacao' => $_POST['local_habitacao'][$index] ?? null
                ];

                $persistencia_irmao = $informacao_irmao_controller->cadastrarDadosInformacaoIrmao($valores_informacao_irmao);
                if (!$persistencia_irmao) {
                    echo "Erro ao cadastrar dados do irmão: $nome_irmao";
                    exit;
                }
            }
        }
    }
    
    # Persistindo Tabela 'InformacaoGenitor' - PAI:
    $valores_informacao_pai = [
        'sobre_genitor_id' => $id_insercao_sobre_familia,
        'tipo_genitor' => 'pai',
        'escolaridade' => $_POST['escolaridade_pai'] ?? null,
        'naturalidade' => $_POST['naturalidade_pai'] ?? null,
        'religiao' => $_POST['religiao_pai'] ?? null,
        'participa_grupo' => $_POST['participa_grupo_pai'] ?? null,
        'grupo_participa' => $_POST['grupo_participacao_pai'] ?? null
    ];

    $informacao_genitor_controller = new InformacaoGenitorController($id_insercao_sobre_familia);
    $persistencia_pai = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_informacao_pai);
    if (!$persistencia_pai) {
        echo "Erro ao cadastrar dados do pai";
        exit;
    }

    # Persistindo Tabela 'InformacaoGenitor' - MÃE:
    $valores_informacao_mae = [
        'sobre_genitor_id' => $id_insercao_sobre_familia,
        'tipo_genitor' => 'mae',
        'escolaridade' => $_POST['escolaridade_mae'] ?? null,
        'naturalidade' => $_POST['naturalidade_mae'] ?? null,
        'religiao' => $_POST['religiao_mae'] ?? null,
        'participa_grupo' => $_POST['participa_grupo_mae'] ?? null,
        'grupo_participa' => $_POST['grupo_participacao_mae'] ?? null
    ];

    $persistencia_mae = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_informacao_mae);
    if (!$persistencia_mae) {
        echo "Erro ao cadastrar dados da mãe";
        exit;
    }
    
    # Persistindo Tabela 'InformacaoAvos' - AVÓS PATERNOS:
    $valores_informacao_avos_paternos = [
        'id_informacao_avos' => null,
        'tipo_avos' => 'paternos',
        'escolaridade_avo_mascs' => $_POST['escolaridade_avo_masc_paterno'] ?? null,
        'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_paterno'] ?? null,
        'profissao_avo_masc' => $_POST['profissao_avo_masc_paterno'] ?? null,
        'profissao_avo_fem' => $_POST['profissao_avo_fem_paterno'] ?? null,
        'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_paterno'] ?? null,
        'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_paterno'] ?? null,
        'religiao_avos' => $_POST['religiao_avos_paternos'] ?? null
    ];

    $informacao_avos_controller = new InformacaoAvosController($id_insercao_sobre_familia);
    $persistencia_avos_paternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_informacao_avos_paternos);
    if (!$persistencia_avos_paternos) {
        echo "Erro ao cadastrar dados dos avós paternos";
        exit;
    }

    # Persistindo Tabela 'InformacaoAvos' - AVÓS MATERNOS:
    $valores_informacao_avos_maternos = [
        'id_informacao_avos' => null,
        'tipo_avos' => 'maternos',
        'escolaridade_avo_mascs' => $_POST['escolaridade_avo_masc_materno'] ?? null,
        'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_materno'] ?? null,
        'profissao_avo_masc' => $_POST['profissao_avo_masc_materno'] ?? null,
        'profissao_avo_fem' => $_POST['profissao_avo_fem_materno'] ?? null,
        'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_materno'] ?? null,
        'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_materno'] ?? null,
        'religiao_avos' => $_POST['religiao_avos_maternos'] ?? null
    ];

    $persistencia_avos_maternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_informacao_avos_maternos);
    if (!$persistencia_avos_maternos) {
        echo "Erro ao cadastrar dados dos avós maternos";
        exit;
    }

    echo "Dados cadastrados com sucesso!";

} else {
    http_response_code(405);
    echo "Método não permitido.";
    exit;
}
?>