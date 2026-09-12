<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } 

    if(!isset($_SESSION['id_participante'])){
        header("Location: /pesquisa_educacional/index.php");
        exit;
    }

    # Armazenando a ultima página logada para poder rastrear em casos de redirecionamento para página de erro:
    $_SESSION['ultima_pagina'] = $_SERVER['REQUEST_URI'];
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Informações sobre exercicio da profissão</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/css/sobre_carreira.css">
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php';
    ?>
</head>

<body>
    
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php';
    ?> 

    <div class="container">

        <h2 class="text-center mb-4 mt-4 p-2 fw-bold">Informações sobre o exercicio da Profissão</h2>

        <form class="form-container"  method="post" action="../../app/process/sobre_exercicio_profissao_process.php">

            <div class="row mb-4">

                <div class="col-md-6">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tornar-se docente era o seu projeto de vida?</label>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="docencia_como_projeto_vida" id="docencia_projeto_sim" value="1" required>
                            <label class="form-check-label" for="docencia_projeto_sim">Sim</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="docencia_como_projeto_vida" id="docencia_projeto_nao" value="0">
                            <label class="form-check-label" for="docencia_projeto_nao">Não</label>
                        </div>

                        <div class="mt-1">
                            <label for="justificativa_escolha_docencia" class="form-label">Por quê?</label>
                            <textarea class="form-control" id="justificativa_escolha_docencia" name="justificativa_escolha_docencia" rows="3" required  ></textarea>
                        </div>
                    
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Como você qualificaria a docência?</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="identificacao_docencia" id="docencia_apaixonante" value="Apaixonante" required>
                            <label class="form-check-label" for="docencia_apaixonante">Apaixonante</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="identificacao_docencia" id="docencia_interessante" value="Interessante">
                            <label class="form-check-label" for="docencia_interessante">Interessante</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="identificacao_docencia" id="docencia_pouco_motivante" value="Pouco motivante">
                            <label class="form-check-label" for="docencia_pouco_motivante">Pouco motivante</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="identificacao_docencia" id="docencia_desencorajadora" value="Desencorajadora">
                            <label class="form-check-label" for="docencia_desencorajadora">Desencorajadora</label>
                        </div>
                    </div>
                                    
                </div>

            </div>

            <div class="row mb-4">

                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="horas_planejamento" class="form-label fw-bold">
                            Quantas horas por semana você dedica, fora das horas de ensino, para o planejamento pedagógico
                            <small class="text-muted d-block">(todo trabalho específico diretamente ligado ao ensino)</small>
                        </label>
                        <input type="number" class="form-control" id="horas_planejamento" name="horas_planejamento_semana" min="0" required placeholder="Ex: 10">
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Você trabalha durante o final de semana?</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trabalha_final_semana" id="final_semana_sempre" value="Sempre" required>
                            <label class="form-check-label" for="final_semana_sempre">Sempre</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trabalha_final_semana" id="final_semana_frequentemente" value="Frequentemente">
                            <label class="form-check-label" for="final_semana_frequentemente">Frequentemente</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trabalha_final_semana" id="final_semana_de_vez_em_quando" value="De vez em quando">
                            <label class="form-check-label" for="final_semana_de_vez_em_quando">De vez em quando</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trabalha_final_semana" id="final_semana_raramente" value="Raramente">
                            <label class="form-check-label" for="final_semana_raramente">Raramente</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trabalha_final_semana" id="final_semana_jamais" value="Jamais">
                            <label class="form-check-label" for="final_semana_jamais">Jamais</label>
                        </div>
                    </div>
                </div>
            
            </div>
            
            <div class="row mb-4">

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Em qual período do ano você considera que trabalha com maior intensidade/que você trabalha mais?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="periodo_trabalhoso_ano" id="inicio_ano" value="Inicio de ano" required>
                            <label class="form-check-label" for="inicio_ano">Início de ano</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="periodo_trabalhoso_ano" id="fim_trimestre" value="Fim de trimestre">
                            <label class="form-check-label" for="fim_trimestre">Fim de trimestre</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="periodo_trabalhoso_ano" id="fim_ano" value="Fim de ano">
                            <label class="form-check-label" for="fim_ano">Fim de ano</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="periodo_trabalhoso_ano" id="todo_tempo" value="Todo o tempo">
                            <label class="form-check-label" for="todo_tempo">Todo o tempo</label>
                        </div>
                    
                    </div>
                
                </div>

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Você já teve algum problema de saúde que possa ser relacionado com o exercício da docência?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="teve_doenca_docencia" name="doenca_oriunda_docencia" value="1" required>
                            <label class="form-check-label" for="teve_doenca_docencia">Sim</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="nao_teve_doenca_docencia" name="doenca_oriunda_docencia" value="0">
                            <label class="form-check-label" for="teve_doenca_docencia">Não</label>
                        </div>
                        
                        <div class="mt-2" id="campo_qual_doenca" style="display: none;">
                            <label for="descricao_doenca" class="form-label">Qual?</label>
                            <input type="text" class="form-control" name="descricao_doenca" id="descricao_doenca" maxlength="60">
                        </div>
                    
                    </div>
                
                </div>

            </div>

            <div class="row mb-4">

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Desde que iniciou suas atividades de docência, você foi beneficiado(a) com a realização de:
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="formacao_continuada" name="identificacao_beneficio[]" value="Formação continuada">
                            <label class="form-check-label" for="formacao_continuada">Formação continuada</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="curso_aperfeicoamento" name="identificacao_beneficio[]" value="Curso de Aperfeiçoamento">
                            <label class="form-check-label" for="curso_aperfeicoamento">Curso de Aperfeiçoamento</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="nenhuma_formacao" name="identificacao_beneficio[]" value="Nenhuma formação">
                            <label class="form-check-label" for="nenhuma_formacao">Nenhuma formação</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="outra_formacao" name="identificacao_beneficio_outra" value="Outra">
                            <label class="form-check-label" for="outra_formacao">Outra</label>
                        </div>

                        <div id="campo_outro_beneficio" style="display: none;">
                            <input type="text" class="form-control" name="identificacao_beneficio[]" id="beneficio_docencia_outro" placeholder="Descreva aqui">
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você gosta de seu trabalho?</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gosta_do_trabalho" id="gosta_geral" value="Sim, em seu conjunto" required>
                            <label class="form-check-label" for="gosta_geral">Sim, em seu conjunto</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gosta_do_trabalho" id="gosta_depende" value="Sim, mas depende da atividade">
                            <label class="form-check-label" for="gosta_depende">Sim, mas depende da atividade</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gosta_do_trabalho" id="gosta_dificil" value="Sim, mas é difícil">
                            <label class="form-check-label" for="gosta_dificil">Sim, mas é difícil</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gosta_do_trabalho" id="nao_neste_momento" value="Não. Não neste momento">
                            <label class="form-check-label" for="nao_neste_momento">Não. Não neste momento</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gosta_do_trabalho" id="nao_dificil" value="Não. Ele se tornou muito difícil">
                            <label class="form-check-label" for="nao_dificil">Não. Ele se tornou muito difícil</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gosta_do_trabalho" id="nao_mudaria" value="Não. Se pudesse eu mudaria de atividade">
                            <label class="form-check-label" for="nao_mudaria">Não. Se pudesse eu mudaria de atividade</label>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row mb-4">

                <div class="col-md-6">
                    
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Ser professor é uma opção profissional que você indicaria para familiares, amigos, filhos ou mesmo aos seus alunos?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="indicaria_docencia" id="indicaria_totalmente" value="Sim, totalmente" required>
                            <label class="form-check-label" for="indicaria_totalmente">Sim, totalmente</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="indicaria_docencia" id="indicaria_com_ressalvas" value="Sim, mas com ressalvas">
                            <label class="form-check-label" for="indicaria_com_ressalvas">Sim, mas com ressalvas</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="indicaria_docencia" id="indicaria_menos_hoje" value="Sim, mas menos hoje em dia">
                            <label class="form-check-label" for="indicaria_menos_hoje">Sim, mas menos hoje em dia</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="indicaria_docencia" id="nao_absolutamente" value="Não, absolutamente">
                            <label class="form-check-label" for="nao_absolutamente">Não, absolutamente</label>
                        </div>
                    
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Quando você encontra alguém, você informa sua profissão?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="informa_profissao" id="informa_sem_problema" value="Sim, sem problema" required>
                            <label class="form-check-label" for="informa_sem_problema">Sim, sem problema</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="informa_profissao" id="informa_depende" value="Sim, mas depende do contexto">
                            <label class="form-check-label" for="informa_depende">Sim, mas depende do contexto</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="informa_profissao" id="nao_entrar_detalhe" value="Não, procuro não entrar nesse detalhe">
                            <label class="form-check-label" for="nao_entrar_detalhe">Não, procuro não entrar nesse detalhe</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="informa_profissao" id="nao_evito" value="Não, eu evito">
                            <label class="form-check-label" for="nao_evito">Não, eu evito</label>
                        </div>
                    
                    </div>

                </div>

            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">

                        <label for="comentarios_injustos" class="form-label fw-bold">
                            Quais os comentários nos noticiários parecem ser os mais injustos sobre o exercício da profissão docente?
                        </label>

                        <textarea 
                            class="form-control" 
                            id="comentarios_injustos" 
                            name="comentarios_injustos_noticiarios" 
                            maxlength="255" 
                            rows="3" 
                            placeholder="Digite sua resposta (máximo 255 caracteres)" 
                            required>
                        </textarea>
                    
                        <div class="form-text text-end">
                            <span id="contador-caracteres">0</span>/255 caracteres
                        </div>
                    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        
                        <label class="form-label fw-bold">
                            Quando você tem algum problema de ordem profissional:
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reacao_problema_profissional" id="opcao_colegas" value="Você tenta encontrar a solução juntamente com os seus colegas" required>
                            <label class="form-check-label" for="opcao_colegas">
                            Você tenta encontrar a solução juntamente com os seus colegas (conjuntamente)
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reacao_problema_profissional" id="opcao_sindicato" value="Você recorre ao sindicato ou a alguma outra organização">
                            <label class="form-check-label" for="opcao_sindicato">
                            Você recorre ao sindicato ou a alguma outra organização
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reacao_problema_profissional" id="opcao_prefeito" value="Você recorre ao prefeito ou a qualquer outra autoridade local">
                            <label class="form-check-label" for="opcao_prefeito">
                            Você recorre ao prefeito ou a qualquer outra autoridade local
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reacao_problema_profissional" id="opcao_sozinho" value="Você procura resolvê-la sozinho(a) e, de toda forma, você encontra uma solução">
                            <label class="form-check-label" for="opcao_sozinho">
                            Você procura resolvê-la sozinho(a) e, de toda forma, você encontra uma solução
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reacao_problema_profissional" id="opcao_nao_sabe" value="Não sabe">
                            <label class="form-check-label" for="opcao_nao_sabe">
                            Não sabe
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reacao_problema_profissional" id="opcao_sem_opiniao" value="Sem opinião">
                            <label class="form-check-label" for="opcao_sem_opiniao">
                            Sem opinião
                            </label>
                        </div>
                    </div>

                </div>
            
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Dentro da escola, em caso de dificuldades/problemas, você discute com seus colegas, se sente escutado e as coisas se resolvem em conjunto?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="acolhido_em_ambiente_escolar" id="acolhimento_sim" value="1" required>
                            <label class="form-check-label" for="acolhimento_sim">Sim</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="acolhido_em_ambiente_escolar" id="acolhimento_nao" value="0">
                            <label class="form-check-label" for="acolhimento_nao">Não</label>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="causa_prazer_docencia" class="form-label fw-bold">
                            O que lhe causa mais prazer no exercício da docência?
                        </label>
                        <textarea 
                            class="form-control" 
                            id="causa_prazer_docencia" 
                            name="causa_prazer_docencia" 
                            maxlength="255" 
                            rows="4" 
                            placeholder="Descreva sua resposta (máximo 255 caracteres)"
                            required
                        ></textarea>
                    </div>
                </div>
            
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="causa_desgosto_docencia" class="form-label fw-bold">
                            O que lhe causa mais desgosto no exercício da docência?
                        </label>
                        <textarea 
                            class="form-control" 
                            id="causa_desgosto_docencia" 
                            name="causa_desgosto_docencia" 
                            maxlength="255" 
                            rows="4" 
                            placeholder="Descreva sua resposta (máximo 255 caracteres)"
                            required
                        ></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Como você qualificaria o seu grau de dedicação ao trabalho?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grau_dedicacao_trabalho" id="dedicacao_reconhecido" value="Eu me dedico ao trabalho e sou reconhecido por isso" required>
                            <label class="form-check-label" for="dedicacao_reconhecido">Eu me dedico ao trabalho e sou reconhecido por isso</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grau_dedicacao_trabalho" id="dedicacao_limite" value="Eu me dedico ao trabalho, mas o reconhecimento é muito limitado">
                            <label class="form-check-label" for="dedicacao_limite">Eu me dedico ao trabalho, mas o reconhecimento é muito limitado</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grau_dedicacao_trabalho" id="dedicacao_nao_reconhecido" value="Eu me dedico bastante no trabalho, mas eu não sou reconhecido">
                            <label class="form-check-label" for="dedicacao_nao_reconhecido">Eu me dedico bastante no trabalho, mas eu não sou reconhecido</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grau_dedicacao_trabalho" id="dedicacao_indiferente" value="Se eu me dedicar ou não, sinto que isso não fará diferença">
                            <label class="form-check-label" for="dedicacao_indiferente">Se eu me dedicar ou não, sinto que isso não fará diferença</label>
                        </div>
                    
                    </div>

                </div>
            
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Qual a sua relação com a direção da escola?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="relacao_com_diretoria_escolar" id="relacao_1" value="Elas são muito difíceis" required>
                            <label class="form-check-label" for="relacao_1">
                            Elas são muito difíceis
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="relacao_com_diretoria_escolar" id="relacao_2" value="É um problema que é necessário discutir, pois as coisas estão longe de serem perfeitas">
                            <label class="form-check-label" for="relacao_2">
                            É um problema que é necessário discutir, pois as coisas estão longe de serem perfeitas
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="relacao_com_diretoria_escolar" id="relacao_3" value="Tudo bem, mesmo se as coisas não são perfeitas">
                            <label class="form-check-label" for="relacao_3">
                            Tudo bem, mesmo se as coisas não são perfeitas
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="relacao_com_diretoria_escolar" id="relacao_4" value="Tudo bem, muito satisfatórias como estão">
                            <label class="form-check-label" for="relacao_4">
                            Tudo bem, muito satisfatórias como estão
                            </label>
                        </div>
                    </div>

                </div>
  
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Existe algum programa sobre a cultura de paz e da diversidade na escola?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="existe_programa_paz_diversidade" id="programa_sim" value="1" required>
                            <label class="form-check-label" for="programa_sim">Sim</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="existe_programa_paz_diversidade" id="programa_nao" value="0">
                            <label class="form-check-label" for="programa_nao">Não</label>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Você ou algum professor já sofreu alguma agressão no ambiente escolar?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sofreu_agressao_na_escola" id="agressao_sim" value="1" required>
                            <label class="form-check-label" for="agressao_sim">Sim</label>
                        </div>

                        <div id="campo_providencia_tomada_agressao" class="mb-2" style="display: none;">
                            <textarea
                            class="form-control mt-2" 
                            name="providencia_tomada_agressao" 
                            id="providencia_tomada_agressao" 
                            rows="3" 
                            maxlength="255"
                            placeholder="Neste caso, que providências foram tomadas?"
                            ></textarea>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sofreu_agressao_na_escola" id="agressao_nao" value="0">
                            <label class="form-check-label" for="agressao_nao">Não</label>
                        </div>
                    
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Já houve casos de violência entre alunos, casos de Bullying?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="houve_caso_bullying" id="bullying_sim" value="1" required>
                            <label class="form-check-label" for="bullying_sim">Sim</label>
                        </div>

                        <div id="campo_providencia_tomada_bullying" style="display:none;" class="mb-2">
                            <textarea 
                            class="form-control mt-2" 
                            name="providencia_tomada_bullying" 
                            id="providencia_tomada_bullying" 
                            rows="3" 
                            maxlength="255"
                            placeholder="Neste caso, que medidas foram ou são adotadas?"
                            ></textarea>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="houve_caso_bullying" id="bullying_nao" value="0">
                            <label class="form-check-label" for="bullying_nao">Não</label>
                        </div>
                    </div>

                </div>
            
            </div>

            <div class="row mb-4">
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Com as pessoas do seu ambiente profissional, que relações são para você uma fonte de stress? <br>
                            <small class="text-muted">(mais de uma resposta possível)</small>
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_fonte[]" id="stress_colegas" value="Com os colegas">
                            <label class="form-check-label" for="stress_colegas">Com os colegas</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_fonte[]" id="stress_direcao" value="A direção">
                            <label class="form-check-label" for="stress_direcao">A direção</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_fonte[]" id="stress_alunos" value="Alunos">
                            <label class="form-check-label" for="stress_alunos">Alunos</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_fonte[]" id="stress_pais" value="Pais de alunos">
                            <label class="form-check-label" for="stress_pais">Pais de alunos</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_fonte_outro" id="stress_outro" value="Outro">
                            <label class="form-check-label" for="stress_outro">Outro</label>
                        </div>

                        <input type="text" class="form-control mt-2" id="campo_outra_fonte_stress" name="descricao_fonte[]" placeholder="Indicar qual..." maxlength="60" style="display:none;">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Você considera a sua remuneração compatível/justa com relação ao trabalho que realiza?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="acha_remuneracao_justa" id="remuneracao_sim" value="1" required>
                            <label class="form-check-label" for="remuneracao_sim">Sim</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="acha_remuneracao_justa" id="remuneracao_nao" value="0">
                            <label class="form-check-label" for="remuneracao_nao">Não</label>
                        </div>

                        <div class="mb-2">
                            <textarea 
                            class="form-control" 
                            name="justificativa_satisfacao_remuneracao" 
                            id="justificativa_satisfacao_remuneracao" 
                            rows="3" 
                            maxlength="255" 
                            placeholder="Por quê?" 
                            required
                            ></textarea>
                        </div>
                    
                    </div>


                </div>
            </div>

            <div class="row mb-4">

                <h5 class="text-center fw-bold mb-4">Indique abaixo informações sobre sua remuneração:</h5>

                <div class="col-md-6 mb-4">
                
                    <label class="form-label fw-semibold">Salário</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salario_recebido" id="salario1" value="1/2 salario minimo" required>
                        <label class="form-check-label" for="salario1">1/2 Salário Mínimo</label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salario_recebido" id="salario2" value="1 a 2 salarios minimos">
                        <label class="form-check-label" for="salario2">1 a 2 Salários Mínimos</label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salario_recebido" id="salario3" value="3 salarios minimos">
                        <label class="form-check-label" for="salario3">3 Salários Mínimos</label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salario_recebido" id="salario4" value="Mais de 3 salarios minimos">
                        <label class="form-check-label" for="salario4">Mais de 3 Salários Mínimos</label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salario_recebido" id="salario5" value="Piso do magisterio">
                        <label class="form-check-label" for="salario5">Piso Profissional do Magistério (R$ 1.697)</label>
                    </div>

                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Benefícios recebidos</label>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="descricao_beneficio[]" id="beneficio1" value="Piso Salarial Profissional">
                        <label class="form-check-label" for="beneficio1">Piso Salarial Profissional</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="descricao_beneficio[]" id="beneficio2" value="Gratificação por Exercício do Magistério">
                        <label class="form-check-label" for="beneficio2">Gratificação por Exercício do Magistério</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="descricao_beneficio[]" id="beneficio3" value="Adicional por Difícil Acesso">
                        <label class="form-check-label" for="beneficio3">Adicional por Difícil Acesso</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="descricao_beneficio[]" id="beneficio4" value="Aperfeiçoamento com Licença Remunerada">
                        <label class="form-check-label" for="beneficio4">Aperfeiçoamento Continuado com Licença Remunerada</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="descricao_beneficio[]" id="beneficio5" value="Progressão Funcional com Base na Titulação">
                        <label class="form-check-label" for="beneficio5">Progressão Funcional com Base na Titulação</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="descricao_beneficio[]" id="beneficio6" value="Tempo para planejamento fora da carga horária">
                        <label class="form-check-label" for="beneficio6">Período Reservado para Estudos e Planejamento fora da carga-horária de sala de aula</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="descricao_beneficio_outro" id="beneficio_outro" value="Outro">
                        <label class="form-check-label" for="beneficio7">Outro</label>
                        <input type="text" name="descricao_beneficio[]" id="campo_descricao_beneficio_outro" class="form-control mt-2" placeholder="Especifique" maxlength="100" style="display:none;">
                    </div>
                
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Se pudesse, você mudaria de profissão?</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mudaria_de_profissao" id="mudaria_sim" value="1" required>
                            <label class="form-check-label" for="mudaria_sim">Sim</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mudaria_de_profissao" id="mudaria_nao" value="0">
                            <label class="form-check-label" for="mudaria_nao">Não</label>
                        </div>

                        <div class="mt-2" id="campo_profissao_mudanca" style="display: none;">
                            <label for="profissao_mudanca" class="form-label">Para qual profissão?</label>
                            <input type="text" name="profissao_mudanca" id="profissao_mudanca" class="form-control" maxlength="50">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botão de envio -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Continuar</button>
            </div>

        </form>

    </div>


    <script src="../../public/js/sobre_exercicio_profissao.js"></script>
</body>

</html>