<?php
// processa_formulario.php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }   

    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/habilitar_debug_erro.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/SobreCursistaControler.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        # Dados da tabela 'SobreCursista':
        $valores_sobre_cursista = [
            $participante_id = $_SESSION['id_participante'],
            $ano_nascimento = $_POST['ano_nascimento'] ?? null,
            $sexo = $_POST['sexo'] ?? null,
            $estado_naturalidade = $_POST['estado_naturalidade'] ?? null,
            $municipio_naturalidade = $_POST['municipio_naturalidade'] ?? null,
            $estado_reside_atualmente = $_POST['estado_reside_atualmente'] ?? null,
            $municipio_reside_atualmente = $_POST['municipio_reside_atualmente'] ?? null,
            $anos_reside_atualmente = $_POST['anos_reside_atualmente'] ?? null,
            $residencia_propria = $_POST['residencia_propria'] ?? null,
            $tem_filhos = $_POST['tem_filhos'] ?? null,
            $quantidade_filhos = $_POST['quantidade_filhos'] ?? null,
            $vive_com_filhos = $_POST['vive_com_filhos'] ?? null,
            $filhos_vivem_com = $_POST['filhos_vivem_com'] ?? null,
            $estado_civil = $_POST['estado_civil'] ?? null,
            $data_nascimento_conjugue = $_POST['data_nascimento_conjugue'] ?? null,
            $profissao_conjugue = $_POST['profissao_conjugue'] ?? null,
            $casou_varias_vezes = $_POST['casou_varias_vezes'] ?? null,
            $quantidade_casamentos = $_POST['quantidade_casamentos'] ?? null,
            $sindicalizado = $_POST['sindicalizado'] ?? null,
            $tempo_sindicalizado = $_POST['tempo_sindicalizado'] ?? null,
            $transporte_frequentemente_utilizado = $_POST['transporte_frequentemente_utilizado'] ?? null,
            $tem_religiao = $_POST['tem_religiao'] ?? null,
            $religiao_praticada = $_POST['religiao_praticada'] ?? null,
            $tem_opcao_partidaria = $_POST['tem_opcao_partidaria'] ?? null,
            $opcao_partidaria = $_POST['opcao_partidaria'] ?? null,
            $partidos_votados_ultimas_eleicoes = $_POST['partidos_votados_ultimas_eleicoes'] ?? null,
            $escala_politica_esquerda_direita = $_POST['escala_politica_esquerda_direita'] ?? null
        ];
        
        # Tabela 'CompartilhamentoResidencia':
        $compartilha_com = $_POST['compartilha_com'] ?? [];
        
        # Tabela 'OpiniaoTemaSobreCursista':
        $posse_de_armas = $_POST['posse_de_armas'] ?? null;
        $migracao = $_POST['migracao'] ?? null;
        $homossexualismo = $_POST['homossexualismo'] ?? null;
        $pobreza = $_POST['pobreza'] ?? null;
        $pena_de_morte = $_POST['pena_de_morte'] ?? null;
        $sindicatos = $_POST['sindicatos'] ?? null;
        $criminalidade = $_POST['criminalidade'] ?? null;
        $adolescentes = $_POST['adolescentes'] ?? null;
        $drogas = $_POST['drogas'] ?? null;
        $religiao = $_POST['religiao'] ?? null;
        
        echo '<pre>'; print_r($_POST); echo '</pre>';

    } else {
        // Se a requisição não for POST, bloqueia o acesso ou redireciona
        http_response_code(405);
        echo "Método não permitido.";
        exit;
    }
?>
