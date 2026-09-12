<?php
/**
 * SCRIPT DE TESTE DE INTEGRAÇÃO - FLUXO COMPLETO
 * Este script envia dados via cURL para os seus arquivos process, 
 * simulando o preenchimento de todos os formulários.
 */

function enviarDados($url, $dados) {
    $url_completa = "http://" . $_SERVER['HTTP_HOST'] . "/pesquisa_educacional/app/process/" . $url;
    
    $ch = curl_init($url_completa);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dados));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); // Não segue o redirecionamento para podermos ver o resultado
    
    // Simula a sessão (id_participante = 1) - Ajuste se sua sessão for diferente
    curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=' . session_id()); 

    $resposta = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ['code' => $http_code, 'body' => $resposta];
}

session_start();
$_SESSION['id_participante'] = 1; // ID do participante que deve existir no banco

echo "<h1>Iniciando Teste de Carga de Dados</h1>";

// 1. SOBRE CURSISTA
$dados_cursista = [
    'ano_nascimento' => '1990',
    'sexo' => 'Feminino',
    'estado_naturalidade' => 'SP',
    'municipio_naturalidade' => 'São Paulo',
    'estado_reside_atualmente' => 'SP',
    'municipio_reside_atualmente' => 'São Paulo',
    'anos_reside_atualmente' => 10,
    'residencia_propria' => 1,
    'tem_filhos' => 1,
    'estado_civil' => 'Casado(a)',
    'transporte_frequente' => 'Ônibus',
    'tem_religiao' => 1,
    'tem_opcao_partidaria' => 0,
    'escala_politica_esquerda_direita' => 5,
    'compartilha_com' => ['Cônjuge', 'Filhos'],
    'opiniao_religiao' => 'Opinião teste religião',
    'opiniao_politica' => 'Opinião teste política'
];
$res = enviarDados('sobre_cursista_process.php', $dados_cursista);
echo "Sobre Cursista: " . ($res['code'] == 302 ? "✅ Sucesso (Redirecionou)" : "❌ Erro") . "<br>";

// 2. SOBRE FAMÍLIA
$dados_familia = [
    'possui_filhos' => 1,
    'quantidade_irmaos' => 2,
    'escolaridade_mae' => 'Ensino medio',
    'profissao_mae' => 'Aposentada',
    'escolaridade_avo_masc_materno' => 'Fundamental menor',
    'escolaridade_avo_fem_materno' => 'Fundamental menor',
    'religiao_avos_maternos' => 'Católica'
];
$res = enviarDados('sobre_familia_process.php', $dados_familia);
echo "Sobre Família: " . ($res['code'] == 302 ? "✅ Sucesso" : "❌ Erro") . "<br>";

// 3. FORMAÇÃO ESCOLAR
$dados_formacao = [
    'quantidade_cursos_graduacao' => 1,
    'quantidade_especializacoes' => 1,
    'fez_curso_aperfeicoamento' => 1,
    'nivel_formacao_basica' => 'Ensino medio',
    'tipo_escola_basica' => 'Publica',
    'ano_conclusao_basica' => 2008,
    'curso_graduacao' => 'Pedagogia',
    'nome_instituicao_graduacao' => 'Universidade Teste',
    'ano_inicio_graduacao' => 2010,
    'ano_conclusao_graduacao' => 2014
];
$res = enviarDados('sobre_formacao_escolar_process.php', $dados_formacao);
echo "Formação Escolar: " . ($res['code'] == 302 ? "✅ Sucesso" : "❌ Erro") . "<br>";

// 4. CARREIRA
$dados_carreira = [
    'exercia_trabalho_anteriormente' => 0,
    'exerce_atividade_paralela' => 0,
    'tempo_como_professor' => 8,
    'nome_escola' => 'Escola Municipal 123',
    'jornada_trabalho_semanal' => 40,
    'situacao_funcional' => 'Estatutário',
    'contexto_escolar' => 'Urbano'
];
$res = enviarDados('sobre_carreira_process.php', $dados_carreira);
echo "Sobre Carreira: " . ($res['code'] == 302 ? "✅ Sucesso" : "❌ Erro") . "<br>";

// 5. EXERCÍCIO DA PROFISSÃO
$dados_exercicio = [
    'docencia_como_projeto_vida' => 1,
    'horas_planejamento_semana' => 10,
    'gosta_do_trabalho' => 'Sim',
    'salario_recebido' => '3 salarios minimos',
    'acha_remuneracao_justa' => 0,
    'fontes_stress' => ['Excesso de alunos', 'Baixo salário']
];
$res = enviarDados('sobre_exercicio_profissao_process.php', $dados_exercicio);
echo "Exercício Profissão: " . ($res['code'] == 302 ? "✅ Sucesso" : "❌ Erro") . "<br>";

// 6. CONDIÇÃO DE ESTUDO
$dados_estudo = [
    'estuda_mais_frequencia' => 'Em casa',
    'livros_lidos_este_ano' => 4,
    'possui_biblioteca_particular' => 1,
    'frequencia_conexao_internet' => 'Todos os dias',
    'local_acesso_internet' => ['Casa', 'Escola']
];
$res = enviarDados('sobre_condicao_estudo_process.php', $dados_estudo);
echo "Condição Estudo: " . ($res['code'] == 302 ? "✅ Sucesso" : "❌ Erro") . "<br>";

// 7. VIDA GERAL
$dados_vida = [
    'situacao_saude' => 'Muito boa',
    'altura' => '1.70',
    'peso' => '70.5',
    'bebe_alcool' => 0,
    'usa_cigarro' => 'Jamais',
    'atividades_fora_trabalho' => ['Caminhada', 'Cinema']
];
$res = enviarDados('sobre_vida_geral_process.php', $dados_vida);
echo "Vida Geral: " . ($res['code'] == 302 ? "✅ Sucesso" : "❌ Erro") . "<br>";

echo "<p>Verifique o banco de dados agora para confirmar os registros!</p>";