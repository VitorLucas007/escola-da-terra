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
  <title>Informações sobre formação escolar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/css/sobre_familia.css">
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

        <h2 class="text-center fw-bold mb-4 mt-4 p-2">Informações sobre a formação escolar</h2>

        <form class="form-container" method="post" action="../../app/process/sobre_formacao_escolar_process.php">

          <div class="row container mt-4 border p-3 rounded">

            <h5 class="mb-4 fw-bold text-center">Etapas de Formação</h5>

            <div class="mb-2 container border rounded col-md-4 p-3">
              
              <h6 class="text-center"><strong>Ensino fundamental menor <small>(1º ao 5º ano)</small></strong></h6>

              <div class="mb-2 mt-4">
                <label class="form-label d-block">Tipo de escola:</label>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo_escola_fundamental_menor" value="Publica" required>
                  <label class="form-check-label">Pública</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo_escola_fundamental_menor" value="Privada">
                  <label class="form-check-label">Privada</label>
                </div>

              </div>

              <div class="mb-2">
                <label for="municipio_fundamental_menor" class="form-label">Município:</label>
                <input type="text" class="form-control" name="municipio_fundamental_menor" id="municipio_fundamental_menor" placeholder="Governador Archer - MA" required>
              </div>

              <div class="mb-2">
                <label for="ano_conclusao_fundamental_menor" class="form-label">Ano de Conclusão:</label>
                <input
                  type="number"
                  class="form-control ano_conclusao_fundamental_menor"
                  name="ano_conclusao_fundamental_menor"
                  id="ano_conclusao_fundamental_menor"
                  min="1950" max="2011"
                  required
                />
                <span class="text-danger small erro-ano-conclusao" style="display: none;"></span>
              </div>

            </div>

            <div class="mb-2 col-md-4 container border rounded p-3">

              <h6 class="text-center"><strong>Ensino fundamental maior <small>(6º ao 9º ano)</small></strong></h6>

              <div class="mb-2 mt-4">

                <label class="form-label d-block">Tipo de escola:</label>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo_escola_fundamental_maior" value="Publica" required>
                  <label class="form-check-label">Pública</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo_escola_fundamental_maior" value="Privada">
                  <label class="form-check-label">Privada</label>
                </div>
              </div>

              <div class="mb-2">
                <label for="municipio_fundamental_maior" class="form-label">Município:</label>
                <input type="text" class="form-control" name="municipio_fundamental_maior" id="municipio_fundamental_maior" required>
              </div>

              <div class="mb-2">
                <label for="ano_conclusao_fundamental_maior" class="form-label">Ano de Conclusão:</label>
                <input
                  type="number"
                  class="form-control ano_conclusao_fundamental_maior"
                  name="ano_conclusao_fundamental_maior"
                  id="ano_conclusao_fundamental_maior"
                  min="1954" max="2015"
                  required
                />
                <span class="text-danger small erro-ano-conclusao" style="display: none;"></span>
              </div>

            </div>

            <div class="mb-2 col-md-4 container border rounded p-3">

              <h6 class="text-center"><strong>Ensino Médio</strong></h6>

              <div class="mb-2">
                <label class="form-label d-block mt-4">Tipo de escola:</label>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo_escola_ensino_medio" value="Publica" required>
                  <label class="form-check-label">Pública</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo_escola_ensino_medio" value="Privada">
                  <label class="form-check-label">Privada</label>
                </div>
              </div>

              <div class="mb-2">
                <label for="municipio_ensino_medio" class="form-label">Município:</label>
                <input type="text" class="form-control" name="municipio_ensino_medio" id="municipio_ensino_medio" required>
              </div>

              <div class="mb-2">
                <label for="ano_conclusao_ensino_medio" class="form-label">Ano de Conclusão:</label>
                <input
                    type="number"
                    class="form-control ano_conclusao_ensino_medio"
                    name="ano_conclusao_ensino_medio"
                    id="ano_conclusao_ensino_medio"
                    min="1957" max="2018"
                    required
                />
                <span class="text-danger small erro-ano-conclusao" style="display: none;"></span>

              </div>

            </div>

          </div>

          <div class="row container mt-5 mb-4 p-3 border rounded">

            <h5 class="mb-4 fw-bold fs-5 text-break text-center">Formação universitária(Graduação)</h5>

            <div class="row mt-4 mb-4">

              <div class="mb-2 col-md-4">
                <label for="quantidade_cursos_graduacao" class="form-label fw-bold">Quantos cursos de graduação você tem?</label>
                <input
                    type="number"
                    class="form-control"
                    name="quantidade_cursos_graduacao"
                    id="quantidade_cursos_graduacao"
                    value="1"
                    required
                />
              </div>

            </div>

            <div class="container mt-4">

              <div class="accordion" id="accordionGraduacao">
              
                <div class="accordion-item">
                  
                  <h2 class="accordion-header" id="headingGraduacao-0">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGraduacao-0" aria-expanded="true" aria-controls="collapseGraduacao-0">
                      Curso de Graduação 1
                    </button>
                  </h2>
                  
                  <div id="collapseGraduacao-0" class="accordion-collapse collapse show" aria-labelledby="headingGraduacao-0" data-bs-parent="#accordionGraduacao">
                    <div class="accordion-body">

                      <div class="mb-3">
                        <label for="nome_instituicao_graduacao" class="form-label">Nome da instituição de ensino</label>
                        <input type="text" name="nome_instituicao_graduacao[]" class="form-control" required>
                      </div>

                      <div class="mb-3">
                        <label for="curso_graduacao" class="form-label">Curso</label>
                        <input type="text" name="curso_graduacao[]" class="form-control" required>
                      </div>

                      <div class="mb-3">
                        <label for="modalidade_graduacao" class="form-label">Modalidade de ensino</label>
                        <select name="modalidade_graduacao[]" class="form-select" required>
                          <option value="">Selecione</option>
                          <option value="Presencial">Presencial</option>
                          <option value="EAD">EAD</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="tipo_instituicao_graduacao" class="form-label">Tipo de instituição</label>
                        <select name="tipo_instituicao_graduacao[]" class="form-select" required>
                          <option value="">Selecione</option>
                          <option value="Publica">Pública</option>
                          <option value="Privada">Privada</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label class="form-label d-block">Foi bolsista?</label>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="foi_bolsista_graduacao[]" value="1" id="bolsista_sim">
                          <label class="form-check-label" for="bolsista_sim">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="foi_bolsista_graduacao[]" value="0" id="bolsista_nao" required>
                          <label class="form-check-label" for="bolsista_nao">Não</label>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="ano_conclusao_graduacao" class="form-label">Ano de conclusão <small class="text-muted">(Deixe em branco caso esteja em andamento)</small></label>
                        <input type="number" name="ano_conclusao_graduacao[]" class="form-control" min="1900" max="2100">
                      </div>

                    </div>

                  </div>
                
                </div>
              
              </div>

              <div class="text-center mt-4">
                <button type="button" class="btn btn-outline-primary" id="botao_adicionar_informacao_graduacao_mobile">+ Adicionar Graduação</button>
              </div>
            
            </div>

          </div>

          <div class="container border rounded p-3">

            <h4 class="mb-4 text-center fw-bold">Formações de Pós Graduação</h4>

            <div class="container border rounded p-4 mb-5">

              <h5 class="text-center text-break fw-bold mb-4">Especializações</h5>

              <div class="mb-5"> 
                
                <h6 class="fw-bold mb-3">Você fez cursos de especialização?</h6>
               
                <div class="d-flex flex-column flex-md-row col-md-4">
                  
                  <div class="d-flex flex-column mb-2 me-md-3">
                    <div class="form-check">
                      <label for="fez_especializacao" class="form-check-label">Sim</label>
                      <input type="radio" name="fez_especializacao" class="form-check-input" value="1" required>
                    </div>
                    
                    <div class="form-check">
                      <label for="fez_especializacao" class="form-check-label">Não</label>
                      <input type="radio" name="fez_especializacao" class="form-check-input" value="0">
                    </div>
                  </div>

                  <div>
                    <label for="quantidade_especializacoes" class="form-control-label">Quantos?</label>
                    <input type="number" id="quantidade_especializacoes" name="quantidade_especializacoes" class="form-control" required>
                  </div>

                </div>

              </div>
              
              <div class="container mt-4">
                
                <h6 class="mb-4 text-center text-break fw-bold">
                  Detalhe os cursos concluídos ou em andamento<br>
                  <small class="fw-medium">(Caso não tenha concluído ainda, informe apenas o ano de ingresso)</small>
                </h6>

                <div class="accordion" id="accordionEspecializacao">
                  
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEspecializacao-0">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEspecializacao-0" aria-expanded="true" aria-controls="collapseEspecializacao-0">
                        Curso de Especialização 1
                      </button>
                    </h2>
                    
                    <div id="collapseEspecializacao-0" class="accordion-collapse collapse show" aria-labelledby="headingEspecializacao-0" data-bs-parent="#accordionEspecializacao">
                      
                      <div class="accordion-body">

                        <div class="mb-3">
                          <label class="form-label">Nome da instituição de ensino</label>
                          <input type="text" name="nome_instituicao_especializacao[]" class="form-control nome_instituicao_especializacao" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Curso</label>
                          <input type="text" name="curso_especializacao[]" class="form-control curso_especializacao" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Modalidade de ensino</label>
                          <select name="modalidade_especializacao[]" class="form-select modalidade_especializacao" required>
                            <option value="">Selecione</option>
                            <option value="Presencial">Presencial</option>
                            <option value="EAD">EAD</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Tipo de instituição</label>
                          <select name="tipo_instituicao_especializacao[] " class="form-select tipo_instituicao_especializacao" required>
                            <option value="">Selecione</option>
                            <option value="Publica">Pública</option>
                            <option value="Privada">Privada</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label d-block">Foi bolsista?</label>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input foi_bolsista_especializacao" type="radio" name="foi_bolsista_especializacao[]" value="1" id="bolsista_sim_especializacao">
                            <label class="form-check-label" for="bolsista_sim_especializacao">Sim</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input foi_bolsista_especializacao" type="radio" name="foi_bolsista_especializacao[]" value="0" id="bolsista_nao_especializacao" required>
                            <label class="form-check-label" for="bolsista_nao_especializacao">Não</label>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Ano de ingresso</label>
                          <input type="number" name="ano_ingresso_especializacao[]" class="form-control ano_ingresso_especializacao" min="1900" max="2100" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Ano de conclusão <small class="text-muted">(Deixe em branco caso esteja em andamento)</small></label>
                          <input type="number" name="ano_conclusao_especializacao[]" class="form-control ano_conclusao_especializacao" min="1900" max="2100">
                        </div>

                      </div>

                    </div>
                  
                  </div>
                
                </div>

                <div class="text-center mt-3">
                  <button type="button" class="btn btn-outline-primary" id="botao_adicionar_informacao_especializacao_mobile">+ Adicionar Especialização</button>
                </div>
              
              </div>

            </div>
              
            <div class="container border mb-5 rounded p-4">

              <h5 class="text-center mb-4 fw-bold">Cursos de aperfeiçoamento</h5>

              <div class="mb-5"> 
                
                <h6 class="fw-bold mt-4 mb-3">Você realizou cursos de aperfeiçoamento (pedagógico, Educação no
                  Campo, educação étnico-racial) na área em que atua?
                </h6>
               
                <div class="d-flex flex-column flex-md-row col-md-4">
                  
                  <div class="d-flex flex-column mb-2 me-md-3">
                    <div class="form-check">
                      <label for="fez_curso_aperfeicoamento" class="form-check-label">Sim</label>
                      <input type="radio" name="fez_curso_aperfeicoamento" class="form-check-input" value="1" required>
                    </div>
                    
                    <div class="form-check">
                      <label for="fez_curso_aperfeicoamento" class="form-check-label">Não</label>
                      <input type="radio" name="fez_curso_aperfeicoamento" class="form-check-input" value="0">
                    </div>
                  </div>

                  <div>
                    <label for="quantidade_cursos_aperfeicoamento" class="form-control-label">Quantos?</label>
                    <input type="number" id="quantidade_cursos_aperfeicoamento" name="quantidade_cursos_aperfeicoamento" class="form-control" required>
                  </div>

                </div>

              </div>

              <div class="container mt-4">

                <h6 class="mb-4 text-center fw-bold">
                  Em caso afirmativo, detalhe abaixo as informações requeridas em relação aos últimos dois cursos<br>
                  <small class="fw-medium">(Caso só tenha realizado um, deixe o segundo bloco em branco)</small>
                </h6>

                <div class="accordion" id="accordionAperfeicoamento">

                  <div class="accordion-item">
                    
                    <h2 class="accordion-header" id="headingAperfeicoamento1">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAperfeicoamento1" aria-expanded="true" aria-controls="collapseAperfeicoamento1">
                        Curso de Aperfeiçoamento 1
                      </button>
                    </h2>

                    <div id="collapseAperfeicoamento1" class="accordion-collapse collapse show" aria-labelledby="headingAperfeicoamento1" data-bs-parent="#accordionAperfeicoamento">
                      <div class="accordion-body">

                        <div class="mb-3">
                          <label class="form-label">Nome da instituição de ensino</label>
                          <input type="text" name="nome_instituicao_aperfeicoamento[]" class="form-control nome_instituicao_aperfeicoamento" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Curso</label>
                          <input type="text" name="curso_aperfeicoamento[]" class="form-control curso_aperfeicoamento" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Modalidade de ensino</label>
                          <select name="modalidade_aperfeicoamento[]" class="form-select modalidade_aperfeicoamento" required>
                            <option value="">Selecione</option>
                            <option value="Presencial">Presencial</option>
                            <option value="EAD">EAD</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Tipo de instituição</label>
                          <select name="tipo_instituicao_aperfeicoamento[]" class="form-select tipo_instituicao_aperfeicoamento" required>
                            <option value="">Selecione</option>
                            <option value="Publica">Pública</option>
                            <option value="Privada">Privada</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label d-block">Foi bolsista?</label>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="foi_bolsista_aperfeicoamento[]" value="1" id="bolsista_sim_aperfeicoamento">
                            <label class="form-check-label" for="bolsista_sim_aperfeicoamento">Sim</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="foi_bolsista_aperfeicoamento[]" value="0" id="bolsista_nao_aperfeicoamento" required>
                            <label class="form-check-label" for="bolsista_nao_aperfeicoamento">Não</label>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Carga Horária</label>
                          <input type="number" name="carga_horaria_aperfeicoamento[]" class="form-control carga_horaria_aperfeicoamento" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Ano de ingresso</label>
                          <input type="number" name="ano_ingresso_aperfeicoamento[]" class="form-control ano_ingresso_aperfeicoamento" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Ano de conclusão <small class="text-muted">(Deixe em branco caso esteja em andamento)</small></label>
                          <input type="number" name="ano_conclusao_aperfeicoamento[]" class="form-control ano_conclusao_aperfeicoamento">
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="accordion-item">

                    <h2 class="accordion-header" id="headingAperfeicoamento2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAperfeicoamento2" aria-expanded="false" aria-controls="collapseAperfeicoamento2">
                        Curso de Aperfeiçoamento 2
                      </button>
                    </h2>
                    
                    <div id="collapseAperfeicoamento2" class="accordion-collapse collapse" aria-labelledby="headingAperfeicoamento2" data-bs-parent="#accordionAperfeicoamento">
 
                      <div class="accordion-body">

                        <div class="mb-3">
                          <label class="form-label">Nome da instituição de ensino</label>
                          <input type="text" name="nome_instituicao_aperfeicoamento[]" class="form-control nome_instituicao_aperfeicoamento">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Curso</label>
                          <input type="text" name="curso_aperfeicoamento[]" class="form-control curso_aperfeicoamento">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Modalidade de ensino</label>
                          <select name="modalidade_aperfeicoamento[]" class="form-select modalidade_aperfeicoamento">
                            <option value="">Selecione</option>
                            <option value="Presencial">Presencial</option>
                            <option value="EAD">EAD</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Tipo de instituição</label>
                          <select name="tipo_instituicao_aperfeicoamento[]" class="form-select tipo_instituicao_aperfeicoamento">
                            <option value="">Selecione</option>
                            <option value="Publica">Pública</option>
                            <option value="Privada">Privada</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label d-block">Foi bolsista?</label>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input foi_bolsista_aperfeicoamento" type="radio" name="foi_bolsista_aperfeicoamento[]" value="1" id="bolsista_sim_aperfeicoamento">
                            <label class="form-check-label" for="bolsista_sim_aperfeicoamento">Sim</label>
                          </div>
                          
                          <div class="form-check form-check-inline">
                            <input class="form-check-input foi_bolsista_aperfeicoamento" type="radio" name="foi_bolsista_aperfeicoamento[]" value="0" id="bolsista_nao_aperfeicoamento">
                            <label class="form-check-label" for="bolsista_nao_aperfeicoamento">Não</label>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Carga Horária</label>
                          <input type="number" name="carga_horaria_aperfeicoamento[]" class="form-control carga_horaria_aperfeicoamento">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Ano de ingresso</label>
                          <input type="number" name="ano_ingresso_aperfeicoamento[] " class="form-control ano_ingresso_aperfeicoamento">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Ano de conclusão <small class="text-muted">(Deixe em branco caso esteja em andamento)</small></label>
                          <input type="number" name="ano_conclusao_aperfeicoamento[]" class="form-control ano_conclusao_aperfeicoamento">
                        </div>

                      </div>

                    </div>

                  </div>

                </div>
              
              </div>

            </div>
            
            <div class="container border rounded p-4">

              <h5 class="text-center fw-bold mb-4">Mestrado</h5>

              <div class="row mb-5"> 
                
                <h6 class="fw-bold">Você já fez curso de mestrado?</h6>

                <div class="mt-2">
                  
                  <div class="form-check">
                    <label for="fez_mestrado" class="form-check-label">Sim</label>
                    <input type="radio"  name="fez_mestrado" class="form-check-input" value="1" required>
                  </div>
                
                  <div class="form-check">
                    <label for="fez_mestrado" class="form-check-label">Não</label>
                    <input type="radio"  name="fez_mestrado" class="form-check-input" value="0">
                  </div>

                </div>

              </div>
              
              <div class="container mt-4">

                <h6 class="mb-4 text-center fw-bold">
                  Em caso afirmativo, informe abaixo as informações requeridas
                </h6>

                <div class="accordion" id="accordionMestrado">
                  <div class="accordion-item">
                    
                    <h2 class="accordion-header" id="headingMestrado">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMestrado" aria-expanded="true" aria-controls="collapseMestrado">
                        Informações do Curso de Mestrado
                      </button>
                    </h2>

                    <div id="collapseMestrado" class="accordion-collapse collapse show" aria-labelledby="headingMestrado" data-bs-parent="#accordionMestrado">
                      
                      <div class="accordion-body">

                        <div class="mb-3">
                          <label for="nome_instituicao_mestrado_mobile" class="form-label">Nome da instituição de ensino</label>
                          <input type="text" id="nome_instituicao_mestrado_mobile" name="nome_instituicao_mestrado" class="form-control" required>
                        </div>

                        <div class="mb-3">
                          <label for="curso_mestrado_mobile" class="form-label">Curso</label>
                          <input type="text" id="curso_mestrado_mobile" name="curso_mestrado" class="form-control" required>
                        </div>

                        <div class="mb-3">
                          <label for="modalidade_mestrado_mobile" class="form-label">Modalidade de ensino</label>
                          <select name="modalidade_mestrado" id="modalidade_mestrado_mobile" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="Presencial">Presencial</option>
                            <option value="EAD">EAD</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label for="tipo_instituicao_mestrado_mobile" class="form-label">Tipo de instituição</label>
                          <select name="tipo_instituicao_mestrado" id="tipo_instituicao_mestrado_mobile" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="Publica">Pública</option>
                            <option value="Privada">Privada</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label d-block">Foi bolsista?</label>
                          <div class="form-check form-check-inline">
                            <input type="radio" id="foi_bolsista_mestrado_sim_mobile" name="foi_bolsista_mestrado" class="form-check-input" value="1">
                            <label for="foi_bolsista_mestrado_sim_mobile" class="form-check-label">Sim</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input type="radio" id="foi_bolsista_mestrado_nao_mobile" name="foi_bolsista_mestrado" class="form-check-input" value="0" required>
                            <label for="foi_bolsista_mestrado_nao_mobile" class="form-check-label">Não</label>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="ano_ingresso_mestrado_mobile" class="form-label">Ano de ingresso</label>
                          <input type="number" id="ano_ingresso_mestrado_mobile" name="ano_ingresso_mestrado" class="form-control" required>
                        </div>

                        <div class="mb-3">
                          <label for="ano_conclusao_mestrado_mobile" class="form-label">
                            Ano de conclusão <small class="text-muted">(Deixe em branco caso esteja em andamento)</small>
                          </label>
                          <input type="number" id="ano_conclusao_mestrado_mobile" name="ano_conclusao_mestrado" class="form-control">
                        </div>

                      </div>

                    </div>
                  
                  </div>

                </div>
              
              </div>

            </div>
            
          </div>

          <div class="text-center mt-4">
              <button type="submit" class="btn btn-success">Continuar</button>
          </div>
          
      </form>

  </div>

  <script src="../../public/js/sobre_formacao_escolar.js"></script>
</body>
</html>