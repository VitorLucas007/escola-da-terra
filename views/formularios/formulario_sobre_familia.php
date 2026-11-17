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
  <title>Informações sobre a familia</title>
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
        
        <h2 class="text-center mb-4 mt-4 p-2 fw-bold">Informações sobre a familia</h2>
            
        <form class="form-container" method="post" action="../../app/process/sobre_familia_process.php">
            
            <div class="row">

                <div class="mb-2 d-flex row">
                    <label class="form-label fw-bold">Você possui filhos?</label>
                    
                    <div class="form-check form-check-inline">
                        <label for="possui_filhos" class="form-check-label">Sim</label>
                        <input class="form-check-input" type="radio" name="possui_filhos" id="possui_filhos" value="1" required>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <label for="nao_possui_filhos" class="form-check-label">Não</label>
                        <input class="form-check-input" type="radio" name="possui_filhos" id="nao_possui_filhos" value="0">
                    </div>

                </div>
                
            </div>
            
            <div class="row">
                
                <h5 class="mb-2 mt-3 p-3 fw-bold fs-6">Informações relativas aos seus filhos <small class="text-muted">(responder apenas se tiver filhos)</small></h5>

                <div class="container border rounded d-none d-lg-block">
                
                    <div class="table-responsive">
    
                        <table class="table table-bordered align-middle text-center" id="InformacaoFilho">
                            
                            <thead class="table-light">
                                <tr>    
                                    <th>Nome<br><small>(Apenas primeiro nome)</small></th>
                                    <th>Sexo<br><small>(Masc/Fem)</small></th>
                                    <th>Data de nascimento</th>
                                    <th>Vive com você?</th>
                                    <th>É solteiro(a)?</th>
                                    <th>Idade ao sair de casa<br><small>(se não vive com você)</small></th>
                                </tr>

                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td><input type="text" name="nome_filho[]" class="form-control nome_filho" ></td>
    
                                    <td>
                                        <select name="sexo[]" class="form-select sexo_filho" required>
                                        <option value="">Selecione</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                        <option value="Não declarado">Não declarar</option>
                                        </select>
                                    </td>
                                    
                                    <td><input type="date" name="data_nascimento[]" class="form-control data_nascimento_filho" required></td>
                                    
                                    <td>
                                        <select name="vive_com_participante[]" class="form-select vive_com_participante_filho" required>
                                            <option value="">Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <select name="solteiro[]" class="form-select solteiro_filho" required>
                                        <option value="">Selecione</option>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                        </select>
                                    </td>
                                    
                                    <td><input type="number" name="idade_saiu_casa[]" class="form-control idade_saiu_casa_filho" min="0" max="70"></td> 
                                </tr>
                            
                            </tbody>
                        
                        </table>
                
                    </div>
    
                    <div class="d-flex justify-content-end mt-2 gap-2 p-2">
                        <button type="button" id="botao_adicionar_filho" class="btn btn-outline-primary mb-3">+ Adicionar filho</button>
                        <button type="button" id="botao_remover_filho" class="btn btn-outline-danger  mb-3">– Remover último</button>
                    </div>
            
                </div>

                <div class="container d-lg-none mt-4">

                    <div class="accordion" id="accordionFilhos">

                        <div class="accordion-item" id="item-filho-0">
                            
                            <h2 class="accordion-header" id="heading-0">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-0" aria-expanded="false" aria-controls="collapse-0">
                                    Informação Filho 1
                                </button>
                            </h2>
                            
                            <div id="collapse-0" class="accordion-collapse collapse" aria-labelledby="heading-0" data-bs-parent="#accordionFilhos">
                                
                                <div class="accordion-body">
                                    
                                    <div class="mb-3">
                                        <label for="nome_filho" class="form-label">Nome (Mesmo nome indicado anteriormente)</label>
                                        <input type="text" class="form-control nome_filho" name="nome_filho[]" id="nome_filho">
                                    </div>

                                    <div class="mb-3">
                                        <label for="sexo_filho" class="form-label">Sexo</label>
                                        <select class="form-select sexo_filho" name="sexo[]" id="sexo_filho">
                                            <option value="">Selecione</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Feminino">Feminino</option>
                                            <option value="Não declarado">Não declarar</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="data_nascimento" class="form-label">Data de nascimento</label>
                                        <input type="date" class="form-control data_nascimento_filho" name="data_nascimento[]" id="data_nascimento" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="vive_com" class="form-label">Vive com você?</label>
                                        <select class="form-select vive_com_participante_filho" name="vive_com_participante[]" id="vive_com">
                                            <option value="">Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="solteiro" class="form-label">É solteiro(a)?</label>
                                        <select class="form-select solteiro_filho" name="solteiro[]" id="solteiro">
                                            <option value="">Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="idade_saiu" class="form-label">Idade ao sair de casa (se não vive com você)</label>
                                        <input type="number" class="form-control idade_saiu_casa_filho" name="idade_saiu_casa[]" id="idade_saiu" min="0" max="70">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>

                    <div class="mt-3 text-center">
                        <button type="button" id="botao_adicionar_filho_mobile" class="btn btn-outline-primary">+ Adicionar filho</button>
                    </div>
                
                </div>

            </div>

            <div class="row">
                
                <div class="container mt-4 border rounded">
                    
                    <h5 class="mb-3 p-3 fw-bold fs-6">Se você tem um ou vários filhos com mais de 18 anos, indique sua situação atual:</h5>
    
                    <div class="table-responsive">
    
                        <table class="table table-bordered align-middle text-center" id="InformacaoFilhoMaiorIdade">
                            
                            <thead class="table-light">
                                <tr>
                                    <th>Nome<br><small>(Mesmo nome indicado anteriormente)</small></th>
                                    <th>Situacao de vida</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td><input type="text" name="nome_filho_maior_idade[]" class="form-control nome_filho_maior_idade"></td>
                                    <td>
                                        <select name="situacao_vida[]" class="form-select situacao_vida">
                                            <option value="">Selecione</option>
                                            <option value="Estudante sem atividade profissional">Estudante sem atividade profissional</option>
                                            <option value="Aprendiz ou estagiário remunerado">Aprendiz ou estagiário remunerado</option>
                                            <option value="Assalariado ou trabalhador independente">Assalariado ou trabalhador independente</option>
                                            <option value="Servidor Público">Servidor Público</option>
                                            <option value="Desempregado">Desempregado</option>
                                        </select>   
                                    </td>
                                </tr>
                            
                            </tbody>
                        
                        </table>
                
                    </div>
    
                    <div class="d-flex justify-content-end gap-2 p-2">
                        <button type="button" id="botao_adicionar_filho_maior_idade" class="btn btn-outline-primary mb-3">+ Adicionar filho</button>
                        <button type="button" id="botao_remover_filho_maior_idade" class="btn btn-outline-danger  mb-3">– Remover último</button>
                    </div>
            
                </div>
                
            </div>

            <div class="row"> 

                <div class="container mt-4 border rounded">
                    
                    <h5 class="mb-3 p-3 fw-bold fs-6">Se você tem um ou vários filhos com menos de 18 anos, indique sua situação atual entre as opções abaixo:</h5>
    
                    <div class="table-responsive">
    
                        <table class="table table-bordered align-middle text-center" id="InformacaoFilhoMenorIdade">
                            
                            <thead class="table-light">
                                <tr>
                                    <th>Nome<br><small>(Mesmo nome indicado anteriormente)</small></th>
                                    <th>Etapa da educação básica</th>
                                    <th>Durante o período em que o seu filho não se encontra na escola, onde ele fica?</th>
                                    <th>Com quem seu filho fica?</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td><input type="text" name="nome_filho_menor_idade[]" class="form-control nome_filho_menor_idade" ></td>
                                    <td>
                                        <select name="etapa_educacao[]" class="form-select etapa_educacao">
                                            <option value="">Selecione</option>
                                            <option value="Educacao infantil">Educacao Infantil</option>
                                            <option value="Educacao Fundamental">Educacao Fundamental</option>
                                            <option value="Ensino Médio">Ensino Médio</option>
                                        </select>   
                                    </td>
                                    
                                    <td>
                                        <select name="habitacao_fora_escola[]" class="form-select habitacao_fora_escola">
                                            <option value="">Selecione</option>
                                            <option value="Em casa">Em casa</option>
                                            <option value="Fora de casa">Fora de casa</option>
                                        </select>   
                                    </td>
                                    
                                    <td>
                                        <select name="acompanhante[]" class="form-select acompanhante">
                                            <option value="">Selecione</option>
                                            <option value="Com você mesmo">Com você mesmo</option>
                                            <option value="Com outra pessoa de sua familia">Com outra pessoa de sua familia</option>
                                            <option value="Com outra pessoa">Com outra pessoa</option>
                                            <option value="Em uma creche">Em uma creche</option>
                                            <option value="Com uma babá ou cuidadora'">Com uma babá ou cuidadora</option>
                                            <option value="Com vizinha/amiga">Com vizinha/amiga</option>
                                        </select>   
                                    
                                    </td>
    
                                </tr>
                            
                            </tbody>
                        
                        </table>
                    
                    </div>
    
                    <div class="d-flex justify-content-end gap-2 p-2">
                        <button type="button" id="botao_adicionar_filho_menor_idade" class="btn btn-outline-primary mb-3">+ Adicionar filho</button>
                        <button type="button" id="botao_remover_filho_menor_idade" class="btn btn-outline-danger  mb-3">– Remover último</button>
                    </div>
                
                </div>
            
            </div>    

            <div class="row container mt-4 border p-4 rounded">
                
                <h5 class="fs-6 fw-bold p-2">Informações sobre seus pais:</h5>

                <div class="col-md-6 mb-4">
                    
                    <div class="border rounded p-3 h-100">
                        
                        <h6 class="text-center mb-3"><strong>PAI<br><small class="fw-medium">(Indique o máximo de informações possíveis)</small></strong></h6>

                        <div class="mb-3">
                            <label for="escolaridade_pai" class="form-label fw-bold">Escolaridade paterna</label>
                            <select class="form-select" name="escolaridade_pai" id="escolaridade_pai">
                                <option value="">Selecione</option>
                                <option value="Sem escolaridade">Sem escolaridade</option>
                                <option value="Fundamental menor">Fundamental menor</option>
                                <option value="Fundamental maior">Fundamental maior</option>
                                <option value="Ensino medio">Ensino médio</option>
                                <option value="Ensino superior">Ensino superior</option>
                                <option value="Nao sabe informar">Não sabe informar</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="profissao_pai" class="form-label fw-bold">Profissão paterna</label>
                            <input type="text" class="form-control" name="profissao_pai" id="profissao_pai">
                        </div>

                        <div class="mb-3">
                            <label for="naturalidade_pai" class="form-label fw-bold">Naturalidade paterna</label>
                            <input type="text" class="form-control" name="naturalidade_pai" id="naturalidade_pai" placeholder="Cidade e Estado">
                        </div>

                        <div class="mb-3">
                            <label for="religiao_pai" class="form-label fw-bold">Religião paterna</label>
                            <input type="text" class="form-control" name="religiao_pai" id="religiao_pai">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Participa/participou de alguma entidade associativa, grupo ou agremiação (Clube, Partido político...)?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="participa_grupo_pai" id="participa_grupo_pai_sim" value="1">
                                <label class="form-check-label" for="participa_grupo_pai_sim">Sim</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="participa_grupo_pai" id="participa_grupo_pai_nao" value="0">
                                <label class="form-check-label" for="participa_grupo_pai_nao">Não</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="grupo_participacao_pai" class="form-label fw-bold">Em caso afirmativo, quais?</label>
                            <input type="text" class="form-control" name="grupo_participacao_pai" id="grupo_participacao_pai">
                        </div>
                    
                    </div>
                
                </div>

                <div class="col-md-6 mb-4">
                    <div class="border rounded p-3 h-100">
                        
                        <h6 class="text-center mb-3"><strong>MÃE</strong></h6>

                        <div class="mb-3">
                            <label for="escolaridade_mae" class="form-label fw-bold">Escolaridade materna</label>
                            <select class="form-select" name="escolaridade_mae" id="escolaridade_mae" required>
                                <option value="">Selecione</option>
                                <option value="Sem escolaridade">Sem escolaridade</option>
                                <option value="Fundamental menor">Fundamental menor</option>
                                <option value="Fundamental maior">Fundamental maior</option>
                                <option value="Ensino medio">Ensino médio</option>
                                <option value="Ensino superior">Ensino superior</option>
                                <option value="Nao sabe informar">Não sabe informar</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="profissao_mae" class="form-label fw-bold">Profissão materna</label>
                            <input required type="text" class="form-control" name="profissao_mae" id="profissao_mae">
                        </div>

                        <div class="mb-3">
                            <label for="naturalidade_mae" class="form-label fw-bold">Naturalidade materna</label>
                            <input required type="text" class="form-control" name="naturalidade_mae" id="naturalidade_mae" placeholder="Cidade e Estado">
                        </div>

                        <div class="mb-3">
                            <label for="religiao_mae" class="form-label fw-bold">Religião materna</label>
                            <input required type="text" class="form-control" name="religiao_mae" id="religiao_mae">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Participa/participou de alguma entidade associativa, grupo ou agremiação (Clube, Partido político...)?</label>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="participa_grupo_mae" id="prticipa_grupo_mae_sim" value="1" required>
                                <label class="form-check-label" for="prticipa_grupo_mae_sim">Sim</label>
                            </div>
                        
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="participa_grupo_mae" id="participa_grupo_mae_nao" value="0">
                                <label class="form-check-label" for="participa_grupo_mae_nao">Não</label>
                            </div>
                        
                        </div>

                        <div class="mb-3">
                            <label for="grupo_participacao_mae" class="form-label fw-bold">Em caso afirmativo, quais?</label>
                            <input type="text" class="form-control" name="grupo_participacao_mae" id="grupo_participacao_mae">
                        </div>
                    
                    </div>
                
                </div>

            </div>

            <div class="row container mt-4 border p-4 rounded">
                
                <h5 class="fw-bold fs-6">Informações sobre irmãos:</h5>

                <div class="col-md-4">
                    
                    <div class="container mt-4 border rounded p-4">
                        
                        <h6 class="fs-6 fw-bold mb-3">Você possui irmãos?</h5>
    
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="possui_irmaos" id="possui_irmaos_sim" value="1" required>
                            <label class="form-check-label" for="possui_irmaos_sim">Sim</label>
                        </div>
                            
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="possui_irmaos" id="possui_irmaos_nao" value="0">
                            <label class="form-check-label" for="habita_mesma_localidade_nao">Não</label>
                        </div>
    
                        <div class="mt-2">
                            <label for="quantidade_irmaos" class="form-label">Se sim, quantos?</label>
                            <input type="number" class="form-control" name="quantidade_irmaos" id="quantidade_irmaos" value="0">
                        </div>
                    
                    </div>

                </div>

                <div class="col-md-8">
            
                    <div class="container mt-4 border rounded">
                        
                        <h6 class="mb-3 p-3 fw-bold fs-6">Se você tem irmãos, indique para cada um deles sua situação atual:</h5>
        
                        <div class="table-responsive">
        
                            <table class="table table-bordered align-middle text-center" id="InformacaoSituacaoIrmao">
                                
                                <thead class="table-light">
                                    <tr>
                                        <th>Primeiro nome</th>
                                        <th>Profissão</th>
                                        <th>Habita na mesma localidade?</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="nome_irmao[]" class="form-control nome_irmao" required></td>
                                        <td><input type="text" name="profissao_irmao[]" class="form-control profissao_irmao" required></td>
                                        
                                        <td class="p-2">  
                                            
                                            <div class="row d-flex justify-content-center">
                                                
                                                <select name="habita_mesma_localidade[]" class="form-select habita_mesma_localidade text-center" required>
                                                    <option value="">Selecione</option>
                                                    <option value="1'">Sim</option>
                                                    <option value="0">Não</option>
                                                </select>
        
                                                <div>
                                                    <label for="local_habitacao[]" class="form-label fs-7 mt-2">Onde habita no momento?</label>
                                                    <input type="text" class="form-control local_habitacao" name="local_habitacao[]" id="local_habitacao">
                                                </div>

                                            </div>
    
                                        </td>
        
                                    </tr>
                                
                                </tbody>
                            
                            </table>
                        
                        </div>
        
                        <div class="d-flex justify-content-end gap-2 p-2">
                            <button type="button" id="botao_adicionar_situacao_irmao" class="btn btn-sm btn-outline-primary mb-3 botao_adicionar_situacao_irmao">+ Adicionar irmão</button>
                            <button type="button" id="botao_remover_situacao_irmao" class="btn btn-sm btn-outline-danger mb-3 botao_remover_situacao_irmao">– Remover último</button>
                        </div>
                    
                    </div>
                
                </div>

            </div>

            <div class="row container mt-4 border p-4 rounded">

                <h5 class="mb-3 fw-bold fs-6">Informações sobre seus avós(Indique o máximo de informações possíveis):</h5>

                    <div class="col-md-6 mb-4">
                        
                        <div class="border rounded p-3 h-100">
                            
                            <h6 class="text-center mb-3"><strong>AVÓS PATERNOS</strong></h6>

                            <div class="mb-3">
                                <label for="escolaridade_avo_masc_paterno" class="form-label">Escolaridade do avô</label>
                                
                                <select class="form-select" name="escolaridade_avo_masc_paterno" id="escolaridade_avo_masc_paterno">
                                    <option value="">Selecione</option>
                                    <option value="Sem escolaridade">Sem escolaridade</option>
                                    <option value="Fundamental menor">Fundamental menor</option>
                                    <option value="Fundamental maior">Fundamental maior</option>
                                    <option value="Ensino medio">Ensino médio</option>
                                    <option value="Ensino superior">Ensino superior</option>
                                    <option value="Nao sabe responder">Não sabe responder</option>
                                </select>
                            
                            </div>

                            <div class="mb-3">
                                <label for="escolaridade_avo_fem_paterno" class="form-label">Escolaridade da avó</label>
                            
                                <select class="form-select" name="escolaridade_avo_fem_paterno" id="escolaridade_avo_fem_paterno" required>
                                    <option value="">Selecione</option>
                                    <option value="Sem escolaridade">Sem escolaridade</option>
                                    <option value="Fundamental menor">Fundamental menor</option>
                                    <option value="Fundamental maior">Fundamental maior</option>
                                    <option value="Ensino médio">Ensino médio</option>
                                    <option value="Ensino superior">Ensino superior</option>
                                    <option value="Nao sabe responder">Não sabe responder</option>
                                </select>
                            
                            </div>

                            <div class="mb-3">
                                <label for="profissao_avo_masc_paterno" class="form-label">Profissão do avô</label>
                                <input type="text" class="form-control" name="profissao_avo_masc_paterno" id="profissao_avo_masc_paterno">
                            </div>

                            <div class="mb-3">
                                <label for="profissao_avo_fem_paterno" class="form-label">Profissão da avó</label>
                                <input type="text" class="form-control" name="profissao_avo_fem_paterno" id="profissao_avo_fem_paterno">
                            </div>

                            <div class="mb-3">
                                <label for="naturalidade_avo_masc_paterno" class="form-label">Naturalidade do avô</label>
                                <input type="text" class="form-control" name="naturalidade_avo_masc_paterno" id="naturalidade_avo_masc_paterno" placeholder="Cidade e Estado">
                            </div>

                            <div class="mb-3">
                            <label for="naturalidade_avo_fem_paterno" class="form-label">Naturalidade da avó</label>
                            <input type="text" class="form-control" name="naturalidade_avo_fem_paterno" id="naturalidade_avo_fem_paterno" placeholder="Cidade e Estado">
                            </div>

                            <div class="mb-3">
                                <label for="religiao_avos_paternos" class="form-label">Religião dos avós paternos</label>
                                <input type="text" class="form-control" name="religiao_avos_paternos" id="religiao_avos_paternos">
                            </div>
                        
                        </div>
                    
                    </div>

                    <div class="col-md-6 mb-4">
                        
                        <div class="border rounded p-3 h-100">
                            
                            <h6 class="text-center mb-3"><strong>AVÓS MATERNOS</strong></h6>

                            <div class="mb-3">
                                <label for="escolaridade_avo_masc_materno" class="form-label">Escolaridade do avô</label>
                                
                                <select class="form-select" name="escolaridade_avo_masc_materno" id="escolaridade_avo_masc_materno">
                                    <option value="">Selecione</option>
                                    <option value="Sem escolaridade">Sem escolaridade</option>
                                    <option value="Fundamental menor">Fundamental menor</option>
                                    <option value="Fundamental maior">Fundamental maior</option>
                                    <option value="Ensino medio">Ensino médio</option>
                                    <option value="Ensino superior">Ensino superior</option>
                                    <option value="Nao sabe responder">Não sabe responder</option>
                                </select>
                            
                            </div>  

                            <div class="mb-3">
                                <label for="escolaridade_avo_fem_materno" class="form-label">Escolaridade da avó</label>
                                <select class="form-select" name="escolaridade_avo_fem_materno" id="escolaridade_avo_fem_materno">
                                    <option value="">Selecione</option>
                                    <option value="Sem escolaridade">Sem escolaridade</option>
                                    <option value="Fundamental menor">Fundamental menor</option>
                                    <option value="Fundamental maior">Fundamental maior</option>
                                    <option value="Ensino médio">Ensino médio</option>
                                    <option value="Ensino superior">Ensino superior</option>
                                    <option value="Nao sabe responder">Não sabe responder</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="profissao_avo_masc_materno" class="form-label">Profissão do avô</label>
                                <input type="text" class="form-control" name="profissao_avo_masc_materno" id="profissao_avo_masc_materno">
                            </div>

                            <div class="mb-3">
                                <label for="profissao_avo_fem_materno" class="form-label">Profissão da avó</label>
                                <input type="text" class="form-control" name="profissao_avo_fem_materno" id="profissao_avo_fem_materno">
                            </div>

                            <div class="mb-3">
                                <label for="naturalidade_avo_masc_materno" class="form-label">Naturalidade do avô</label>
                                <input type="text" class="form-control" name="naturalidade_avo_masc_materno" id="naturalidade_avo_masc_materno" placeholder="Cidade e Estado">
                            </div>

                            <div class="mb-3">
                                <label for="naturalidade_avo_fem_materno" class="form-label">Naturalidade da avó</label>
                                <input type="text" class="form-control" name="naturalidade_avo_fem_materno" id="naturalidade_avo_fem_materno" placeholder="Cidade e Estado">
                            </div>

                            <div class="mb-3">
                                <label for="religiao_avos_maternos" class="form-label">Religião dos avós maternos</label>
                                <input type="text" class="form-control" name="religiao_avos_maternos" id="religiao_avos_maternos">
                            </div>
                    
                        </div>
                    
                    </div>
                
                </div>
      
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success">Continuar</button>
                </div>
            
            </div>

        </form>
        
    </div>

    <script src="../../public/js/sobre_familia.js"></script>

</body>