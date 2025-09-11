<?php
// Inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. VERIFICAÇÃO INICIAL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /pesquisa_educacional/views/listar_participantes.php");
    exit;
}
$id_participante = $_GET['id'];

// 2. INCLUI TODOS OS CONTROLLERS NECESSÁRIOS
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';
// Controllers do Cursista
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/SobreCursistaControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/CompartilhamentoResidenciaControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/OpiniaoTemaSobreCursistaControler.php';
// Controllers da Família
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/SobreFamiliaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoIrmaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoGenitorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoAvosController.php';
// Controllers da Carreira
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/SobreCarreiraController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/TrabalhoAnteriorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/EstabelecimentoTrabalhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/EtapaAtuanteEducacaoController.php';
// Controllers do Exercício Profissional
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/SobreExercicioProfissaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/BeneficioOriundoAtividadeDocenciaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/BeneficioRecebidoSalarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/FonteStressController.php';
// Controllers da Condição de Estudo
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/SobreCondicaoEstudoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/AcessoInternetController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/CategoriaLivroFrequenteController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/LeituraFrequenteController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/UltimoLivroGostadoController.php';
// COntrollers sobre vida geral 
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/SobreVidaGeralController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/AtividadeForaTrabalhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/FrequenciaBebidaAlcoolicaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/ProblemaUltimasSemanasController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/RazaoAlimentacaoDesequilibradaController.php';


// 3. BUSCA OS DADOS BÁSICOS
$userController = new UserParticipanteControler();
$participante = $userController->buscarParticipantePorId($id_participante);

if (!$participante) {
    header("Location: /pesquisa_educacional/views/listar_participantes.php");
    exit;
}

// 4. BUSCA DADOS DO FORMULÁRIO 'SOBRE O CURSISTA'
$cursistaController = new SobreCursistaControler($id_participante);
$dados_cursista = $cursistaController->buscarCursistaPorParticipanteId($id_participante);
$compartilhamentos = [];
$opinioes = [];
if ($dados_cursista) {
    $id_informacao_cursista = $dados_cursista['id_informacao_cursista'];
    $compartilhamentoController = new CompartilhamentoResidenciaControler($id_informacao_cursista);
    $compartilhamentos = $compartilhamentoController->buscarCompartilhamentosPorCursistaId($id_informacao_cursista);
    $opiniaoController = new OpiniaoTemaSobreCursistaControler($id_informacao_cursista);
    $opinioes = $opiniaoController->buscarOpinioesPorCursistaId($id_informacao_cursista);
}

// 5. BUSCA DADOS DO FORMULÁRIO 'SOBRE A FAMÍLIA'
$sobreFamiliaController = new SobreFamiliaController(null); // ID não é necessário para buscar
$dados_familia = $sobreFamiliaController->buscarSobreFamiliaPorParticipanteId($id_participante);
$filhos = [];
$irmaos = [];
$genitores = [];
$avos = [];
if ($dados_familia) {
    $id_sobre_familia = $dados_familia['id_informacao_familiares'];
    
    $filhoController = new InformacaoFilhoController($id_sobre_familia);
    $filhos = $filhoController->buscarFilhosComDetalhesPorFamiliaId($id_sobre_familia);

    $irmaoController = new InformacaoIrmaoController($id_sobre_familia);
    $irmaos = $irmaoController->buscarIrmaosPorFamiliaId($id_sobre_familia);

    $genitorController = new InformacaoGenitorController($id_sobre_familia);
    $genitores = $genitorController->buscarGenitoresPorFamiliaId($id_sobre_familia);

    $avosController = new InformacaoAvosController($id_sobre_familia);
    $avos = $avosController->buscarAvosPorFamiliaId($id_sobre_familia);
}

// 5. BUSCA DADOS DO FORMULÁRIO 'SOBRE CARREIRA'
$sobreCarreiraController = new SobreCarreiraController(null);
$dados_carreira = $sobreCarreiraController->buscarSobreCarreiraPorParticipanteId($id_participante);

$trabalho_anterior = null;
$estabelecimentos = [];

