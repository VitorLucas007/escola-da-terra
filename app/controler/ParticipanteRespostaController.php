<?php

// Inclui todos os controllers necessários para a busca de dados
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';
// Formulário 1
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/SobreCursistaControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/CompartilhamentoResidenciaControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_cursista/OpiniaoTemaSobreCursistaControler.php';
// Formulário 2
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/SobreFamiliaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoFilhoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoIrmaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoGenitorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_familia/InformacaoAvosController.php';
// Formulário 3
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_formacao_escolar/SobreFormacaoEscolarController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_formacao_escolar/FormacaoBasicaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_formacao_escolar/FormacaoSuperiorController.php';
// Formulário 4
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/SobreCarreiraController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/TrabalhoAnteriorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_carreira/EstabelecimentoTrabalhoController.php';
// Formulário 5
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/SobreExercicioProfissaoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/FonteStressController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/BeneficioRecebidoSalarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_exercicio_profissao/BeneficioOriundoAtividadeDocenciaController.php'; 
// Formulário 6
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/SobreCondicaoEstudoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/LeituraFrequenteController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/UltimoLivroGostadoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/CategoriaLivroFrequenteController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/AcessoInternetController.php';
// Formulário 7
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/SobreVidaGeralController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/FrequenciaBebidaAlcoolicaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/RazaoAlimentacaoDesequilibradaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/ProblemaUltimasSemanasController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_vida_geral/AtividadeForaTrabalhoController.php';


class ParticipanteResponseController {
    private $participante_id;

    public function __construct($participante_id) {
        $this->participante_id = $participante_id;
    }

    // Método principal que agrega todos os dados
    public function obterDadosCompletos() {
        return [
            'participante' => $this->obterDadosParticipante(),
            'cursista' => $this->obterDadosCursista(),
            'familia' => $this->obterDadosFamilia(),
            'formacao' => $this->obterDadosFormacao(),
            'carreira' => $this->obterDadosCarreira(),
            'exercicio' => $this->obterDadosExercicio(),
            'condicao_estudo' => $this->obterDadosCondicaoEstudo(),
            'vida_geral' => $this->obterDadosVidaGeral(),
        ];
    }

    private function obterDadosParticipante() {
        $participanteController = new UserParticipanteControler();
        return $participanteController->buscarParticipantePorId($this->participante_id);
    }

    // Formulário 1: Sobre o Cursista
    private function obterDadosCursista() {
        $sobreCursistaController = new SobreCursistaControler();
        $dados_cursista = $sobreCursistaController->buscarCursistaPorParticipanteId($this->participante_id);
        
        $resultado = ['dados' => $dados_cursista, 'compartilhamentos' => [], 'opinioes' => []];
        
        if ($dados_cursista) {
            $id_cursista = $dados_cursista['id_informacao_cursista'];
            $compController = new CompartilhamentoResidenciaControler($id_cursista);
            $resultado['compartilhamentos'] = $compController->buscarCompartilhamentosPorCursistaId($id_cursista);
            
            $opiniaoController = new OpiniaoTemaSobreCursistaControler($id_cursista);
            $resultado['opinioes'] = $opiniaoController->buscarOpinioesPorCursistaId($id_cursista);
        }
        return $resultado;
    }

    // Formulário 2: Sobre a Família
    private function obterDadosFamilia() {
        $sobreFamiliaController = new SobreFamiliaController(null);
        $dados_familia = $sobreFamiliaController->buscarSobreFamiliaPorParticipanteId($this->participante_id);

        $resultado = ['dados' => $dados_familia, 'filhos' => [], 'irmaos' => [], 'genitores' => [], 'avos' => []];

        if ($dados_familia) {
            $id_familia = $dados_familia['id_informacao_familiares'];
            $filhoController = new InformacaoFilhoController($id_familia);
            $resultado['filhos'] = $filhoController->buscarFilhosComDetalhesPorFamiliaId($id_familia);

            $irmaoController = new InformacaoIrmaoController($id_familia);
            $resultado['irmaos'] = $irmaoController->buscarIrmaosPorFamiliaId($id_familia);
            
            $genitorController = new InformacaoGenitorController($id_familia);
            $resultado['genitores'] = $genitorController->buscarGenitoresPorFamiliaId($id_familia);
            
            $avosController = new InformacaoAvosController($id_familia);
            $resultado['avos'] = $avosController->buscarAvosPorFamiliaId($id_familia);
        }
        return $resultado;
    }
    
    // Formulário 3: Sobre Formação Escolar
    private function obterDadosFormacao() {
        $formacaoController = new SobreFormacaoEscolarController(null);
        $dados_formacao = $formacaoController->buscarSobreFormacaoPorParticipanteId($this->participante_id);
        
        $resultado = ['dados' => $dados_formacao, 'formacao_basica' => [], 'formacao_superior' => []];
        
        if ($dados_formacao) {
            $id_formacao = $dados_formacao['id_informacao_formacao_escolar'];
            $basicaController = new FormacaoBasicaController($id_formacao);
            $resultado['formacao_basica'] = $basicaController->buscarFormacaoBasicaPorId($id_formacao);
            
            $superiorController = new FormacaoSuperiorController($id_formacao);
            $resultado['formacao_superior'] = $superiorController->buscarFormacaoSuperiorPorId($id_formacao);
        }
        return $resultado;
    }
    
