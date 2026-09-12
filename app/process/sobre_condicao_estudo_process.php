<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if(!isset($_SESSION['id_participante'])){
//     header("Location: /pesquisa_educacional/index.php");
//     exit;
// }

// $_SESSION['id_participante'] = 1;

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/SobreCondicaoEstudoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/LeituraFrequenteController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/UltimoLivroGostadoController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/CategoriaLivroFrequenteController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/sobre_condicao_estudo/AcessoInternetController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/controler/UserParticipanteControler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        # Dados da tabela principal 'SobreCondicaoEstudo'
        $valores_sobre_condicao_estudo = [
            'participante_id' => $_SESSION['id_participante'],
            'estuda_mais_frequencia' => $_POST['estuda_mais_frequencia'] ?? null,
            'frequenta_biblioteca' => $_POST['frequenta_biblioteca'] ?? null,
            'local_biblioteca_frequentada' => $_POST['local_biblioteca_frequentada'] ?? null,
            'frequencia_leitura_livros' => $_POST['frequencia_leitura_livros'] ?? null,
            'livros_lidos_este_ano' => $_POST['livros_lidos_este_ano'] ?? null,
            'possui_biblioteca_particular' => $_POST['possui_biblioteca_particular'] ?? null,
            'tem_sala_trabalho' => $_POST['tem_sala_trabalho'] ?? null,
            'quantidade_estimada_livros' => $_POST['quantidade_estimada_livros'] ?? null,
            'utiliza_computador_proprio' => $_POST['utiliza_computador_proprio'] ?? null,
            'frequencia_conexao_internet' => $_POST['frequencia_conexao_internet'] ?? null,
        ];

        # Persistindo tabela principal 'SobreCondicaoEstudo'
        $sobre_condicao_estudo_controller = new SobreCondicaoEstudoController($_SESSION['id_participante']);
        $id_insercao_sobre_condicao_estudo = $sobre_condicao_estudo_controller->cadastrarDadosSobreCondicaoEstudo($valores_sobre_condicao_estudo);

        if (!$id_insercao_sobre_condicao_estudo) {
            throw new Exception("Erro ao cadastrar dados sobre condição de estudo");
        }

        $registros_secundarios_cadastrados = 0;

        # Persistindo tabela 'LeituraFrequente'
        if (isset($_POST['leitura_frequente']) && is_array($_POST['leitura_frequente']) && !empty($_POST['leitura_frequente'])) {
            $leitura_frequente_controller = new LeituraFrequenteController($id_insercao_sobre_condicao_estudo);

            foreach ($_POST['leitura_frequente'] as $leitura) {
                if (
                    isset($leitura['veiculo_lido'], $leitura['frequencia_leitura']) &&
                    !empty(trim($leitura['veiculo_lido'])) && !empty(trim($leitura['frequencia_leitura']))
                ) {

                    $valores_leitura_frequente = [
                        'sobre_condicao_estudo_id' => $id_insercao_sobre_condicao_estudo,
                        'veiculo_lido' => trim($leitura['veiculo_lido']),
                        'frequencia_leitura' => trim($leitura['frequencia_leitura']),
                    ];

                    $resultado_leitura = $leitura_frequente_controller->cadastrarDadosLeituraFrequente($valores_leitura_frequente);

                    if (!$resultado_leitura) {
                        throw new Exception("Erro ao cadastrar leitura frequente");
                    }
                }
            }
            $registros_secundarios_cadastrados++;
        }

        # Persistindo tabela 'UltimoLivroGostado'
        if (isset($_POST['ultimo_livro_gostado']) && is_array($_POST['ultimo_livro_gostado']) && !empty($_POST['ultimo_livro_gostado'])) {
            $ultimo_livro_gostado_controller = new UltimoLivroGostadoController($id_insercao_sobre_condicao_estudo);

            foreach ($_POST['ultimo_livro_gostado'] as $livro) {
                if (
                    isset($livro['ordem_preferencia'], $livro['nome_livro']) &&
                    !empty(trim($livro['ordem_preferencia'])) && !empty(trim($livro['nome_livro']))
                ) {

                    $valores_ultimo_livro = [
                        'sobre_condicao_estudo_id' => $id_insercao_sobre_condicao_estudo,
                        'ordem_preferencia' => trim($livro['ordem_preferencia']),
                        'nome_livro' => trim($livro['nome_livro']),
                    ];

                    $resultado_livro = $ultimo_livro_gostado_controller->cadastrarDadosUltimoLivroGostado($valores_ultimo_livro);

                    if (!$resultado_livro) {
                        throw new Exception("Erro ao cadastrar último livro que gostou");
                    }
                }
            }
            $registros_secundarios_cadastrados++;
        }

        # Persistindo tabela 'CategoriaLivroFrequente'
        if (isset($_POST['categoria_livro_frequente']) && is_array($_POST['categoria_livro_frequente']) && !empty($_POST['categoria_livro_frequente'])) {
            $categoria_livro_controller = new CategoriaLivroFrequenteController($id_insercao_sobre_condicao_estudo);

            foreach ($_POST['categoria_livro_frequente'] as $categoria) {
                if (!empty(trim($categoria))) {
                    $valores_categoria_livro = [
                        'sobre_condicao_estudo_id' => $id_insercao_sobre_condicao_estudo,
                        'nome_categoria' => trim($categoria),
                    ];

                    $resultado_categoria = $categoria_livro_controller->cadastrarDadosCategoriaLivroFrequente($valores_categoria_livro);

                    if (!$resultado_categoria) {
                        throw new Exception("Erro ao cadastrar categoria de livro frequente");
                    }
                }
            }
            $registros_secundarios_cadastrados++;
        }

        # Persistindo tabela 'AcessoInternet'
        if (isset($_POST['local_acesso_internet']) && is_array($_POST['local_acesso_internet']) && !empty($_POST['local_acesso_internet'])) {
            $acesso_internet_controller = new AcessoInternetController($id_insercao_sobre_condicao_estudo);

            foreach ($_POST['local_acesso_internet'] as $local) {
                if (!empty(trim($local))) {
                    $valores_acesso_internet = [
                        'sobre_condicao_estudo_id' => $id_insercao_sobre_condicao_estudo,
                        'local_acesso' => trim($local),
                    ];

                    $resultado_acesso = $acesso_internet_controller->cadastrarDadosAcessoInternet($valores_acesso_internet);

                    if (!$resultado_acesso) {
                        throw new Exception("Erro ao cadastrar local de acesso à internet");
                    }
                }
            }
            $registros_secundarios_cadastrados++;
        }

        # Próximo passo: progresso 7 = vida geral
        $user_participante_controler = new UserParticipanteControler();
        $atualizacao_progresso = $user_participante_controler->atualizarProgressoParticipante($_SESSION['id_participante'], 7);
        if (!$atualizacao_progresso) {
            echo "erro ao atualizar o progresso do participante";
            exit;
        }

        # Redirecionamento automático para próximo formulário
        header("Location: /pesquisa_educacional/views/formularios/formulario_sobre_vida_geral.php");
        exit;

    } catch (Exception $e) {
        error_log("Erro no cadastro de condições de estudo: " . $e->getMessage());
        $_SESSION['erro_message'] = "Erro ao processar dados: " . $e->getMessage();
        header("Location: /pesquisa_educacional/views/sobre_condicao_estudo.php?erro=1");
        exit;
    }
} else {
    http_response_code(405);
    echo "Método não permitido";
}
