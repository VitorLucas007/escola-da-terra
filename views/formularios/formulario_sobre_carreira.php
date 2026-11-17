<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } 

    if(!isset($_SESSION['id_participante'])){
        header("Location: /index.php");
        exit;
    }

    # Armazenando a ultima página logada para poder rastrear em casos de redirecionamento para página de erro:
    $_SESSION['ultima_pagina'] = $_SERVER['REQUEST_URI'];

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Informações sobre carreira</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/css/sobre_carreira.css">
    <link rel="icon" type="image/jpg" href="/public/assets/logos/favicon.jpg"> 
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/cdn.php';
    ?>
</head>

<body>
    
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/views/includes/header.php';
    ?>

    <div class="container">

        <h2 class="text-center fw-bold mb-4 mt-4 p-2">Informações Sobre Carreira</h2>

        <form class="form-container" method="post" action="../../app/process/sobre_carreira_process.php">

            <div class="mt-4 container border rounded p-4">

                <h5 class="mb-5 fw-bold text-center">Informações sobre sua trajetória profissional</h5>

                <div class="row mb-4">

                    <div class="col-md-6 mb-3">

                        <h6 class="fw-bold mb-2">Antes de tornar-se professor(a), você exercia alguma atividade profissional?</h6>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exercia_trabalho_anteriormente" id="atividade_sim" value="1" required>
                            <label class="form-check-label" for="atividade_sim">Sim</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exercia_trabalho_anteriormente" id="atividade_nao" value="0">
                            <label class="form-check-label" for="atividade_nao">Não</label>
                        </div>

                        <div id="detalhes_atividade" class="mt-3 border rounded p-3" style="display: none;">
                            <div class="mb-2"> 
                                <label class="form-label fw-bold">Qual era sua profissão?</label>
                                <input class="form-control" type="text" name="nome_profissao" id="nome_profissao" placeholder="Ex: Carpinteiro">
                            </div>

                            <label class="form-label mb-2 fw-bold">Como você exercia essa atividade?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="como_exercia" id="exercia_conta_propia" value="Por conta própria">
                                <label class="form-check-label" for="como_exercia">Por conta própria</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="como_exercia" id="exercia_juntamente_familia" value="Juntamente com um membro da família">
                                <label class="form-check-label" for="como_exercia">Juntamente com um membro da família</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="como_exercia" id="exercia_contratado_estado" value="Contratado pelo Estado">
                                <label class="form-check-label" for="como_exercia">Como contratado no Estado (prefeitura, estado) ou em coletividades locais</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="como_exercia" id="exercia_setor_privado" value="Setor privado">
                                <label class="form-check-label" for="como_exercia">Como assalariado no setor privado</label>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="tempo_como_professor" class="form-label mb-2 fw-bold">Há quanto tempo você trabalha como professor? <small class="fw-medium">(número de anos)</small></label>
                            <input type="number" class="form-control" id="tempo_como_professor" name="tempo_como_professor" min="0">
                        </div>
                    </div>
                
                </div>

                <div class="row mb-4">

                    <div class="col-md-6">

                        <div class="mb-4">
                            <label class="form-label fw-bold mb-2">Você exerce alguma outra atividade profissional paralelamente à docência?</label>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exerce_atividade_paralela" id="paralela_sim" value="1" required>
                                <label class="form-check-label" for="paralela_sim">Sim</label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="exerce_atividade_paralela" id="paralela_nao" value="0">
                                <label class="form-check-label" for="paralela_nao">Não</label>
                            </div>
                            
                            <input type="text" class="form-control" name="atividade_paralela" id="atividade_paralela" placeholder="Qual?" style="display: none;">
                        </div>

                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Você atua no mesmo estabelecimento escolar desde que começou a lecionar/ensinar?</label>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mesmo_estabelecimento_desde_inicio" id="mesmo_estabelecimento_sim" value="1" required>
                                <label class="form-check-label" for="mesmo_estabelecimento_sim">Sim</label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mesmo_estabelecimento_desde_inicio" id="mesmo_estabelecimento_nao" value="0">
                                <label class="form-check-label" for="mesmo_estabelecimento_nao">Não</label>
                            </div>
                        </div>
                        
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="quantos_estabelecimentos_carreira" class="form-label fw-bold">Você já passou por quantos estabelecimentos escolares ao longo de sua carreira?</label>
                            <input type="number" class="form-control" name="quantidade_estabelecimentos_carreira" id="quantidade_estabelecimentos_carreira" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="quantos_estabelecimentos_atuais" class="form-label fw-bold">Você leciona em quantos estabelecimentos escolares atualmente?</label>
                            <input type="number" class="form-control" name="quantidade_estabelecimentos_atuais" id="quantidade_estabelecimentos_atuais" min="0" required>
                        </div>
                    </div>

                </div>
            
            </div>          
            
            <div class="row mb-4 mt-4">

                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Você poderia indicar o número de alunos:</label>
                    <div class="mb-2">
                        <label for="numero_alunos_maior_turma" class="form-label">Em sua classe mais cheia</label>
                        <input type="number" class="form-control" name="numero_alunos_maior_turma" id="numero_alunos_maior_turma" min="0">
                    </div>
                    <div>
                        <label for="numero_alunos_menor_turma" class="form-label">Em sua classe menos cheia</label>
                        <input type="number" class="form-control" name="numero_alunos_menor_turma" id="numero_alunos_menor_turma" min="0">
                    </div>
                </div>

                <div class="col-md-6">

                    <label class="form-label fw-bold">Você considera que dispõe dos materiais necessários em termos de equipamentos em suas classes?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="possui_equipamentos_necessarios" id="tem_materiais_sim" value="1" required>
                        <label class="form-check-label" for="tem_materiais_sim">Sim</label>
                    </div>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="possui_equipamentos_necessarios" id="tem_materiais_nao" value="0">
                        <label class="form-check-label" for="tem_materiais_nao">Não</label>
                    </div>
                    
                    <div id="campo_equipamentos_desejados" style="display: none;">
                        <label for="equipamentos_desejados" class="form-label">Quais equipamentos você desejaria ter à sua disposição?</label>
                        <textarea class="form-control" name="equipamentos_desejados" id="equipamentos_desejados" rows="3"></textarea>
                    </div>
               
                </div>

            </div>

            <div class="container border rounded p-4 mt-5">

                <h5 class="mb-4 text-center fw-bold">Estabelecimentos de Ensino</h5>

                <h6 class="mb-2 fw-bold">Indique abaixo o(s) estabelecimento(s) escolar(es) que você trabalha(ou) e sua jornada de trabalho:</h6>
                
                <div class="table-responsive d-none d-lg-block">

                    <table class="table table-bordered text-center align-middle" id="tabelaEscolas">
                        
                        <thead class="table-light">
                        
                        <tr>
                            <th>Nome da Escola</th>
                            <th>Situação Funcional</th>
                            <th>Localização</th>
                            <th>Etapas/Modalidades</th>
                            <th>Jornada de Trabalho semanal(Horas)</th>
                            <th>Tipo de turmas que leciona(ou)</th>
                            <th>Dependência Administrativa</th>
                            <th>Tipo de Escola</th>
                            <th>Ação</th>
                        </tr>
    
                        </thead>

                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" name="nome_escola[]" required></td>
        
                                <td>
                                    <select class="form-select" name="situacao_funcional[]" required>
                                        <option value="">Selecione</option>
                                        <option>Professor Concursado</option>
                                        <option>Professor contratado (ILT)</option>
                                        <option>Professor contratado em outro regime</option>
                                        <option>Funcionário Público cedido</option>
                                        <option>Voluntário</option>
                                        <option>Cedido</option>
                                    </select>
                                </td>
        
                                <td>
                                    <select class="form-select" name="localizacao_escola[]" required>
                                        <option value="">Selecione</option>
                                        <option value="Sede">Sede</option>
                                        <option value="Municipio">Municipio</option>
                                        <option value="Povoado">Povoado</option>
                                    </select>
                                </td>
        
                                <td>
                                    <div class="text-start text-wrap" style="min-width: 180px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Infantil" id="etapa_infantil" required>
                                            <label class="form-check-label" for="etapa_infantil">Educação Infantil</label>
                                        </div>
        
                                        <div class="form-check">
                                            <input  class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Fundamental inicial" id="etapa_fundamental_inicial">
                                            <label class="form-check-label" for="etapa_fundamental_inicial">Ensino Fundamental (Séries Iniciais)</label>
                                        </div>
        
                                        <div class="form-check">
                                            <input  class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Fundamental final" id="etapa_fundamental_final">
                                            <label class="form-check-label" for="etapa_fundamental_final">Ensino Fundamental (Séries Finais)</label>
                                        </div>
        
                                        <div class="form-check">
                                            <input  class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Ensino Medio" id="etapa_medio">
                                            <label class="form-check-label" for="etapa_medio">Ensino Médio</label>
                                        </div>
        
                                        <div class="form-check">
                                            <input  class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="EJA" id="etapa_eja">
                                            <label class="form-check-label" for="etapa_eja">Educação de Jovens e Adultos (EJA)</label>
                                        </div>
        
                                        <div class="form-check">
                                            <input  class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Educacao Especial" id="etapa_especial">
                                            <label class="form-check-label" for="etapa_especial">Educação Especial</label>
                                        </div>
        
                                        <div class="form-check">
                                            <input  class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Educacao Indigena/Quilombola" id="etapa_indigena">
                                            <label class="form-check-label" for="etapa_indigena">Educação Indígena e/ou Quilombola</label>
                                        </div>
                                    </div>
                                </td>
        
                                <td>
                                    <input type="number" id="jornada_trabalho_semanal" name="jornada_trabalho_semanal[]" class="form-control" required>
                                </td>
        
                                    <td>
                                    <select class="form-select" name="tipo_turma[]" required>
                                        <option value="">Selecione</option>
                                        <option value="Seriada">Seriada</option>
                                        <option value="Multiseriada">Multiseriada</option>
                                    </select>
                                </td>
        
                                <td>
                                    <select class="form-select dependencia_administrativa" name="dependencia_administrativa[]" required>
                                        <option value="">Selecione</option>
                                        <option>Pública municipal</option>
                                        <option>Pública estadual</option>
                                        <option>Conveniada com o poder público</option>
                                        <option>Comunitária</option>
                                        <option>Filantrópica</option>
                                        <option>Confessional</option>
                                        <option value="Outra">Outra</option>
                                    </select>
                                    <input type="text" name="dependencia_administrativa_outro[]" placeholder="Qual?" class="form-control mt-2 dependencia_administrativa_outro" id="campo_dependencia_outro" style="display: none;" required>
                                </td>
        
                                <td>
                                    <select class="form-select contexto_escolar" name="contexto_escolar[]" required>
                                        <option value="">Selecione</option>
                                        <option>Escola de Educação do Campo</option>
                                        <option>Escola de Comunidades Quilombolas</option>
                                        <option value="Outra">Outra</option>
                                    </select>
                                    <input type="text" name="contexto_escolar_outro[]" placeholder="Qual?" class="form-control mt-2 contexto_escolar_outro" id="campo_contexto_outro" style="display: none;">
                                </td>
        
                                <td>
                                    <button type="button"  name="btnRemoverEscola" id="btnRemoverEscola" class="btn btn-danger btn-sm w-100 w-md-auto px-2 py-2">Remover</button>
                                </td>
                            </tr>
                            
                        </tbody>
            
                        
                    </table>
                    
                    <button type="button" name="btnAdicionarEscola" id="btnAdicionarEscola" class="btn btn-outline-primary  px-2 px-sm-3 px-md-4 py-1 py-sm-2 py-md-3 w-100 w-sm-auto mb-3">+ Adicionar Escola</button>
                
                </div>

                <div class="d-lg-none">

                    <div class="accordion" id="accordionEscolas">
                        
                        <div class="accordion-item">
                            
                            <h2 class="accordion-header" id="heading-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-0">
                                    Estabelecimento de trabalho 1   
                                </button>
                            </h2>
                           
                            <div id="collapse-0" class="accordion-collapse collapse" data-bs-parent="#accordionEscolas">
                                
                                <div class="accordion-body">
                                    
                                    <div class="mb-4">
                                        <strong>Nome da Escola:</strong><br>
                                        <input type="text" class="form-control" name="nome_escola[]" >
                                    </div>

                                    <div class="mb-4">
                                        <strong>Situação Funcional:</strong><br>
                                        <select class="form-select" name="situacao_funcional[]" >
                                            <option value="">Selecione</option>
                                            <option>Professor Concursado</option>
                                            <option>Professor contratado (ILT)</option>
                                            <option>Outro regime</option>
                                            <option>Funcionário Público cedido</option>
                                            <option>Voluntário</option>
                                            <option>Cedido</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <strong>Localização:</strong><br>
                                        <select class="form-select" name="localizacao_escola[]" required>
                                            <option value="">Selecione</option>
                                            <option value="Sede">Sede</option>
                                            <option value="Municipio">Municipio</option>
                                            <option value="Povoado">Povoado</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <strong>Etapas/Modalidades:</strong><br>
                                       
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Infantil" >
                                            <label class="form-check-label">Educação Infantil</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Fundamental inicial">
                                            <label class="form-check-label">Ensino Fundamental (Séries Iniciais)</label>
                                        </div>
                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Fundamental final">
                                            <label class="form-check-label">Ensino Fundamental (Séries Finais)</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Ensino Medio">
                                            <label class="form-check-label">Ensino Medio</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="EJA">
                                            <label class="form-check-label">Educação de jovens e adutos</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Educacao especial">
                                            <label class="form-check-label">Educação especial</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[0][etapas][]" value="Educacao Indigena/Quilombola">
                                            <label class="form-check-label">Educação indígena e/ou Quilombola</label>
                                        </div>

                                    </div>

                                    <div class="mb-4">
                                        <strong>Jornada de Trabalho (Horas):</strong>
                                        <input type="number" class="form-control" name="jornada_trabalho_semanal[]" >
                                    </div>

                                    <div class="mb-4">
                                        <strong>Tipo de Turmas:</strong>
                                        <select class="form-select" name="tipo_turma[]" >
                                            <option value="">Selecione</option>
                                            <option>Seriada</option>
                                            <option>Multiseriada</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <strong>Dependência Administrativa:</strong>
                                        
                                        <select class="form-select dependencia_administrativa" name="dependencia_administrativa[]" >
                                            <option value="">Selecione</option>
                                            <option>Pública municipal</option>
                                            <option>Pública estadual</option>
                                            <option>Conveniada com o poder público</option>
                                            <option>Comunitária</option>
                                            <option>Filantrópica</option>
                                            <option>Confessional</option>
                                            <option value="Outra">Outra</option>
                                        </select>
                                        
                                        <input type="text" name="dependencia_administrativa_outro[]" class="form-control mt-1 dependencia_administrativa_outro" id="dependencia_administrativa_outro" placeholder="Qual?" style="display: none;">
                                    
                                    </div>

                                    <div class="mb-4">
                                        <strong>Tipo de Escola:</strong>
                                        <select class="form-select contexto_escolar" name="contexto_escolar[]" >
                                            <option value="">Selecione</option>
                                            <option>Escola de Educação do Campo</option>
                                            <option>Escola de Comunidades Quilombola</option>
                                            <option>Outra</option>
                                        </select>
                                        
                                        <input type="text" name="contexto_escolar_outro[]" class="form-control mt-1 contexto_escolar_outro" placeholder="Qual?" style="display: none;">
                                    </div>

                                </div>
    
                            </div>
                        
                        </div>
                    
                    </div>

                    <button type="button" class="btn btn-outline-primary w-100 mt-3" name="btnAdicionarEscolaMobile" id="btnAdicionarEscolaMobile">+ Adicionar Escola</button>
                </div>

            </div>

            <div class="text-center mt-4">
              <button type="submit" class="btn btn-success">Continuar</button>
            </div>

        </form>

    </div>


    <script src="../../public/js/sobre_carreira.js"></script>
</body>

</html>
