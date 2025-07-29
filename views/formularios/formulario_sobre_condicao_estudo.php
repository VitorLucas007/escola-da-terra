<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } 

    if(!isset($_SESSION['id_usuario'])){
        header("Location: /pesquisa_educacional/index.php");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Informações sobre condições de estudo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/css/sobre_condicao_estudo.css">
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
        <h2 class="text-center mb-4 mt-5 fw-bold">Informações sobre condições de estudo</h2>

        <form class="form-container" method="post" action="#">

            <div class="row mb-4">

                <div class="col-md-6">
                      <div class="mb-4">
                        <label for="estuda_mais_frequencia" class="form-label fw-bold">Onde você estuda com mais frequência?</label>
                        <input type="text" class="form-control" id="estuda_mais_frequencia" name="estuda_mais_frequencia" maxlength="50" placeholder="Ex: em casa, na biblioteca..." required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você frequenta alguma biblioteca?</label>
                       
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequenta_biblioteca" id="frequenta_sim" value="1" required>
                            <label class="form-check-label" for="frequenta_sim">Sim</label>
                        </div>
                       
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequenta_biblioteca" id="frequenta_nao" value="0">
                            <label class="form-check-label" for="frequenta_nao">Não</label>
                        </div>
                    
                        <input type="text" class="form-control" name="local_biblioteca_frequentada" style="display:none;" id="local_biblioteca_frequentada" placeholder="Onde?">

                    </div>
                </div>
                
            </div>

            <div class="row mb-4">

                <div class="col-md-6">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Vocês dispõem de alguma sala de trabalho no estabelecimento escolar?</label>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tem_sala_trabalho" id="sala_sim" value="Sim" required>
                            <label class="form-check-label" for="sala_sim">Sim</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tem_sala_trabalho" id="sala_nao1" value="Não, não há">
                            <label class="form-check-label" for="sala_nao1">Não, não há</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tem_sala_trabalho" id="sala_nao2" value="Não, elas são pouco utilizáveis">
                            <label class="form-check-label" for="sala_nao2">Não, eles são pouco utilizáveis</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tem_sala_trabalho" id="sala_nao3" value="Não, pois elas não são acessíveis para nós">
                            <label class="form-check-label" for="sala_nao3">Não, pois elas não são acessíveis para nós</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tem_sala_trabalho" id="sala_nao4" value="Não, prefiro permanecer em outro local">
                            <label class="form-check-label" for="sala_nao4">Não, prefiro permanecer em outro local</label>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-4">

                        <label class="form-label fw-bold">Você lê com que frequência?</label>

                        <div class="row mb-2">

                            <div class="col-md-4">
                                <label for="frequencia_revistas" class="form-label">Revistas</label>
                                <select class="form-select" name="frequencia_revistas" id="frequencia_revistas" required>
                                    <option value="">Selecione</option>
                                    <option value="Todos os dias">Todos os dias</option>
                                    <option value="1 a 3 vezes na semana">1 a 3 vezes na semana</option>
                                    <option value="2 a 3 vezes por mês">2 a 3 vezes por mês</option>
                                    <option value="Raramente">Raramente</option>
                                    <option value="Jamais">Jamais</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="frequencia_jornais" class="form-label">Jornais</label>
                                <select class="form-select" name="frequencia_jornais" id="frequencia_jornais" required>
                                    <option value="">Selecione</option>
                                    <option value="Todos os dias">Todos os dias</option>
                                    <option value="1 a 3 vezes na semana">1 a 3 vezes na semana</option>
                                    <option value="2 a 3 vezes por mês">2 a 3 vezes por mês</option>
                                    <option value="Raramente">Raramente</option>
                                    <option value="Jamais">Jamais</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="frequencia_livros" class="form-label">Livros</label>
                                <select class="form-select" name="frequencia_livros" id="frequencia_livros" required>
                                    <option value="">Selecione</option>
                                    <option value="Todos os dias">Todos os dias</option>
                                    <option value="1 a 3 vezes na semana">1 a 3 vezes na semana</option>
                                    <option value="2 a 3 vezes por mês">2 a 3 vezes por mês</option>
                                    <option value="Raramente">Raramente</option>
                                    <option value="Jamais">Jamais</option>
                                </select>
                            </div>
                       
                        </div>
                    
                    </div>

                </div>
                
            </div>
            
            <div class="row mb-4">
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Em relação aos livros, de uma maneira geral, você lê</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_leitura_livros" id="le_muito" value="Muito" required>
                            <label class="form-check-label" for="le_muito">Muito</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_leitura_livros" id="le_moderadamente" value="Moderadamente">
                            <label class="form-check-label" for="le_moderadamente">Moderadamente</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_leitura_livros" id="le_pouco" value="Pouco">
                            <label class="form-check-label" for="le_pouco">Pouco</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_leitura_livros" id="le_raramente" value="Raramente">
                            <label class="form-check-label" for="le_raramente">Raramente</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Qual categoria de livros você lê com mais frequência?</label>
                        <small class="d-block mb-2 text-muted">Pode marcar mais de uma opção</small>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Literatura clássica" id="categoria_classica" required>
                            <label class="form-check-label" for="categoria_classica">Obras de literatura clássica</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Romances" id="categoria_romance">
                            <label class="form-check-label" for="categoria_romance">Romances</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Ficção" id="categoria_ficcao">
                            <label class="form-check-label" for="categoria_ficcao">Ficção</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Ciências Humanas" id="categoria_humanas">
                            <label class="form-check-label" for="categoria_humanas">Livros de Ciências Humanas</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Filosóficos/políticos/religiosos" id="categoria_filosoficos">
                            <label class="form-check-label" for="categoria_filosoficos">Livros filosóficos, políticos, religiosos</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Técnicos ou profissionais" id="categoria_tecnicos">
                            <label class="form-check-label" for="categoria_tecnicos">Livros científicos técnicos ou profissionais</label>
                        </div>
                    
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Livros de Arte" id="categoria_artes">
                            <label class="form-check-label" for="categoria_artes">Livros de Arte</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente[]" value="Revistas em quadrinhos" id="categoria_quadrinhos">
                            <label class="form-check-label" for="categoria_quadrinhos">Revistas em quadrinhos</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoria_livros_frequente_outro" value="Outros tipos" id="categoria_livros_frequente_outro">
                            <label class="form-check-label" for="categoria_livros_frequente_outro">Outros tipos</label>
                            <input type="text" id="especificacao_outra_categoria" name="categoria_livros_frequente" class="form-control" style="display:none;" placeholder="Qual?">
                        </div>

                    </div>

                </div>
                
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="livros_lidos_este_ano" class="form-label fw-bold">Quantos livros você leu este ano?</label>
                        <input type="number" min="0" class="form-control" id="livros_lidos_este_ano" name="livros_lidos_este_ano" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="quantidade_estimada_livros" class="form-label fw-bold">Poderia estimar a quantidade de livros que você possui?</label>
                        <input type="number" min="0" class="form-control" id="quantidade_estimada_livros" name="quantidade_estimada_livros" required>
                    </div>
                </div>
                
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Cite os últimos livros que você leu e que mais gostou (por ordem de preferência):</label>
                        
                        <div class="mb-2">
                            <input type="text" name="nome_livro_a" class="form-control" placeholder="a)"required>
                        </div>
                        
                        <div class="mb-2">
                            <input type="text" name="nome_livro_b" class="form-control" placeholder="b)">
                        </div>
                        
                        <div class="mb-2">
                            <input type="text" name="nome_livro_c" class="form-control" placeholder="c)">
                        </div>
                    
                    </div>
                
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você possui uma biblioteca particular (em sua casa)?</label>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="possui_biblioteca_particular" value="1" id="biblioteca_sim" required>
                            <label class="form-check-label" for="biblioteca_sim">Sim</label>
                        </div>
                    
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="possui_biblioteca_particular" value="0" id="biblioteca_nao">
                            <label class="form-check-label" for="biblioteca_nao">Não</label>
                        </div>
                    
                    </div>
                </div>
                
            </div>

            <div class="row mb-4">
                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Você acessa a internet (várias respostas possíveis):</label>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="local_acesso[]" value="Em sua residência" id="internet_residencia" required>
                            <label class="form-check-label" for="internet_residencia">Em sua residência</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="local_acesso[]" value="Casa de um membro da família ou amigo" id="internet_casa_amigo">
                            <label class="form-check-label" for="internet_casa_amigo">Na casa de um membro da família ou de amigos</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="local_acesso[]" value="Lanhouse" id="internet_lanhouse">
                            <label class="form-check-label" for="internet_lanhouse">Em uma lanhouse</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="local_acesso[]" value="Espaço público (wifi)" id="internet_publico">
                            <label class="form-check-label" for="internet_publico">Em um espaço público (wifi)</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="local_acesso_outro" value="Outro" id="local_acesso_outro">
                            <label class="form-check-label" for="local_acesso_outro">Outro</label>
                        </div>
                        <input type="text" name="local_acesso[]" id="local_acesso_especificacao" class="form-control mt-2" placeholder="Onde?" style="display: none;">
                    
                    </div>
                
                </div>

                <div class="col-md-6">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Você utiliza computador próprio ou em sua residência?</label>
    
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="utiliza_computador_proprio" value="1" id="usa_pc_sim" required>
                            <label class="form-check-label" for="usa_pc_sim">Sim</label>
                        </div>
    
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="utiliza_computador_proprio" value="0" id="usa_pc_nao">
                            <label class="form-check-label" for="usa_pc_nao">Não</label>
                        </div>
                    
                    </div>

                </div>
                
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                      <div class="mb-4">
                        <label class="form-label fw-bold">Com que frequência você se conecta à internet?</label>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_conexao_internet" value="Todos os dias ou quase" id="conexao_todos_dias" required>
                            <label class="form-check-label" for="conexao_todos_dias">Todos os dias ou quase</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_conexao_internet" value="1 a 2 vezes por semana" id="conexao_1a2">
                            <label class="form-check-label" for="conexao_1a2">Uma ou duas vezes por semana</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_conexao_internet" value="Ocasionalmente" id="conexao_ocasionalmente">
                            <label class="form-check-label" for="conexao_ocasionalmente">Ocasionalmente</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="frequencia_conexao_internet" value="Quase nunca" id="conexao_nunca">
                            <label class="form-check-label" for="conexao_nunca">Quase nunca</label>
                        </div>
                    
                    </div>
                
                </div>
               
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Continuar</button>
            </div>

        </form>

    </div>

<script src="../../public/js/sobre_condicao_estudo.js"></script>
</body>

</html>