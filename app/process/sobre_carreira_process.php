<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['id_participante'] = 1;

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/TrabalhoAnteriorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/EstabelecimentoTrabalhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/EtapaAtuanteEducacaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/SobreCarreiraController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    try {
        # Dados da tabela 'SobreCarreira'
        $valores_sobre_carreira = [
            'participante_id' => $_SESSION['id_participante'],
            'exercia_trabalho_anteriormente' => $_POST['exercia_trabalho_anteriormente'] ?? null,
            'exerce_atividade_paralela' => $_POST['exerce_atividade_paralela'] ?? null,
            'atividade_paralela' => $_POST['atividade_paralela'] ?? null,
            'mesmo_estabelecimento_desde_inicio' => $_POST['mesmo_estabelecimento_desde_inicio'] ?? null,
            'quantidade_estabelecimentos_carreira' => $_POST['quantidade_estabelecimentos_carreira'] ?? null,
            'quantidade_estabelecimentos_atuais' => $_POST['quantidade_estabelecimentos_atuais'] ?? null,
            'tempo_como_professor' => $_POST['tempo_como_professor'] ?? null,
            'numero_alunos_maior_turma' => $_POST['numero_alunos_maior_turma'] ?? null,
            'numero_alunos_menor_turma' => $_POST['numero_alunos_menor_turma'] ?? null,
            'possui_equipamentos_necessarios' => $_POST['possui_equipamentos_necessarios'] ?? null,
            'equipamentos_desejados' => $_POST['equipamentos_desejados'] ?? null,
        ];

        # Persistindo Tabela 'SobreCarreira'
        $sobre_carreira_controller = new SobreCarreiraController($_SESSION['id_participante']);
        $id_insercao_sobre_carreira = $sobre_carreira_controller->cadastrarDadosSobreCarreira($valores_sobre_carreira);

        if (!$id_insercao_sobre_carreira) {
            throw new Exception("Erro ao cadastrar informações sobre carreira");
        }

        # Dados da tabela 'TrabalhoAnterior'
        $valores_trabalho_anterior = [
            'sobre_carreira_id' => $id_insercao_sobre_carreira,
            'nome_profissao' => $_POST['nome_profissao'] ?? null,
            'como_exercia' => $_POST['como_exercia'] ?? null,
        ];

        # Persistindo Tabela 'TrabalhoAnterior'
        $trabalho_anterior_controller = new TrabalhoAnteriorController($id_insercao_sobre_carreira);
        $id_insercao_trabalho_anterior = $trabalho_anterior_controller->cadastrarDadosTrabalhoAnterior($valores_trabalho_anterior);

        if (!$id_insercao_trabalho_anterior) {
            throw new Exception("Erro ao cadastrar trabalho anterior");
        }

        # Processamento de Múltiplas Escolas
        $nomes_escolas = $_POST['nome_escola'] ?? [];
        $escolas_cadastradas = 0;
        $etapas_cadastradas = 0;

        if (is_array($nomes_escolas) && !empty($nomes_escolas)) {
            
            $estabelecimento_trabalho_controller = new EstabelecimentoTrabalhoController($id_insercao_sobre_carreira);
            
            foreach ($nomes_escolas as $index => $nome_escola) {
                if (!empty($nome_escola)) {
                    
                    # Dados da escola atual
                    $valores_estabelecimento_trabalho = [
                        'sobre_carreira_id' => $id_insercao_sobre_carreira,
                        'nome_escola' => $nome_escola,
                        'jornada_trabalho_semanal' => $_POST['jornada_trabalho_semanal'][$index] ?? null,
                        'situacao_funcional' => $_POST['situacao_funcional'][$index] ?? null,
                        'tipo_turma' => $_POST['tipo_turma'][$index] ?? null,
                        'localizacao_escola' => $_POST['localizacao_escola'][$index] ?? null,
                        'dependencia_administrativa' => $_POST['dependencia_administrativa'][$index] ?? null,
                        'contexto_escolar' => $_POST['contexto_escolar'][$index] ?? null,
                    ];

                    # Inserir estabelecimento de trabalho
                    $id_insercao_estabelecimento_trabalho = $estabelecimento_trabalho_controller->cadastrarEstabelecimentoTrabalho($valores_estabelecimento_trabalho);

                    if (!$id_insercao_estabelecimento_trabalho) {
                        throw new Exception("Erro ao cadastrar estabelecimento de trabalho: $nome_escola");
                    }

                    $escolas_cadastradas++;

                    # Processamento das Etapas/Modalidades de Ensino para esta escola
                    $etapas_escola = $_POST['etapas_modalidades'][$index] ?? [];
                    
                    if (is_array($etapas_escola) && !empty($etapas_escola)) {
                        
                        $etapa_atuante_educacao_controller = new EtapaAtuanteEducacaoController($id_insercao_estabelecimento_trabalho);
                        
                        foreach ($etapas_escola as $nivel_etapa) {
                            if (!empty($nivel_etapa)) {
                                
                                $valores_etapa_atuante_educacao = [
                                    'estabelecimento_trabalho_id' => $id_insercao_estabelecimento_trabalho,
                                    'nivel_etapa' => $nivel_etapa, # Removido o mapeamento
                                ];

                                $id_insercao_etapa_atuante_educacao = $etapa_atuante_educacao_controller->cadastrarDadosEtapaAtuanteEducacao($valores_etapa_atuante_educacao);

                                if (!$id_insercao_etapa_atuante_educacao) {
                                    throw new Exception("Erro ao cadastrar etapa de ensino: $nivel_etapa");
                                }

                                $etapas_cadastradas++;
                            }
                        }
                    }
                }
            }
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

?>