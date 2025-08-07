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
    
    # Dados da tabela 'SobreCarreira'
    $valores_sobre_carreira = [
        'participante_id' => $_SESSION['id_participante'],
        'exercia_trabalho_anteriormente' => $_POST[''] ?? null,
        'exerce_atividade_paralela' => $_POST[''] ?? null,
        'atividade_paralela' => $_POST[''] ?? null,
        'mesmo_estabelecimento_desde_inicio' => $_POST[''] ?? null,
        'quantidade_estabelecimentos_carreira' => $_POST[''] ?? null,
        'quantidade_estabelecimentos_atuais' => $_POST[''] ?? null,
        'tempo_como_professor' => $_POST[''] ?? null,
        'numero_alunos_maior_turma' => $_POST[''] ?? null,
        'numero_alunos_menor_turma' => $_POST[''] ?? null,
        'possui_equipamentos_necessarios' => $_POST[''] ?? null,
        'equipamentos_desejados' => $_POST[''] ?? null,
    ];

    # Persistindo Tabela 'SobreCarreira'
    $sobre_carreira_controller = new SobreCarreiraController($_SESSION['id_participante']);
    $id_insercao_sobre_carreira = $sobre_carreira_controller->cadastrarDadosSobreCarreira($valores_sobre_carreira);

    # Dados da tabela 'TrabalhoAnterior'
    $valores_trabalho_anterior = [
        'sobre_carreira_id' => $_SESSION[$id_insercao_sobre_carreira],
        'nome_profissao' => $_POST[''] ?? null,
        'como_exercia' => $_POST[''] ?? null,
    ];

    # Persistindo Tabela 'TrabalhoAnterior'
    $trabalho_anterior_controller = new TrabalhoAnteriorController($valores_trabalho_anterior);
    $id_insercao_trabalho_anterior = $trabalho_anterior_controller->cadastrarDadosTrabalhoAnterior($valores_trabalho_anterior);

    # Dados da tabela 'EstabelecimentoTrabalho'
    $valores_estabelecimento_trabalho = [
        'sobre_carreira_id' => $_SESSION[$id_insercao_sobre_carreira],
        'nome_escola' => $_POST[''] ?? null,
        'jornada_trabalho_semanal' => $_POST[''] ?? null,
        'situacao_funcional' => $_POST[''] ?? null,
        'tipo_turma' => $_POST[''] ?? null,
        'localizacao_escola' => $_POST[''] ?? null,
        'dependencia_administrativa' => $_POST[''] ?? null,
        'contexto_escolar' => $_POST[''] ?? null,
    ];

    # Persistindo Tabela 'EstabelecimentoTrabalho'
    $valores_estabelecimento_trabalho = new EstabelecimentoTrabalhoController($valores_estabelecimento_trabalho);
    $id_insercao_estabelecimento_trabalho = $estabelecimento_trabalho_controller->cadastrarDadosEstabelecimentoTrabalho($valores_estabelecimento_trabalho);

    # Dados da tabela 'EtapaAtuanteEducacao'
    $valores_etapa_atuante_educacao = [
        'sobre_carreira_id' => $_SESSION[$id_insercao_sobre_carreira],
        'estabelecimento_trabalho_id' => $_POST[''] ?? null,
        'nivel_etapa' => $_POST[''] ?? null,
    ];

    # Persistindo Tabela 'EstabelecimentoTrabalho'
    $valores_etapa_atuante_educacao = new EtapaAtuanteEducacaoController($valores_etapa_atuante_educacao);
    $id_insercao_etapa_atuante_educacao = $etapa_atuante_educacao_controller->cadastrarEtapaAtuanteEducacao($valores_etapa_atuante_educacao);

} else {
    http_response_code(405);
    $_SESSION['mensagem_exececao'] = "Método não permitido";
    header("Location: /pesquisa_educacional/views/erro.php");
}


?>