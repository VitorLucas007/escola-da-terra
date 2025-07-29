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
  <title>Informações sobre vida do participante em geral</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/css/sobre_vida_geral.css">
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

        <h2 class="text-center mb-4 mt-4 p-2 fw-bold">Informações sobre a vida em geral</h2>

        <form class="form-container" action="#" method="post">

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">

                        <label class="form-label fw-bold">Em geral, você diria que sua saúde é:</label>

                        <div class="form-check">
                            <input type="radio" name="situacao_saude" id="situacao_excelente" value="Excelente" class="form-check-input" required>
                            <label class="form-check-label" for="situacao_excelente">Excelente</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="situacao_saude" value="Muito boa" class="form-check-input" id="situacao_muito_boa">
                            <label class="form-check-label" for="situacao_muito_boa">Muito boa</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="situacao_saude" value="Boa" class="form-check-input" id="situacao_boa">
                            <label class="form-check-label" for="situacao_boa">Boa</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="situacao_saude" value="Passável" class="form-check-input" id="situacao_passavel">
                            <label class="form-check-label" for="situacao_passavel">Passável</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="situacao_saude" value="Muito mal" class="form-check-input" id="situacao_muito_mal">
                            <label class="form-check-label" for="situacao_muito_mal">Muito mal</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="situacao_saude" value="Não posso dizer" class="form-check-input" id="situacao_nao_pode_dizer"> 
                            <label class="form-check-label" for="situacao_nao_pode_dizer">Não posso dizer</label>
                        </div>

                    </div>
                
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você tem alguma doença ou problema de saúde crônico?</label>
                        <div class="form-check"><input type="radio" name="tem_doenca_cronica" value="1" class="form-check-input" required> Sim</div>
                        <div class="form-check"><input type="radio" name="tem_doenca_cronica" value="0" class="form-check-input"> Não</div>
                    </div>
                </div>
            
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você possui plano de saúde?</label>
                        
                        <div class="form-check">
                            <input type="radio" name="tem_plano_saude" value="1" class="form-check-input" id="planoSim" required> Sim
                        </div>
                        <input type="text" id="plano_saude" name="plano_saude" class="form-control mt-2 mb-2" placeholder="Qual?" id="campo_plano" style="display:none;">

                        <div class="form-check">
                            <input type="radio" name="tem_plano_saude" value="0" class="form-check-input"> Não
                        </div>
                    
                    </div>
                
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você poderia indicar:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" name="altura" step="0.01" placeholder="Altura (ex: 1.75)" class="form-control">
                            </div>
                            
                            <div class="col-md-6">
                                <input type="number" name="peso" step="0.01" placeholder="Peso (ex: 68.50)" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
            
            <div class="row mb-4">
                
                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Você foi hospitalizado nos últimos 12 meses?</label>
                        
                        <div class="form-check">
                            <input type="radio" name="foi_internado_hospital" value="1" class="form-check-input" required> Sim
                        </div>
                        <div class="form-check">
                            <input type="radio" name="foi_internado_hospital" value="0" class="form-check-input"> Não
                        </div>
                    
                    </div>
                
                </div>

                <div class="col-md-6">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Ao longo dos últimos 12 meses, você deixou de fazer um tratamento por...</label>
                        
                        <div class="form-check">
                            <input type="radio" name="razao_ausencia_tratamento" value="Não podia pagar" class="form-check-input" required> Não podia pagar
                        </div>

                        <div class="form-check">
                            <input type="radio" name="razao_ausencia_tratamento" value="Falta de tempo" class="form-check-input"> Falta de tempo / Tinha compromissos
                        </div>
                        
                        <div class="form-check">
                            <input type="radio" name="razao_ausencia_tratamento" value="Tratamento indisponível na localidade" class="form-check-input"> Tratamento não disponível na localidade onde habita/habitava
                        </div>

                        <div class="form-check">
                            <input type="radio" name="razao_ausencia_tratamento" value="Tempo de espera longo" class="form-check-input"> Tempo de espera demasiado
                        </div>

                        <div class="form-check">
                            <input type="radio" name="razao_ausencia_tratamento" value="Não deixou de fazer" class="form-check-input"> Não deixou de fazer
                        </div>
                    
                    </div>
                
                </div>
            
            </div>
            
            <div class="row mb-4">

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Ao longo das últimas semanas, você diria que:</label>

                        <div class="form-check">
                            <input type="checkbox" name="descricao_problema[]" value="Insônia" class="form-check-input" required> Teve insônia
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" name="descricao_problema[]" value="Muito cansaço" class="form-check-input"> Estava muito cansado
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="descricao_problema[]" value="Depressivo" class="form-check-input"> Se sentiu deprimido
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="descricao_problema[]" value="Impaciente" class="form-check-input"> Estava impaciente
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="descricao_problema[]" value="Isolado" class="form-check-input"> Se sentiu isolado
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="descricao_problema[]" value="Nada disso" class="form-check-input"> Nada disso
                        </div>
                    </div>
                
                </div>

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Você fuma?</label>
    
                        <div class="form-check">
                            <input type="radio" name="usa_cigarro" value="Todos os dias" class="form-check-input" required> Todos os dias
                        </div>
                        
                        <div class="form-check">
                            <input type="radio" name="usa_cigarro" value="Ocasionalmente" class="form-check-input"> Ocasionalmente
                        </div>

                        <div class="form-check">
                            <input type="radio" name="usa_cigarro" value="Jamais" class="form-check-input"> Jamais
                        </div>

                        <input type="number" class="form-control" name="quantidade_cigarros_dia" id="quantidade_cigarros_dia" placeholder="Em média, quantos cigarros por dia?" style="display:none;">
                    
                    </div>
                
                </div>
            
            </div>

            <div class="row mb-4">
                
                <div class="col-md-6">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você ingere bebidas alcoólicas (vinho, cerveja, cachaça)?</label>
                        
                        <div class="form-check">
                            <input type="radio" name="bebe_alcool" value="1" class="form-check-input" required>
                            <label class="form-check-label">Sim</label>
                        </div>
                        
                        <div class="form-check">
                            <input type="radio" name="bebe_alcool" value="0" class="form-check-input">
                            <label class="form-check-label">Não</label>
                        </div>
                    </div>

                    <div id="frequenciaBebidaContainer" class="mb-4" style="display: none;">
                        <label class="form-label fw-semibold">Com que frequência?</label>
                        
                        <div class="table-responsive">

                            <table class="table table-bordered text-center">
                                
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Todos os dias</th>
                                        <th>1 a 3 vezes por semana</th>
                                        <th>2 a 3 vezes por mês</th>
                                        <th>Raramente</th>
                                        <th>Jamais</th>
                                    </tr>
                                </thead>
                                
                                <tbody>

                                    <tr>
                                        <td>Vinho</td>
                                        <td><input type="radio" id="vinho_todo_dia" name="nivel_frequencia_vinho" value="Todos os dias"></td>
                                        <td><input type="radio" name="nivel_frequencia_vinho" value="1 a 3 vezes por semana"></td>
                                        <td><input type="radio" name="nivel_frequencia_vinho" value="2 a 3 vezes por mês"></td>
                                        <td><input type="radio" name="nivel_frequencia_vinho" value="Raramente"></td>
                                        <td><input type="radio" name="nivel_frequencia_vinho" value="Jamais"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Cerveja</td>
                                        <td><input type="radio" id="cerveja_todo_dia" name="nivel_frequencia_cerveja" value="Todos os dias"></td>
                                        <td><input type="radio" name="nivel_frequencia_cerveja" value="1 a 3 vezes por semana"></td>
                                        <td><input type="radio" name="nivel_frequencia_cerveja" value="2 a 3 vezes por mês"></td>
                                        <td><input type="radio" name="nivel_frequencia_cerveja" value="Raramente"></td>
                                        <td><input type="radio" name="nivel_frequencia_cerveja" value="Jamais"></td>
                                    </tr>
            
                                    <tr>
                                        <td>Cachaça</td>
                                        <td><input type="radio" id="cachaca_todo_dia" name="nivel_frequencia_cachaca" value="Todos os dias"></td>
                                        <td><input type="radio" name="nivel_frequencia_cachaca" value="1 a 3 vezes por semana"></td>
                                        <td><input type="radio" name="nivel_frequencia_cachaca" value="2 a 3 vezes por mês"></td>
                                        <td><input type="radio" name="nivel_frequencia_cachaca" value="Raramente"></td>
                                        <td><input type="radio" name="nivel_frequencia_cachaca" value="Jamais"></td>
                                    </tr>
                                
                                </tbody>
                            
                            </table>
                            
                        </div>
                    
                    </div>
                
                </div>

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">De maneira geral, você tem a sensação de ter uma alimentação equilibrada?</label>
                        
                        <div class="form-check">
                            <input type="radio" name="tem_alimentacao_equilibrada" value="1" class="form-check-input" required>
                            <label class="form-check-label">Sim</label>
                        </div>
                        
                        <div class="form-check">
                            <input type="radio" name="tem_alimentacao_equilibrada" value="0" class="form-check-input" >
                            <label class="form-check-label">Não</label>
                        </div>
                    
                    </div>

                    <div id="causaDesequilibrioContainer" class="mb-4" style="display: none;">
                        
                        <label class="form-label fw-semibold">Por qual razão? (mais de uma resposta possível)</label>
                        
                        <div class="form-check">
                            <input type="checkbox" name="descricao_razao[]" id="sem_meios_financeiros" value="Meios financeiros" class="form-check-input">
                            <label class="form-check-label">Você não dispõe de meios financeiros</label>
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" name="descricao_razao[]" value="Distância de casa" class="form-check-input">
                            <label class="form-check-label">Você não tem possibilidade de uma alimentação equilibrada fora de casa</label>
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" name="descricao_razao[]" value="Sem tempo" class="form-check-input">
                            <label class="form-check-label">Você não tem tempo para preparar alimentações equilibradas</label>
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" name="descricao_razao[]" value="Não se preocupa" class="form-check-input">
                            <label class="form-check-label">Você não se preocupa com seu equilíbrio alimentar</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="input_outra_razao" id="input_outra_razao" class="form-check-input">
                            <label class="form-check-label">Por outra razão</label>
                            <input type="text"  id="descricao_outra_razao" class="form-control" placeholder="Qual?" style="display:none;" name="descricao_razao[]">
                        </div>

                    </div>
                
                </div>
            
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Fora do trabalho você faz <small>(mais de uma resposta possível)</small>:</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_atividade[]" value="Esportes" id="atividade_esporte" required>
                            <label class="form-check-label" for="atividade_esporte">Esportes</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_atividade[]" value="Atividades culturais" id="atividade_cultural">
                            <label class="form-check-label" for="atividade_cultural">Atividades culturais</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_atividade[]" value="Nada fora da família" id="atividade_familia">
                            <label class="form-check-label" for="atividade_familia">Nada fora da família</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_atividade[]" value="Participa de associação ou movimento" id="atividade_movimento">
                            <label class="form-check-label" for="atividade_movimento">Participa de uma associação ou movimento</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_atividade[]" value="Sindicato" id="atividade_sindicato">
                            <label class="form-check-label" for="atividade_sindicato">Engaja-se em algum sindicato</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="descricao_outra_atividade" id="outra_atividade">
                            <label class="form-check-label" for="outra_atividade">Outra</label>
                        </div>

                        <input type="text" name="descricao_atividade[]" class="form-control mt-2" id="campo_outra_atividade" placeholder="Qual? Descreva..." style="display: none;">
                    </div>

                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="tempo_livre" class="form-label fw-bold">O que você mais gosta de fazer em seu tempo livre?</label>
                        <textarea class="form-control" name="gosta_fazer" id="tempo_livre" maxlength="255" rows="5" placeholder="Digite sua resposta..." required></textarea>
                        <small class="text-muted">Máximo de 255 caracteres.</small>
                    </div>
                </div>

            </div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="mb-4">
                        <label for="comentario_pesquisa" class="form-label fw-bold">
                        Se você desejar acrescentar algum comentário sobre o objeto desta pesquisa, fique à vontade:
                        </label>
                        <textarea class="form-control" name="comentario_pesquisa" id="comentario_pesquisa"rows="5" placeholder="Digite seu comentário..."></textarea>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Finalizar Participação</button>
            </div>

        </form>

    </div>

    <script src="../../public/js/sobre_vida_geral.js"></script>
</body>

</html>