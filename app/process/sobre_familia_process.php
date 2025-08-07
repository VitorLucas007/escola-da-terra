<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['id_participante'] = 1; 

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

    if (!$id_insercao_sobre_familia) {
        die("Erro ao cadastrar SobreFamilia");
    }
    
    echo "SobreFamilia cadastrada com ID: $id_insercao_sobre_familia<br>";

    # Persistindo Tabela 'InformacaoFilho' (múltiplos filhos):
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

                $id_insercao_informacao_filho = $informacao_filho_controller->cadastrarDadosInformacaoFilho($valores_informacao_filho);
                if (!$id_insercao_informacao_filho) {
                    echo "Erro ao cadastrar dados do filho: $nome_filho<br>";
                    exit;
                }
                echo "Filho cadastrado: $nome_filho (ID: $id_insercao_informacao_filho)<br>";
            }
        }
    }

    # Persistindo Tabela 'InformacaoFilhoMaiorIdade' (múltiplos filhos maiores):
    $nomes_filhos_maiores = $_POST['nome_filho_maior_idade'] ?? [];
    if (is_array($nomes_filhos_maiores) && !empty($nomes_filhos_maiores)) {
        foreach ($nomes_filhos_maiores as $index => $nome_filho_maior) {
            if (!empty($nome_filho_maior)) {
                // Buscar o ID do filho pelo nome (assumindo que você tenha essa lógica)
                $sql_busca_filho = "SELECT id_informacao_filho FROM InformacaoFilho WHERE sobre_familia_id = ? AND nome = ?";
                $resultado_filho = $banco->consultar($sql_busca_filho, [$id_insercao_sobre_familia, $nome_filho_maior]);
                
                if (!empty($resultado_filho)) {
                    $informacao_filho_id = $resultado_filho[0]['id_informacao_filho'];
                    
                    $valores_informacao_filho_maior_idade = [
                        'informacao_filho_id' => $informacao_filho_id, 
                        'situacao_vida' => $_POST['situacao_vida'][$index] ?? null
                    ];

                    $informacao_filho_maior_idade_controller = new InformacaoFilhoMaiorIdadeController(null);
                    $persistencia_filho_maior = $informacao_filho_maior_idade_controller->cadastrarDadosInformacaoFilhoMaior($valores_informacao_filho_maior_idade);
                    
                    if (!$persistencia_filho_maior) {
                        echo "Erro ao cadastrar dados do filho maior de idade: $nome_filho_maior<br>";
                        exit;
                    }
                    echo "Filho maior cadastrado: $nome_filho_maior<br>";
                }
            }
        }
    }

    # Persistindo Tabela 'InformacaoFilhoMenorIdade' (múltiplos filhos menores):
    $nomes_filhos_menores = $_POST['nome_filho_menor_idade'] ?? [];
    if (is_array($nomes_filhos_menores) && !empty($nomes_filhos_menores)) {
        foreach ($nomes_filhos_menores as $index => $nome_filho_menor) {
            if (!empty($nome_filho_menor)) {
                // Buscar o ID do filho pelo nome
                $sql_busca_filho = "SELECT id_informacao_filho FROM InformacaoFilho WHERE sobre_familia_id = ? AND nome = ?";
                $resultado_filho = $banco->consultar($sql_busca_filho, [$id_insercao_sobre_familia, $nome_filho_menor]);
                
                if (!empty($resultado_filho)) {
                    $informacao_filho_id = $resultado_filho[0]['id_informacao_filho'];
                    
                    $valores_informacao_filho_menor_idade = [
                        'informacao_filho_id' => $informacao_filho_id,
                        'etapa_educacao' => $_POST['etapa_educacao'][$index] ?? null,
                        'habitacao_fora_escola' => $_POST['habitacao_fora_escola'][$index] ?? null,
                        'acompanhante' => $_POST['acompanhante'][$index] ?? null
                    ];

                    $informacao_filho_menor_idade_controller = new InformacaoFilhoMenorIdadeController(null);
                    $persistencia_filho_menor = $informacao_filho_menor_idade_controller->cadastrarDadosInformacaoFilhoMenor($valores_informacao_filho_menor_idade);
                    
                    if (!$persistencia_filho_menor) {
                        echo "Erro ao cadastrar dados do filho menor de idade: $nome_filho_menor<br>";
                        exit;
                    }
                    echo "Filho menor cadastrado: $nome_filho_menor<br>";
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
                    'sobre_familia_id' => $id_insercao_sobre_familia, 
                    'nome' => $nome_irmao,
                    'profissao' => $_POST['profissao_irmao'][$index] ?? 'Desconhecido', 
                    'habita_mesma_localidade' => $_POST['habita_mesma_localidade'][$index] ?? null,
                    'local_habitacao' => $_POST['local_habitacao'][$index] ?? null
                ];

                $persistencia_irmao = $informacao_irmao_controller->cadastrarDadosInformacaoIrmao($valores_informacao_irmao);
                if (!$persistencia_irmao) {
                    echo "Erro ao cadastrar dados do irmão: $nome_irmao<br>";
                    exit;
                }
                echo "Irmão cadastrado: $nome_irmao<br>";
            }
        }
    }
    
    # Persistindo Tabela 'InformacaoGenitor' - PAI:
    $valores_informacao_pai = [
        'sobre_familia_id' => $id_insercao_sobre_familia,
        'tipo_genitor' => 'Pai',
        'escolaridade' => $_POST['escolaridade_pai'] ?? null,
        'profissao' => $_POST['profissao_pai'] ?? 'Desconhecido',
        'naturalidade' => $_POST['naturalidade_pai'] ?? 'Desconhecido',
        'religiao' => $_POST['religiao_pai'] ?? 'Desconhecido',
        'participa_grupo' => $_POST['participa_grupo_pai'] ?? null,
        'grupos_participacao' => $_POST['grupo_participacao_pai'] ?? null
    ];

    $informacao_genitor_controller = new InformacaoGenitorController($id_insercao_sobre_familia);
    $persistencia_pai = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_informacao_pai);
    if (!$persistencia_pai) {
        echo "Erro ao cadastrar dados do pai<br>";
        exit;
    }
    echo "Dados do pai cadastrados<br>";

    # Persistindo Tabela 'InformacaoGenitor' - MÃE:
    $valores_informacao_mae = [
        'sobre_familia_id' => $id_insercao_sobre_familia, 
        'tipo_genitor' => 'Mae', 
        'escolaridade' => $_POST['escolaridade_mae'] ?? null,
        'profissao' => $_POST['profissao_mae'] ?? 'Desconhecido', 
        'naturalidade' => $_POST['naturalidade_mae'] ?? 'Desconhecido',
        'religiao' => $_POST['religiao_mae'] ?? 'Desconhecido',
        'participa_grupo' => $_POST['participa_grupo_mae'] ?? null,
        'grupos_participacao' => $_POST['grupo_participacao_mae'] ?? null
    ];

    $persistencia_mae = $informacao_genitor_controller->cadastrarDadosInformacaoGenitor($valores_informacao_mae);
    if (!$persistencia_mae) {
        echo "Erro ao cadastrar dados da mãe<br>";
        exit;
    }
    echo "Dados da mãe cadastrados<br>";
    
    # Persistindo Tabela 'InformacaoAvos' - AVÓS PATERNOS:
    $valores_informacao_avos_paternos = [
        'sobre_familia_id' => $id_insercao_sobre_familia, 
        'tipo_avos' => 'Paternos',
        'escolaridade_avo_masc' => $_POST['escolaridade_avo_masc_paterno'] ?? null,
        'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_paterno'] ?? null,
        'profissao_avo_masc' => $_POST['profissao_avo_masc_paterno'] ?? 'Desconhecido',
        'profissao_avo_fem' => $_POST['profissao_avo_fem_paterno'] ?? 'Desconhecido',
        'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_paterno'] ?? 'Desconhecido',
        'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_paterno'] ?? 'Desconhecido',
        'religiao_avos' => $_POST['religiao_avos_paternos'] ?? 'Desconhecido'
    ];

    $informacao_avos_controller = new InformacaoAvosController($id_insercao_sobre_familia);
    $persistencia_avos_paternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_informacao_avos_paternos);
    if (!$persistencia_avos_paternos) {
        echo "Erro ao cadastrar dados dos avós paternos<br>";
        exit;
    }
    echo "Dados dos avós paternos cadastrados<br>";

    # Persistindo Tabela 'InformacaoAvos' - AVÓS MATERNOS:
    $valores_informacao_avos_maternos = [
        'sobre_familia_id' => $id_insercao_sobre_familia,
        'tipo_avos' => 'Maternos',  
        'escolaridade_avo_masc' => $_POST['escolaridade_avo_masc_materno'] ?? null,
        'escolaridade_avo_fem' => $_POST['escolaridade_avo_fem_materno'] ?? null,
        'profissao_avo_masc' => $_POST['profissao_avo_masc_materno'] ?? 'Desconhecido',
        'profissao_avo_fem' => $_POST['profissao_avo_fem_materno'] ?? 'Desconhecido',
        'naturalidade_avo_masc' => $_POST['naturalidade_avo_masc_materno'] ?? 'Desconhecido',
        'naturalidade_avo_fem' => $_POST['naturalidade_avo_fem_materno'] ?? 'Desconhecido',
        'religiao_avos' => $_POST['religiao_avos_maternos'] ?? 'Desconhecido'
    ];

    $persistencia_avos_maternos = $informacao_avos_controller->cadastrarDadosInformacaoAvos($valores_informacao_avos_maternos);
    if (!$persistencia_avos_maternos) {
        echo "Erro ao cadastrar dados dos avós maternos<br>";
        exit;
    }
    echo "Dados dos avós maternos cadastrados<br>";

    echo "<br><strong>Todos os dados cadastrados com sucesso!</strong>";

} else {
    http_response_code(405);
    $_SESSION['mensagem_excecao'] = "Método não permitido";
    header("Location: /pesquisa_educacional/views/erro.php");
    exit;
}
?>