if ($dados_carreira) {
    $id_sobre_carreira = $dados_carreira['id_informacao_carreira'];

    if ($dados_carreira['exercia_trabalho_anteriormente']) {
        $trabalhoAnteriorController = new TrabalhoAnteriorController(null);
        $trabalho_anterior = $trabalhoAnteriorController->buscarTrabalhoAnteriorPorCarreiraId($id_sobre_carreira);
    }

    $estabelecimentoController = new EstabelecimentoTrabalhoController(null);
    $estabelecimentos = $estabelecimentoController->buscarEstabelecimentosPorCarreiraId($id_sobre_carreira);

    // Para cada estabelecimento, busca as suas etapas de atuação
    if (!empty($estabelecimentos)) {
        $etapaController = new EtapaAtuanteEducacaoController(null);
        foreach ($estabelecimentos as $key => $est) {
            $id_estabelecimento = $est['id_estabelecimento_trabalho'];
            $estabelecimentos[$key]['etapas'] = $etapaController->buscarEtapasPorEstabelecimentoId($id_estabelecimento);
        }
    }
    }
    // 5. BUSCA DADOS DO FORMULÁRIO 'SOBRE EXERCICIO PROFISSAO'
    $sobreExercicioController = new SobreExercicioProfissaoController(null);
        $dados_exercicio = $sobreExercicioController->buscarExercicioProfissaoPorParticipanteId($id_participante);

    $beneficios_docencia = [];
    $beneficios_salario = [];
    $fontes_stress = [];

    if ($dados_exercicio) {
    $id_exercicio_profissao = $dados_exercicio['id_informacao_exercicio_profissao'];

    $beneficioDocenciaController = new BeneficioOriundoAtividadeDocenciaController(null);
    $beneficios_docencia = $beneficioDocenciaController->buscarBeneficiosDocenciaPorExercicioId($id_exercicio_profissao);

    $beneficioSalarioController = new BeneficioRecebidoSalarioController(null);
    $beneficios_salario = $beneficioSalarioController->buscarBeneficiosSalarioPorExercicioId($id_exercicio_profissao);

    $fonteStressController = new FonteStressController(null);
    $fontes_stress = $fonteStressController->buscarFontesStressPorExercicioId($id_exercicio_profissao);
    }

    // 5. BUSCA DADOS DO FORMULÁRIO 'SOBRE CONDICAO DE ESTUDO'
$sobreCondicaoEstudoController = new SobreCondicaoEstudoController(null);
$dados_condicao_estudo = $sobreCondicaoEstudoController->buscarCondicaoEstudoPorParticipanteId($id_participante);

$acesso_internet = [];
$categorias_livros = [];
$leituras_frequentes = [];
$ultimos_livros = [];

if ($dados_condicao_estudo) {
    $id_condicao_estudo = $dados_condicao_estudo['id_informacao_condicao_estudo'];

    $acessoInternetController = new AcessoInternetController(null);
    $acesso_internet = $acessoInternetController->buscarAcessoInternetPorCondicaoEstudoId($id_condicao_estudo);

    $categoriaLivroController = new CategoriaLivroFrequenteController(null);
    $categorias_livros = $categoriaLivroController->buscarCategoriasPorCondicaoEstudoId($id_condicao_estudo);
    
    $leituraFrequenteController = new LeituraFrequenteController(null);
    $leituras_frequentes = $leituraFrequenteController->buscarLeiturasPorCondicaoEstudoId($id_condicao_estudo);

    $ultimoLivroController = new UltimoLivroGostadoController(null);
    $ultimos_livros = $ultimoLivroController->buscarLivrosPorCondicaoEstudoId($id_condicao_estudo);
}

// 5. BUSCA DADOS DO FORMULÁRIO 'SOBRE VIDA GERAL'
$sobreVidaGeralController = new SobreVidaGeralController(null);
$dados_vida_geral = $sobreVidaGeralController->buscarSobreVidaGeralPorParticipanteId($id_participante);

$atividades_fora_trabalho = [];
$frequencia_bebidas = [];
$problemas_semanas = [];
$razoes_alimentacao = [];

