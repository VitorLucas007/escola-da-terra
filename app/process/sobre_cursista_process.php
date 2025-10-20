<?php
    
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}   

// $_SESSION['id_participante'] = 1; # Valor para testes.

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/SobreCursistaControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/CompartilhamentoResidenciaControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/OpiniaoTemaSobreCursistaControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        # Dados da tabela 'SobreCursista':
        $valores_sobre_cursista = [
            'participante_id' => $_SESSION['id_participante'],
            'ano_nascimento' =>  $_POST['ano_nascimento'] ?? null,
            'sexo' =>  $_POST['sexo'] ?? null,
            'estado_naturalidade' => $_POST['estado_naturalidade'] ?? null,
            'municipio_naturalidade' => $_POST['municipio_naturalidade'] ?? null,
            'estado_reside_atualmente' => $_POST['estado_reside_atualmente'] ?? null,
            'municipio_reside_atualmente' => $_POST['municipio_reside_atualmente'] ?? null,
            'anos_reside_atualmente' => $_POST['anos_reside_atualmente'] ?? null,
            'residencia_propria' => $_POST['residencia_propria'] ?? null,
            'tem_filhos' => $_POST['tem_filhos'] ?? null,
            'quantidade_filhos' => $_POST['quantidade_filhos'] ?? 0,
            'vive_com_filhos' => $_POST['vive_com_filhos'] ?? null,
            'filhos_vivem_com' => $_POST['filhos_vivem_com'] ?? null,
            'estado_civil' => $_POST['estado_civil'] ?? null,
            'anos_tempo_casado' => $_POST['anos_tempo_casado'] ?? null,
            'anos_uniao_estavel' => $_POST['anos_uniao_estavel'] ?? null,
            'data_nascimento_conjuge' => $_POST['data_nascimento_conjuge'] ?? null,
            'profissao_conjuge' => $_POST['profissao_conjuge'] ?? null,
            'casou_varias_vezes' => $_POST['casou_varias_vezes'] ?? null,
            'quantidade_casamentos' => $_POST['quantidade_casamentos'] ?? 1,
            'sindicalizado' => $_POST['sindicalizado'] ?? null,
            'tempo_sindicalizado' => $_POST['tempo_sindicalizado'] ?? null,
            'transporte_frequente' => $_POST['transporte_frequente'] ?? null,
            'tem_religiao' =>  $_POST['tem_religiao'] ?? null,
            'religiao_praticada' => $_POST['religiao_praticada'] ?? null,
            'tem_opcao_partidaria' => $_POST['tem_opcao_partidaria'] ?? null,
            'opcao_partidaria' => $_POST['opcao_partidaria'] ?? null,
            'partidos_votados_ultimas_eleicoes' => $_POST['partidos_votados_ultimas_eleicoes'] ?? null,
            'escala_politica_esquerda_direita' => $_POST['escala_politica_esquerda_direita'] ?? null
        ];

        # Persistindo Tabela 'SobreCursista':
        $sobre_cursista_controler = new SobreCursistaControler($_SESSION['id_participante']);
        $id_insercao_sobre_cursista = $sobre_cursista_controler->cadastrarDadosSobreCursista($valores_sobre_cursista);

        if (!$id_insercao_sobre_cursista) {
            throw new Exception("Erro ao cadastrar dados principais do cursista");
        }

        # Tabela 'CompartilhamentoResidencia':
        $valores_compartilhamento_residencia = $_POST['compartilha_com'] ?? [];
        
        // Filtrar valores vazios e nulos
        $valores_compartilhamento_residencia = array_filter($valores_compartilhamento_residencia, function($valor) {
            return !empty(trim($valor));
        });
        
        if (empty($valores_compartilhamento_residencia)) {
            throw new Exception("Nenhum valor válido de compartilhamento de residência foi informado");
        }
        
        # Fazendo inserção de compartilhamento:
        $compartilhamento_residencia_controler = new CompartilhamentoResidenciaControler($id_insercao_sobre_cursista);
        foreach($valores_compartilhamento_residencia as $valor_compartilhamento){
            $persistencia_compartilhamento_residencia = $compartilhamento_residencia_controler->cadastrarCompartilhamentoResidencia($valor_compartilhamento);
            if(!$persistencia_compartilhamento_residencia){
                throw new Exception("Erro ao cadastrar compartilhamento de residência: $valor_compartilhamento");
            }
        }

        # Tabela 'OpiniaoTemaSobreCursista':
        $opiniao_tema_sobre_cursista_controler = new OpiniaoTemaSobreCursistaControler($id_insercao_sobre_cursista);
        
      
    $mapeamento_temas = [
        'posse_de_armas' => 'posse_de_armas',      
        'migracao' => 'migracao',                  
        'homossexualismo' => 'homossexualismo',
        'pobreza' => 'pobreza',
        'pena_de_morte' => 'pena_de_morte',        
        'sindicatos' => 'sindicatos',
        'criminalidade' => 'criminalidade',
        'adolescentes' => 'adolescentes',
        'drogas' => 'drogas',
        'religiao' => 'religião'                    
        ];

        $opinoes_temas_sobre_cursista = [
            'posse_de_armas' => $_POST['posse_de_armas'] ?? null,
            'migracao' =>  $_POST['migracao'] ?? null,
            'homossexualismo' =>  $_POST['homossexualismo'] ?? null,
            'pobreza' =>  $_POST['pobreza'] ?? null,
            'pena_de_morte' =>  $_POST['pena_de_morte'] ?? null,
            'sindicatos' =>  $_POST['sindicatos'] ?? null,
            'criminalidade' =>  $_POST['criminalidade'] ?? null,
            'adolescentes' =>  $_POST['adolescentes'] ?? null,
            'drogas' =>  $_POST['drogas'] ?? null,
            'religiao' =>  $_POST['religiao'] ?? null,
        ];
        
        foreach($opinoes_temas_sobre_cursista as $tema_campo_html => $texto_opiniao){
            if ($texto_opiniao !== null) {
                // Usar o nome correto do ENUM
                $tema_nome_banco = $mapeamento_temas[$tema_campo_html];
                
                $persistencia = $opiniao_tema_sobre_cursista_controler->cadastrarOpiniaoTemaSobreCursista($tema_nome_banco, $texto_opiniao);
                if(!$persistencia){
                    throw new Exception("Erro ao cadastrar opinião sobre o tema: $tema_campo_html");
                }
            }
        }

        # Mudando o progresso do participante após ter sucesso na inserção de dados:
        $user_participante_controler = new UserParticipanteControler();
        $atualizacao_progresso = $user_participante_controler->atualizarProgressoParticipante($_SESSION['id_participante'], 1);
        if (!$atualizacao_progresso) {
            throw new Exception("Erro ao atualizar o progresso do participante");
        }
        
        # Redirecionamento automático para próximo formulário
        header("Location: /pesquisa_educacional/views/formularios/formulario_sobre_familia.php");
        exit;
        
    } catch (Exception $e) {
        error_log("Erro no cadastro sobre cursista: " . $e->getMessage());
        $_SESSION['mensagem_erro'] = "Erro ao processar dados: " . $e->getMessage();
        header("Location: /pesquisa_educacional/views/erro.php");
        exit;
    }
    
} else {
    http_response_code(405);
    header("Location: /pesquisa_educacional/views/erro.php");
    exit;
}
?>