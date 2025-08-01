<?php
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }   

    // if (!isset($_SESSION['id_participante'])){
    //     $_SESSION['mensagem_excecao'] = 'Requisição inválida, tente novamente.';
    //     header("Location: /pesquisa_educacional/views/erro.php");
    // }

    $_SESSION['id_participante'] = 1; # Valor para testes.

    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/habilitar_debug_erro.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/SobreCursistaControler.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/CompartilhamentoResidenciaControler.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/OpiniaoTemaSobreCursistaControler.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $id_insercao_sobre_cursista =  $sobre_cursista_controler->cadastrarDadosSobreCursista($valores_sobre_cursista);

        # Persistindo Tabela 'CompartilhamentoResidencia':
        $valores_compartilhamento_residencia = $_POST['compartilha_com'] ?? [];
        $compartilhamento_residencia_controler = new CompartilhamentoResidenciaControler($id_insercao_sobre_cursista);
        foreach($valores_compartilhamento_residencia as $valor_compartilhamento){
            $persistencia_compartilhamento_residencia =  $compartilhamento_residencia_controler->cadastrarCompartilhamentoResidencia($valor_compartilhamento);
            if(!$persistencia_compartilhamento_residencia){
                echo "Erro encontrado.";
                exit;
                // $_SESSION['mensagem_excecao'] = "Erro ao cadastrar dados de compartilhamento de residencia.";
                // header("Location: /pesquisa_educacional/views/erro.php");
                // exit;
            
            }
        }

        # Tabela 'OpiniaoTemaSobreCursista':
        $opiniao_tema_sobre_cursista_controler = new OpiniaoTemaSobreCursistaControler($id_insercao_sobre_cursista);
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

        foreach($opinoes_temas_sobre_cursista as $tema_opiniao => $texto_opiniao){
            $persistencia = $opiniao_tema_sobre_cursista_controler->cadastrarOpiniaoTemaSobreCursista($tema_opiniao, $texto_opiniao);
            if(!$persistencia){
                echo "erro encontrado na persistência.";
                // $_SESSION['mensagem_excecao'] = "Erro ao cadastrar dados de opiniões sobre temas";
                // header("Location: /pesquisa_educacional/views/erro.php");
                // exit;
            }
        }
        
        echo "Dados cadastrados com sucesso";

    } else {
        http_response_code(405);
        echo "Método não permitido.";
        exit;
    }
?>