if ($dados_vida_geral) {
    $id_vida_geral = $dados_vida_geral['id_sobre_vida_geral'];

    $atividadeController = new AtividadeForaTrabalhoController(null);
    $atividades_fora_trabalho = $atividadeController->buscarAtividadesPorVidaGeralId($id_vida_geral);

    $frequenciaBebidaController = new FrequenciaBebidaAlcoolicaController(null);
    $frequencia_bebidas = $frequenciaBebidaController->buscarFrequenciasBebidaPorVidaGeralId($id_vida_geral);
    
    $problemaSemanasController = new ProblemaUltimasSemanasController(null);
    $problemas_semanas = $problemaSemanasController->buscarProblemasPorVidaGeralId($id_vida_geral);

    $razaoAlimentacaoController = new RazaoAlimentacaoDesequilibradaController(null);
    $razoes_alimentacao = $razaoAlimentacaoController->buscarRazoesAlimentacaoPorVidaGeralId($id_vida_geral);
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respostas do Participante</title>
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php'; ?>
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
</head>
<body>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php'; ?>

    <div class="container my-5">
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-dark text-white"><h4 class="mb-0">Respostas do Participante</h4></div>
            <div class="card-body">
                <p class="fs-5"><strong>ID:</strong> <?php echo htmlspecialchars($participante['id_participante']); ?></p>
                <p class="fs-5 mb-0"><strong>Telefone:</strong> <?php echo htmlspecialchars($participante['telefone']); ?></p>
            </div>
        </div>

        <h3 class="mb-3">Formulário: Sobre o Cursista</h3>
        <?php if ($dados_cursista): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">1. Informações Pessoais</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Ano de Nascimento:</strong> <span><?php echo htmlspecialchars($dados_cursista['ano_nascimento']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Sexo:</strong> <span><?php echo htmlspecialchars($dados_cursista['sexo']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Naturalidade:</strong> <span><?php echo htmlspecialchars($dados_cursista['municipio_naturalidade']) . ' - ' . htmlspecialchars($dados_cursista['estado_naturalidade']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Estado Civil:</strong> <span><?php echo htmlspecialchars($dados_cursista['estado_civil']); ?></span></li>
                        </ul>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">2. Com Quem Reside</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if (!empty($compartilhamentos)): ?>
                            <?php foreach ($compartilhamentos as $item): ?>
                                <li class="list-group-item"><?php echo htmlspecialchars($item['compartilha_com']); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-muted">Nenhuma informação fornecida.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">3. Opiniões Sobre Temas</h5></div>
                <div class="card-body">
                     <ul class="list-group list-group-flush">
                        <?php if (!empty($opinioes)): ?>
                            <?php foreach ($opinioes as $opiniao): ?>
                                <li class="list-group-item">
                                    <strong><?php echo htmlspecialchars($opiniao['tema_opiniao']); ?>:</strong>
                                    <p class="mb-0 fst-italic">"<?php echo htmlspecialchars($opiniao['texto_opiniao']); ?>"</p>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-muted">Nenhuma opinião fornecida.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-info text-center">Este participante ainda não respondeu ao formulário "Sobre o Cursista".</div>
        <?php endif; ?>

        
        <hr class="my-5">

        <!-- ### INÍCIO DA NOVA SECÇÃO SOBRE A FAMÍLIA ### -->
        <h3 class="mb-3">Formulário: Sobre a Família</h3>
        <?php if ($dados_familia): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">1. Informações Gerais</h5></div>
                <div class="card-body">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Possui Filhos:</strong> <span><?php echo $dados_familia['possui_filhos'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Quantidade de Irmãos declarada:</strong> <span><?php echo htmlspecialchars($dados_familia['quantidade_irmaos']); ?></span></li>
                    </ul>
                </div>
            </div>

            <?php if (!empty($filhos)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">2. Filhos</h5></div>
                <div class="card-body p-0">
                    <?php foreach($filhos as $filho): ?>
                        <div class="p-3 border-bottom">
                            <h6 class="fw-bold"><?php echo htmlspecialchars($filho['nome']); ?></h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between"><strong>Sexo:</strong> <span><?php echo htmlspecialchars($filho['sexo']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Data de Nascimento:</strong> <span><?php echo date("d/m/Y", strtotime($filho['data_nascimento'])); ?></span></li>
                                <?php if($filho['situacao_vida']): ?>
                                    <li class="list-group-item d-flex justify-content-between"><strong>Situação (Maior de idade):</strong> <span><?php echo htmlspecialchars($filho['situacao_vida']); ?></span></li>
                                <?php endif; ?>
                                <?php if($filho['etapa_educacao']): ?>
                                    <li class="list-group-item d-flex justify-content-between"><strong>Etapa Educação (Menor de idade):</strong> <span><?php echo htmlspecialchars($filho['etapa_educacao']); ?></span></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($irmaos)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">3. Irmãos (<?php echo count($irmaos); ?>)</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php foreach($irmaos as $irmao): ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <strong>Nome do Irmão:</strong>
                                <span><?php echo htmlspecialchars($irmao['nome']); ?></span>
                            </div>
                            <div class="d-flex justify-content-between text-muted small">
                                <strong>Profissão:</strong>
                                <span><?php echo htmlspecialchars($irmao['profissao']); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($genitores)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">4. Genitores (Pais)</h5></div>
                <div class="card-body p-0">
                     <?php foreach($genitores as $genitor): ?>
                        <div class="p-3 border-bottom">
                            <h6 class="fw-bold"><?php echo htmlspecialchars($genitor['tipo_genitor']); ?></h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between"><strong>Escolaridade:</strong> <span><?php echo htmlspecialchars($genitor['escolaridade']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Profissão:</strong> <span><?php echo htmlspecialchars($genitor['profissao']); ?></span></li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($avos)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">5. Avós</h5></div>
                <div class="card-body p-0">
                    <?php foreach($avos as $avo): ?>
                        <div class="p-3 border-bottom">
                            <h6 class="fw-bold">Avós <?php echo htmlspecialchars($avo['tipo_avos']); ?></h6>
                             <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between"><strong>Escolaridade do Avô:</strong> <span><?php echo htmlspecialchars($avo['escolaridade_avo_masc']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Profissão do Avô:</strong> <span><?php echo htmlspecialchars($avo['profissao_avo_masc']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Escolaridade da Avó:</strong> <span><?php echo htmlspecialchars($avo['escolaridade_avo_fem']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Profissão da Avó:</strong> <span><?php echo htmlspecialchars($avo['profissao_avo_fem']); ?></span></li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="alert alert-secondary text-center">Este participante ainda não respondeu ao formulário "Sobre a Família".</div>
        <?php endif; ?>
        <!-- FIM DA SECÇÃO SOBRE A FAMÍLIA -->


        <hr class="my-5">

        <!-- ### INÍCIO DA NOVA SECÇÃO SOBRE CARREIRA ### -->
        <h3 class="mb-3">Formulário: Sobre Carreira</h3>
        <?php if ($dados_carreira): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">1. Informações Gerais da Carreira</h5></div>
                <div class="card-body">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Tempo como professor:</strong> <span><?php echo htmlspecialchars($dados_carreira['tempo_como_professor']); ?> anos</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Nº de alunos na maior turma:</strong> <span><?php echo htmlspecialchars($dados_carreira['numero_alunos_maior_turma']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Nº de alunos na menor turma:</strong> <span><?php echo htmlspecialchars($dados_carreira['numero_alunos_menor_turma']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Dispõe dos equipamentos necessários:</strong> <span><?php echo $dados_carreira['possui_equipamentos_necessarios'] ? 'Sim' : 'Não'; ?></span></li>
                         <?php if (!$dados_carreira['possui_equipamentos_necessarios'] && !empty($dados_carreira['equipamentos_desejados'])): ?>
                             <li class="list-group-item">
                                 <strong>Equipamentos desejados:</strong>
                                 <p class="mb-0 fst-italic ps-3">"<?php echo htmlspecialchars($dados_carreira['equipamentos_desejados']); ?>"</p>
                             </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <?php if ($trabalho_anterior): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">2. Trabalho Anterior à Docência</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Profissão:</strong> <span><?php echo htmlspecialchars($trabalho_anterior['nome_profissao']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Como exercia:</strong> <span><?php echo htmlspecialchars($trabalho_anterior['como_exercia']); ?></span></li>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($estabelecimentos)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">3. Estabelecimentos de Trabalho</h5></div>
                <div class="card-body p-0">
                    <?php foreach($estabelecimentos as $est): ?>
                        <div class="p-3 border-bottom">
                            <h6 class="fw-bold">
                                <i class="bi bi-building me-2"></i>Nome da Escola: <?php echo htmlspecialchars($est['nome_escola']); ?>
                            </h6>
                            <ul class="list-group list-group-flush mt-2">
                                <li class="list-group-item d-flex justify-content-between"><strong>Jornada de Trabalho Semanal:</strong> <span><?php echo htmlspecialchars($est['jornada_trabalho_semanal']); ?> horas</span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Tipo de Turma:</strong> <span><?php echo htmlspecialchars($est['tipo_turma']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Contexto Escolar:</strong> <span><?php echo htmlspecialchars($est['contexto_escolar']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Localização:</strong> <span><?php echo htmlspecialchars($est['localizacao_escola']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Dependência Adm.:</strong> <span><?php echo htmlspecialchars($est['dependencia_administrativa']); ?></span></li>
                                <li class="list-group-item d-flex justify-content-between"><strong>Situação Funcional:</strong> <span><?php echo htmlspecialchars($est['situacao_funcional']); ?></span></li>
                                <?php if (!empty($est['etapas'])): ?>
                                <li class="list-group-item">
                                    <strong>Etapas de atuação:</strong>
                                    <ul class="list-unstyled ps-3 mt-1">
                                    <?php foreach($est['etapas'] as $etapa): ?>
                                        <li>- <?php echo htmlspecialchars($etapa['nivel_etapa']); ?></li>
                                    <?php endforeach; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="alert alert-secondary text-center">Este participante ainda não respondeu ao formulário "Sobre Carreira".</div>
        <?php endif; ?>
        <!-- FIM DA SECÇÃO SOBRE CARREIRA -->


         <hr class="my-5">

        <!-- ### INÍCIO DA SECÇÃO SOBRE EXERCÍCIO DA PROFISSÃO ### -->
        <h3 class="mb-3">Formulário: Sobre o Exercício da Profissão</h3>
        <?php if ($dados_exercicio): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">1. Percepções Sobre a Docência</h5></div>
                <div class="card-body">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Docência como projeto de vida:</strong> <span><?php echo htmlspecialchars($dados_exercicio['docencia_como_projeto_vida']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Justificativa da escolha:</strong> <span><?php echo htmlspecialchars($dados_exercicio['justificativa_escolha_docencia']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Identificação com a docência:</strong> <span><?php echo htmlspecialchars($dados_exercicio['identificacao_docencia']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Gosta do que faz:</strong> <span><?php echo htmlspecialchars($dados_exercicio['gosta_do_trabalho']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Indicaria a profissão:</strong> <span><?php echo $dados_exercicio['indicaria_docencia'] ? 'Sim' : 'Não'; ?></span></li>
                        <?php if($dados_exercicio['indicaria_docencia'] == 0 && !empty($dados_exercicio['profissao_mudanca'])): ?>
                             <li class="list-group-item d-flex justify-content-between"><strong>Para qual profissão mudaria:</strong> <span><?php echo htmlspecialchars($dados_exercicio['profissao_mudanca']); ?></span></li>
                        <?php endif; ?>
                        <li class="list-group-item d-flex justify-content-between"><strong>O que mais causa prazer:</strong> <span><?php echo htmlspecialchars($dados_exercicio['causa_prazer_docencia']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>O que mais causa desgosto:</strong> <span><?php echo htmlspecialchars($dados_exercicio['causa_desgosto_docencia']); ?></span></li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">2. Condições de Trabalho</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Horas de planejamento semanal:</strong> <span><?php echo htmlspecialchars($dados_exercicio['horas_planejamento_semana']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Trabalha nos finais de semana:</strong> <span><?php echo $dados_exercicio['trabalha_final_semana'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Período mais trabalhoso do ano:</strong> <span><?php echo htmlspecialchars($dados_exercicio['periodo_trabalhoso_ano']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Grau de dedicação ao trabalho:</strong> <span><?php echo htmlspecialchars($dados_exercicio['grau_dedicacao_trabalho']); ?></span></li>
                         <li class="list-group-item d-flex justify-content-between"><strong>Relação com a diretoria:</strong> <span><?php echo htmlspecialchars($dados_exercicio['relacao_com_diretoria_escolar']); ?></span></li>
                    </ul>
                </div>
            </div>
            
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">3. Remuneração</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Salário recebido:</strong> <span><?php echo htmlspecialchars($dados_exercicio['salario_recebido']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Acha a remuneração justa:</strong> <span><?php echo htmlspecialchars($dados_exercicio['acha_remuneracao_justa']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Justificativa sobre a remuneração:</strong> <span><?php echo htmlspecialchars($dados_exercicio['justificativa_satisfacao_remuneracao']); ?></span></li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">4. Saúde e Bem-estar</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Já teve doença oriunda da docência:</strong> <span><?php echo $dados_exercicio['doenca_oriunda_docencia'] ? 'Sim' : 'Não'; ?></span></li>
                        <?php if($dados_exercicio['doenca_oriunda_docencia'] == 1 && !empty($dados_exercicio['descricao_doenca'])): ?>
                             <li class="list-group-item d-flex justify-content-between"><strong>Descrição da doença:</strong> <span><?php echo htmlspecialchars($dados_exercicio['descricao_doenca']); ?></span></li>
                        <?php endif; ?>
                         <li class="list-group-item d-flex justify-content-between"><strong>Reação a problemas profissionais:</strong> <span><?php echo htmlspecialchars($dados_exercicio['reacao_problema_profissional']); ?></span></li>
                         <li class="list-group-item d-flex justify-content-between"><strong>Sente-se acolhido(a) na escola:</strong> <span><?php echo $dados_exercicio['acolhido_em_problema_escolar'] ? 'Sim' : 'Não'; ?></span></li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">5. Ambiente Escolar e Segurança</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Existe programa de paz/diversidade:</strong> <span><?php echo $dados_exercicio['existe_programa_paz_diversidade'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Já sofreu agressão na escola:</strong> <span><?php echo $dados_exercicio['sofreu_agressao_na_escola'] ? 'Sim' : 'Não'; ?></span></li>
                        <?php if($dados_exercicio['sofreu_agressao_na_escola'] == 1 && !empty($dados_exercicio['providencia_tomada_agressao'])): ?>
                             <li class="list-group-item d-flex justify-content-between"><strong>Providência tomada (agressão):</strong> <span><?php echo htmlspecialchars($dados_exercicio['providencia_tomada_agressao']); ?></span></li>
                        <?php endif; ?>
                        <li class="list-group-item d-flex justify-content-between"><strong>Houve caso de bullying na sua turma:</strong> <span><?php echo $dados_exercicio['houve_caso_bullying'] ? 'Sim' : 'Não'; ?></span></li>
                        <?php if($dados_exercicio['houve_caso_bullying'] == 1 && !empty($dados_exercicio['providencia_tomada_bullying'])): ?>
                             <li class="list-group-item d-flex justify-content-between"><strong>Providência tomada (bullying):</strong> <span><?php echo htmlspecialchars($dados_exercicio['providencia_tomada_bullying']); ?></span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- ### SEÇÕES REVERTIDAS ### -->
            <?php if (!empty($beneficios_docencia)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">6. Benefícios Oriundos da Docência</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($beneficios_docencia as $beneficio): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($beneficio['identificacao_beneficio']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($beneficios_salario)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">7. Benefícios Além do Salário</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($beneficios_salario as $beneficio): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($beneficio['descricao_beneficio']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>

             <?php if (!empty($fontes_stress)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">8. Fontes de Stress</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($fontes_stress as $fonte): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($fonte['descricao_fonte']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="alert alert-secondary text-center">Este participante ainda não respondeu ao formulário "Sobre o Exercício da Profissão".</div>
        <?php endif; ?>
        <!-- FIM DA SECÇÃO SOBRE EXERCÍCIO DA PROFISSÃO -->

         <hr class="my-5">

        <!-- ### INÍCIO DA NOVA SECÇÃO SOBRE CONDIÇÃO DE ESTUDO ### -->
        <h3 class="mb-3">Formulário: Sobre Condição de Estudo</h3>
        <?php if ($dados_condicao_estudo): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">1. Hábitos de Estudo e Leitura</h5></div>
                <div class="card-body">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Onde estuda com mais frequência:</strong> <span><?php echo htmlspecialchars($dados_condicao_estudo['estuda_mais_frequencia']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Frequenta biblioteca:</strong> <span><?php echo $dados_condicao_estudo['frequenta_biblioteca'] ? 'Sim' : 'Não'; ?></span></li>
                        <?php if ($dados_condicao_estudo['frequenta_biblioteca']): ?>
                            <li class="list-group-item d-flex justify-content-between"><strong>Local da biblioteca:</strong> <span><?php echo htmlspecialchars($dados_condicao_estudo['local_biblioteca_frequentada']); ?></span></li>
                        <?php endif; ?>
                        <li class="list-group-item d-flex justify-content-between"><strong>Frequência de leitura de livros:</strong> <span><?php echo htmlspecialchars($dados_condicao_estudo['frequencia_leitura_livros']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Livros lidos este ano:</strong> <span><?php echo htmlspecialchars($dados_condicao_estudo['livros_lidos_este_ano']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Possui biblioteca particular:</strong> <span><?php echo $dados_condicao_estudo['possui_biblioteca_particular'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Quantidade estimada de livros:</strong> <span><?php echo htmlspecialchars($dados_condicao_estudo['quantidade_estimada_livros']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Tem sala própria para trabalho/estudo:</strong> <span><?php echo $dados_condicao_estudo['tem_sala_trabalho'] ? 'Sim' : 'Não'; ?></span></li>
                    </ul>
                </div>
            </div>

             <?php if (!empty($leituras_frequentes)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">2. Leituras Frequentes</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php foreach($leituras_frequentes as $leitura): ?>
                        <li class="list-group-item d-flex justify-content-between">
                           <span><?php echo htmlspecialchars($leitura['veiculo_lido']); ?></span>
                           <span class="badge bg-primary rounded-pill"><?php echo htmlspecialchars($leitura['frequencia_leitura']); ?></span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($categorias_livros)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">3. Categorias de Livros Preferidas</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($categorias_livros as $categoria): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($categoria['nome_categoria']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ultimos_livros)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">4. Últimos Livros que Gostou</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($ultimos_livros as $livro): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($livro['ordem_preferencia']); ?>º - <?php echo htmlspecialchars($livro['nome_livro']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">5. Acesso à Tecnologia</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Utiliza computador próprio:</strong> <span><?php echo $dados_condicao_estudo['utiliza_computador_proprio'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Frequência de conexão à internet:</strong> <span><?php echo htmlspecialchars($dados_condicao_estudo['frequencia_conexao_internet']); ?></span></li>
                        <?php if (!empty($acesso_internet)): ?>
                        <li class="list-group-item">
                            <strong>Locais de acesso à internet:</strong>
                            <ul class="list-unstyled ps-3 mt-1">
                            <?php foreach($acesso_internet as $acesso): ?>
                                <li>- <?php echo htmlspecialchars($acesso['local_acesso']); ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-secondary text-center">Este participante ainda não respondeu ao formulário "Sobre Condição de Estudo".</div>
        <?php endif; ?>
        <!-- FIM DA SECÇÃO SOBRE CONDIÇÃO DE ESTUDO -->

        <hr class="my-5">

        <!-- ### INÍCIO DA NOVA SECÇÃO SOBRE VIDA GERAL ### -->
        <h3 class="mb-3">Formulário: Sobre Vida Geral</h3>
        <?php if ($dados_vida_geral): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">1. Saúde e Hábitos</h5></div>
                <div class="card-body">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Situação da saúde:</strong> <span><?php echo htmlspecialchars($dados_vida_geral['situacao_saude']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Tem doença crônica:</strong> <span><?php echo $dados_vida_geral['tem_doenca_cronica'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Tem plano de saúde:</strong> <span><?php echo $dados_vida_geral['tem_plano_saude'] ? 'Sim' : 'Não'; ?></span></li>
                        <?php if ($dados_vida_geral['tem_plano_saude']): ?>
                            <li class="list-group-item d-flex justify-content-between"><strong>Qual plano:</strong> <span><?php echo htmlspecialchars($dados_vida_geral['plano_saude']); ?></span></li>
                        <?php endif; ?>
                        <li class="list-group-item d-flex justify-content-between"><strong>Altura (cm):</strong> <span><?php echo htmlspecialchars($dados_vida_geral['altura']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Peso (kg):</strong> <span><?php echo htmlspecialchars($dados_vida_geral['peso']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Já foi internado(a):</strong> <span><?php echo $dados_vida_geral['foi_internado_hospital'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Bebe álcool:</strong> <span><?php echo $dados_vida_geral['bebe_alcool'] ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Usa cigarro:</strong> <span><?php echo $dados_vida_geral['usa_cigarro'] ? 'Sim' : 'Não'; ?></span></li>
                         <?php if ($dados_vida_geral['usa_cigarro']): ?>
                            <li class="list-group-item d-flex justify-content-between"><strong>Cigarros por dia:</strong> <span><?php echo htmlspecialchars($dados_vida_geral['quantidade_cigarros_dia']); ?></span></li>
                        <?php endif; ?>
                        <li class="list-group-item d-flex justify-content-between"><strong>Tem alimentação equilibrada:</strong> <span><?php echo $dados_vida_geral['tem_alimentacao_equilibrada'] ? 'Sim' : 'Não'; ?></span></li>
                    </ul>
                </div>
            </div>

            <?php if (!empty($razoes_alimentacao)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">2. Razões para Alimentação Desequilibrada</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($razoes_alimentacao as $razao): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($razao['descricao_razao']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>

             <?php if (!empty($frequencia_bebidas)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">3. Frequência de Consumo de Bebidas Alcoólicas</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php foreach($frequencia_bebidas as $bebida): ?>
                        <li class="list-group-item d-flex justify-content-between">
                           <span><?php echo htmlspecialchars($bebida['bebida']); ?></span>
                           <span class="badge bg-info rounded-pill"><?php echo htmlspecialchars($bebida['nivel_frequencia']); ?></span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($atividades_fora_trabalho)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">4. Atividades Fora do Trabalho</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($atividades_fora_trabalho as $atividade): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($atividade['descricao_atividade']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>

             <?php if (!empty($problemas_semanas)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">5. Problemas nas Últimas Semanas</h5></div>
                <div class="card-body"><ul class="list-group list-group-flush">
                    <?php foreach($problemas_semanas as $problema): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($problema['descricao_problema']); ?></li>
                    <?php endforeach; ?>
                </ul></div>
            </div>
            <?php endif; ?>
            
            <div class="card shadow-sm mb-4">
                <div class="card-header"><h5 class="mb-0">6. Comentários Finais</h5></div>
                <div class="card-body">
                    <p class="mb-1"><strong>O que mais gosta de fazer:</strong></p>
                    <p class="fst-italic ps-3">"<?php echo htmlspecialchars($dados_vida_geral['gosta_fazer']); ?>"</p>

                    <p class="mb-1"><strong>Comentário sobre a pesquisa:</strong></p>
                    <p class="fst-italic ps-3 mb-0">"<?php echo htmlspecialchars($dados_vida_geral['comentario_pesquisa']); ?>"</p>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-secondary text-center">Este participante ainda não respondeu ao formulário "Sobre Vida Geral".</div>
        <?php endif; ?>
        <!-- FIM DA SECÇÃO SOBRE VIDA GERAL -->

    </div>

    

</body>
</html>