    // Formulário 4: Sobre Carreira
    private function obterDadosCarreira() {
        $carreiraController = new SobreCarreiraController(null);
        $dados_carreira = $carreiraController->buscarSobreCarreiraPorParticipanteId($this->participante_id);

        $resultado = ['dados' => $dados_carreira, 'trabalho_anterior' => null, 'estabelecimentos' => []];

        if ($dados_carreira) {
            $id_carreira = $dados_carreira['id_informacao_carreira'];
            $trabalhoController = new TrabalhoAnteriorController($id_carreira);
            $resultado['trabalho_anterior'] = $trabalhoController->buscarTrabalhoAnteriorPorCarreiraId($id_carreira);

            $estController = new EstabelecimentoTrabalhoController($id_carreira);
            $resultado['estabelecimentos'] = $estController->buscarEstabelecimentosPorCarreiraId($id_carreira);
        }
        return $resultado;
    }

    // Formulário 5: Sobre Exercício da Profissão
    private function obterDadosExercicio() {
        $exercicioController = new SobreExercicioProfissaoController(null);
        $dados_exercicio = $exercicioController->buscarExercicioProfissaoPorParticipanteId($this->participante_id);
        
        $resultado = ['dados' => $dados_exercicio, 'fontes_stress' => [], 'beneficios_salario' => [], 'beneficios_docencia' => []];
        
        if ($dados_exercicio) {
            $id_exercicio = $dados_exercicio['id_informacao_exercicio_profissao'];
            $stressController = new FonteStressController($id_exercicio);
            $resultado['fontes_stress'] = $stressController->buscarFontesStressPorExercicioId($id_exercicio);

            $benSalarioController = new BeneficioRecebidoSalarioController($id_exercicio);
            $resultado['beneficios_salario'] = $benSalarioController->buscarBeneficiosSalarioPorExercicioId($id_exercicio);
            
            $benDocenciaController = new BeneficioOriundoAtividadeDocenciaController($id_exercicio);
            $resultado['beneficios_docencia'] = $benDocenciaController->buscarBeneficiosDocenciaPorExercicioId($id_exercicio);
        }
        return $resultado;
    }

    // Formulário 6: Sobre Condição de Estudo
    private function obterDadosCondicaoEstudo() {
        $condicaoController = new SobreCondicaoEstudoController(null);
        $dados_condicao = $condicaoController->buscarCondicaoEstudoPorParticipanteId($this->participante_id);
        
        $resultado = ['dados' => $dados_condicao, 'leitura_frequente' => [], 'ultimos_livros' => [], 'categorias_livros' => [], 'acesso_internet' => []];

        if ($dados_condicao) {
            $id_condicao = $dados_condicao['id_informacao_condicao_estudo'];
            $leituraController = new LeituraFrequenteController($id_condicao);
            $resultado['leitura_frequente'] = $leituraController->buscarLeiturasPorCondicaoEstudoId($id_condicao);

            $livrosController = new UltimoLivroGostadoController($id_condicao);
            $resultado['ultimos_livros'] = $livrosController->buscarLivrosPorCondicaoEstudoId($id_condicao);

            $catController = new CategoriaLivroFrequenteController($id_condicao);
            $resultado['categorias_livros'] = $catController->buscarCategoriasPorCondicaoEstudoId($id_condicao);

            $internetController = new AcessoInternetController($id_condicao);
            $resultado['acesso_internet'] = $internetController->buscarAcessoInternetPorCondicaoEstudoId($id_condicao);
        }
        return $resultado;
    }
    
    // Formulário 7: Sobre Vida Geral
    private function obterDadosVidaGeral() {
        $vidaGeralController = new SobreVidaGeralController(null);
        $dados_vida = $vidaGeralController->buscarSobreVidaGeralPorParticipanteId($this->participante_id);
        
        $resultado = ['dados' => $dados_vida, 'frequencia_bebidas' => [], 'razoes_alimentacao' => [], 'problemas_semanas' => [], 'atividades_fora_trabalho' => []];

        if ($dados_vida) {
            $id_vida = $dados_vida['id_sobre_vida_geral'];
            $bebidaController = new FrequenciaBebidaAlcoolicaController($id_vida);
            $resultado['frequencia_bebidas'] = $bebidaController->buscarFrequenciasBebidaPorVidaGeralId($id_vida);

            $razaoController = new RazaoAlimentacaoDesequilibradaController($id_vida);
            $resultado['razoes_alimentacao'] = $razaoController->buscarRazoesAlimentacaoPorVidaGeralId($id_vida);

            $problemaController = new ProblemaUltimasSemanasController($id_vida);
            $resultado['problemas_semanas'] = $problemaController->buscarProblemasPorVidaGeralId($id_vida);

            $atividadeController = new AtividadeForaTrabalhoController($id_vida);
            $resultado['atividades_fora_trabalho'] = $atividadeController->buscarAtividadesPorVidaGeralId($id_vida);
        }
        return $resultado;
    }
}