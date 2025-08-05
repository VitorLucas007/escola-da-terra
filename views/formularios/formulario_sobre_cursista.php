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

  $mensagem_erro_processamento_sobre_cursista = $_SESSION['mensagem_erro_processamento_sobre_cursista'];
  unset($_SESSION['mensagem_erro_processamento_sobre_cursista']);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Informações sobre o participante</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/css/sobre_cursista.css">
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
    <?php 
      include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php';
    ?>
</head>
<body>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php';
    ?>

  <div class="container p-1">
    
    <h2 class="text-center mb-4 mt-4 fw-bold">Informações sobre o cursista</h2>

    <?php if (!empty($mensagem_erro_processamento_sobre_cursista)): ?>
      <div class="alert alert-info">
          <?= htmlspecialchars($mensagem_erro_processamento_sobre_cursista) ?>
      </div>    
    <?php endif; ?>

    <form class="form-container" method="POST" action="/pesquisa_educacional/app/process/sobre_cursista_process.php">

      <div class="row mb-4">

        <div class="mb-4 col-md-6">
          <label for="ano_nascimento" class="form-label fw-bold">Ano de Nascimento:</label>
          <input 
            type="text" 
            class="form-control" 
            id="ano_nascimento" 
            name="ano_nascimento" 
            maxlength="4" 
            required 
            placeholder="Ex: 2005"
          />
          <span id="erro_ano_nascimento" style="color: red; display: none;">
            Ano inválido. Digite entre 1940 e 2004.
          </span>
        </div>

        <div class="mb-4 col-md-6">
          <label class="form-label fw-bold">Sexo:</label><br>
          
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="sexo" id="Masculino" value="Masculino" required>
              <label class="form-check-label" for="Masculino">Masculino</label>
          </div>
          
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="sexo" id="Feminino" value="Feminino">
              <label class="form-check-label" for="Feminino">Feminino</label>
          </div>
          
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="sexo" id="NaoDeclarado" value="Não declarado">
              <label class="form-check-label" for="NaoDeclarado">Não quero declarar</label>
          </div>

        </div>

      </div>

      <div class="row mb-4">          

          <div class="col-md-6 mb-4">
            <label for="estado_naturalidade" class="form-label fw-bold">Estado de naturalidade:</label>
            <select id="estado_naturalidade" class="form-select" required>
              <option value="">Selecione um estado</option>
            </select>    
          </div>

          <div class="col-md-6 mb-4">
            <label for="municipio_naturalidade" class="form-label fw-bold">Município de naturalidade:</label>
            <select id="municipio_naturalidade" class="form-select" required>
              <option value="">Selecione um estado primeiro</option>
            </select>    
          </div>

          <div class="col-md-6 mb-4">
            <label for="estado_reside_atualmente" class="form-label fw-bold">Estado onde reside atualmente:</label>
            <select id="estado_reside_atualmente" class="form-select" required>
              <option value="">Selecione um estado</option>
            </select>    
          </div>

          <div class="col-md-6 mb-4">
            <label for="muncicipio_reside_atualmente" class="form-label fw-bold">Município onde reside atualmente:</label>
            <select id="municipio_reside_atualmente" class="form-select" required>
              <option value="">Selecione um estado primeiro</option>
            </select>    
          </div>

      </div>

      <div class="row mb-4">
      
        <div class="mb-4 col-md-6">
          <label for="anos_reside_atualmente" class="form-label fw-bold">Há quantos anos habita nesse município(Município atual)?</label>
          <input 
            type="text" 
            class="form-control" 
            id="anos_reside_atualmente" 
            name="anos_reside_atualmente" 
            maxlength="3" 
            required 
            placeholder="Ex: 21"
          />
          <span id="erro_anos_reside_atualmente" style="color: red; display: none;">
            Valor inválido. Digite entre 1 e 99.
          </span>
        </div>
  
        <div class="mb-4 col-md-6">
          
          <label class="form-label fw-bold">Você vive com:</label>
          
          <div class="form-check ">
            <input class="form-check-input" type="checkbox" name="compartilha_com[]" id="sozinho" value="Sozinho(a)">
            <label class="form-check-label" for="sozinho">Sozinho(a)</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="compartilha_com[]" id="familia" value="Com a família">
            <label class="form-check-label" for="familia">Com a família</label>
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="compartilha_com[]" id="conjuge" value="Com cônjuge">
            <label class="form-check-label" for="conjuge">Com cônjuge</label>
          </div>
          
          <div class="form-check mt-2">
            <label class="form-check-label" for="outro">Outro:</label>
            <input class="form-control" type="text" name="compartilha_com[]" id="outro" placeholder="Ex:Com primo">
          </div>

        </div>

      </div>

      <div class="row mb-4">

        <div class="mb-4 col-md-6">
          <label class="form-label fw-bold">Sua residência/domicílio é próprio?</label><br>
          
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="residencia_propria" id="residencia_sim" value="1" required>
            <label class="form-check-label" for="residencia_sim">Sim</label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="residencia_propria" id="residencia_nao" value="0">
            <label class="form-check-label" for="residencia_nao">Não</label>
          </div>

        </div>
    
        <div class="mb-4 col-md-6">

          <label class="form-label fw-bold" style="font-weight:bold;">Você tem filhos?</label>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="tem_filhos" id="filhos_sim" value="1" required>
            <label class="form-check-label" for="filhos_sim">Sim</label>
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="tem_filhos" id="filhos_nao" value="0">
            <label class="form-check-label" for="filhos_nao">Não</label>
          </div>
  
          <input type="number" class="form-control" id="quantidade_filhos" placeholder="Quantos?" style="display:none;" name="quantidade_filhos" min="0">

        </div>
            
      </div>

      <div class="row mb-4">

        <div class="mb-4 col-md-6">
          <label class="form-label fw-bold">Seus filhos vivem com você?</label>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="vive_com_filhos" id="filhos_com_sim" value="1" required>
            <label class="form-check-label" for="filhos_com_sim">Sim</label>
          </div>
          
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="vive_com_filhos" id="filhos_com_nao" value="0">
            <label class="form-check-label" for="filhos_com_nao">Não</label>
          </div>
          
          <input type="text" class="form-control" id="filhos_vivem_com" name="filhos_vivem_com" placeholder="Vivem com quem?" style="display:none;">
        
        </div>
  
        <div class="mb-4 col-md-6">
          
          <label class="form-label fw-bold">Estado civil:</label>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="estado_civil" id="casado" value="Casado(a)" required>
            <label class="form-check-label" for="casado">Casado(a)</label>
            <input type="number" class="form-control mt-2" id="anos_tempo_casado" name="anos_tempo_casado" placeholder="Há quantos anos?" min="0">
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="estado_civil" id="uniao" value="União estável">
            <label class="form-check-label" for="uniao">União estável</label>
            <input type="number" class="form-control mt-2" id="anos_uniao_estavel" name="anos_uniao_estavel" placeholder="Há quantos anos?" min="0">
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="estado_civil" id="separado" value="Separado(a)">
            <label class="form-check-label" for="separado">Separado(a)</label>
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="estado_civil" id="divorciado" value="Divorciado(a)">
            <label class="form-check-label" for="divorciado">Divorciado(a)</label>
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="estado_civil" id="viuvo" value="Viúvo(a)">
            <label class="form-check-label" for="viuvo">Viúvo(a)</label>
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="estado_civil" id="nunca_casado" value="Jamais casado">
            <label class="form-check-label" for="nunca_casado">Jamais fui casado(a)</label>
          </div>
    
        </div>
      
      </div>

      <div class="row mb-4">
        
        <div class="mb-4 col-md-6">
          <label class="form-label fw-bold">Se casado ou em união estável:</label>
          
          <div class="mt-2"> 
            <label class="form-check-label mb-2" for="data_nascimento_conjuge">Data de nascimento do cônjuge(Mẽs/Dia/Ano) se possível:</label>
            <input type="date" class="form-control mb-2" id="data_nascimento_conjuge" name="data_nascimento_conjuge">
          </div>
      
          <div class="mt-2">
            <label class="form-check-label mb-2" for="profissao_conjugue">Profissão do cônjuge:</label>
            <input type="text" class="form-control" id="profissao_conjuge" name="profissao_conjuge" placeholder="Profissão do cônjuge">
          </div>

        </div>
        
        <div class="mb-4 col-md-6">
          <label class="form-label fw-bold">Você se casou mais de uma vez?</label>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="casou_varias_vezes" id="casou_sim" value="1" required>
            <label class="form-check-label" for="casou_sim">Sim</label>
            <input type="number" class="form-control mt-1" id="quantidade_casamentos" name="quantidade_casamentos" style="display:none;" placeholder="Quantas vezes?" min="0">
          </div>
          
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="casou_varias_vezes" id="casou_nao" value="0">
            <label class="form-check-label" for="casou_nao">Não</label>
          </div>
          
        </div>
    

      </div>

      <div class="row mb-4">

        <div class="mb-4 col-md-6">
          <label class="form-label fw-bold">Você é sindicalizado(a)?</label><br>
          
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sindicalizado" id="sindicalizado_sim" value="1" required>
            <label class="form-check-label" for="sindicalizado_sim">Sim</label>
          </div>
          
          <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="sindicalizado" id="sindicalizado_nao" value="0">
            <label class="form-check-label" for="sindicalizado_nao">Não</label>
          </div>
          
          <input type="number" class="form-control mt-2" id="tempo_sindicalizado" name="tempo_sindicalizado" placeholder="Há quanto tempo (anos)?" min="0">
        </div>

        <div class="mb-4 col-md-6">
          <label for="transporte_frequente" class="form-label fw-bold">Qual meio de transporte você utiliza mais frequentemente?</label>
          <input type="text" class="form-control" id="transporte_frequente" name="transporte_frequente" maxlength="50" required>
        </div>

      </div>

      <div class="row mb-4">

        <div class="mb-4 col-md-6">

          <label class="form-label fw-bold">Você professa alguma religião ou crença?</label><br>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tem_religiao" id="tem_religiao_sim" value="1" required>
            <label class="form-check-label" for="tem_religiao_sim">Sim</label>
          </div>
          
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tem_religiao" id="tem_religiao_nao" value="0">
            <label class="form-check-label" for="tem_religiao_nao">Não</label>
          </div>
          
          <input class="form-control mt-1" type="text" name="religiao_praticada" id="religiao_praticada" style="display:none;" placeholder="Especifique...">  
        </div>

        
        <div class="mb-4 col-md-6">
          <label class="form-label fw-bold">Você tem alguma opção partidária?</label>
          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="tem_opcao_partidaria" id="partidaria_sim" value="1" required>
            <label class="form-check-label" for="partidaria_sim">Sim</label>
            <input type="text" class="form-control mt-2" name="opcao_partidaria" id="opcao_partidaria" placeholder="Qual?" style="display:none;">
          </div>
          
          <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="tem_opcao_partidaria" id="partidaria_nao" value="0">
            <label class="form-check-label" for="partidaria_nao">Não</label>
          </div>

        </div>
      
      </div>

      <div class="row mb-4">

        <div class="mb-4 col-md-6 ">
          <label for="partidos_votados" class="form-label fw-bold">
            Poderia dizer em favor de qual(is) partido(s) você votou nas últimas eleições presidenciais?
          </label>
          <textarea class="form-control" id="partidos_votados" name="partidos_votados_ultimas_eleicoes" rows="3"></textarea>
        </div>

        <div class="mb-4 col-md-6">

          <div class="container mt-4 border p-4 rounded">
  
            <label for="escala_politica" class="form-label fw-bold">
              À propósito da política: Algumas pessoas se dizem de esquerda e outras de direita. 
              Se você pudesse se situar em uma escala de 1 a 10, na qual 1 representa os posicionamentos mais à esquerda e 10 os mais à direita, 
              em que posição você se colocaria? <em>(Deslize o ponteiro)</em>
            </label>
  
            <div class="mb-3">
              <div class="d-flex justify-content-between mb-1">
                <span>Esquerda</span>
                <span>Direita</span>
              </div>
              <input type="range" class="form-range" min="1" max="10" step="1" id="escala_politica_esquerda_direita" name="escala_politica_esquerda_direita" required>
              <p class="text-center">Valor selecionado: <strong id="valor_escala">5</strong></p>
            </div>
  
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="nao_quer_responder_escala_politica" name="nao_quer_responder_escala_politica">
              <label class="form-check-label" for="nao_quer_responder_escala_politica">
                Não sei. Não quero responder. 
              </label>
            </div>

          </div>

        </div>

      </div>
      
      <div class="row mb-4">

        <div class="container mt-4 border p-4 rounded col-md-12">
          <h5 class="mb-4 fw-bold">Entre as opções disponíveis, assinale a sua opinião sobre os seguintes temas:</h5>
          
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              
              <thead class="table-light">
                <tr>
                  <th class="text-center">Tema</th>
                  <th class="text-center">Opiniões</th>
                </tr>
              </thead>

              <tbody>

                <tr>
                  <td class="text-center"><strong>Posse de Armas</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="posse_de_armas" id="arma1" value="Arma legalizada deve ser um direito do cidadão para se defender" required>
                      <label class="form-check-label mb-2" for="arma1">Arma legalizada deve ser um direito do cidadão para se defender</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="posse_de_armas" id="arma2" value="Deve ser proibida, pois ameaça a vida de outras pessoas">
                      <label class="form-check-label" for="arma2">Deve ser proibida, pois ameaça a vida de outras pessoas</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Migração</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="migracao" id="migracao1" value="Pobres que migram acabam criando problemas para a cidade" required>
                      <label class="form-check-label mb-2" for="migracao1">Pobres que migram acabam criando problemas para a cidade</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="migracao" id="migracao2" value="Pobres que migram contribuem com o desenvolvimento e a cultura">
                      <label class="form-check-label" for="migracao2">Pobres que migram contribuem com o desenvolvimento e a cultura</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Homossexualismo</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="homossexualismo" id="homossexualismo1" value="Deve ser desencorajado por toda a sociedade" required>
                      <label class="form-check-label mb-2" for="homo1">Deve ser desencorajado por toda a sociedade</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="homossexualismo" id="homossexualismo2" value="Deve ser aceito por toda a sociedade">
                      <label class="form-check-label" for="homo2">Deve ser aceito por toda a sociedade</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Pobreza</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pobreza" id="pobreza1" value="Boa parte está ligada à preguiça de pessoas que não querem trabalhar" required>
                      <label class="form-check-label mb-2" for="pobreza1">Boa parte está ligada à preguiça de pessoas que não querem trabalhar</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pobreza" id="pobreza2" value="Boa parte está ligada à falta de oportunidades">
                      <label class="form-check-label" for="pobreza2">Boa parte está ligada à falta de oportunidades</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Pena de Morte</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pena_de_morte" id="pena1" value="É a melhor punição para indivíduos que cometem crimes graves" required>
                      <label class="form-check-label mb-2" for="pena1">É a melhor punição para indivíduos que cometem crimes graves</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pena_de_morte" id="pena2" value="Não cabe, mesmo que a pessoa tenha cometido algum crime grave">
                      <label class="form-check-label" for="pena2">Não cabe, mesmo que a pessoa tenha cometido algum crime grave</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Sindicatos</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="sindicatos" id="sindicato1" value="Servem mais para fazer política do que defender os trabalhadores" required>
                      <label class="form-check-label mb-2" for="sind1">Servem mais para fazer política do que defender os trabalhadores</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="sindicatos" id="sindicato2" value="São importantes para defender os interesses dos trabalhadores">
                      <label class="form-check-label" for="sind2">São importantes para defender os interesses dos trabalhadores</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Criminalidade</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="criminalidade" id="crime1" value="A maior causa é a maldade das pessoas" required>
                      <label class="form-check-label mb-2" for="crime1">A maior causa é a maldade das pessoas</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="criminalidade" id="crime2" value="A maior causa é a falta de oportunidades iguais para todos">
                      <label class="form-check-label" for="crime2">A maior causa é a falta de oportunidades iguais para todos</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Adolescentes</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="adolescentes" id="adolescentes1" value="Aqueles que cometem crimes devem ser punidos como adultos" required>
                      <label class="form-check-label mb-2" for="adol1">Aqueles que cometem crimes devem ser punidos como adultos</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="adolescentes" id="adolescentes2" value="Aqueles que cometem crimes devem ser reeducados">
                      <label class="form-check-label" for="adol2">Aqueles que cometem crimes devem ser reeducados</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Drogas</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="drogas" id="droga1" value="Uso deve ser proibido, pois toda a sociedade sofre as consequências" required>
                      <label class="form-check-label mb-2" for="droga1">Uso deve ser proibido, pois toda a sociedade sofre as consequências</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="drogas" id="droga2" value="Uso não deve ser proibido, pois é o usuário que sofre as consequências">
                      <label class="form-check-label" for="droga2">Uso não deve ser proibido, pois é o usuário que sofre as consequências</label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td class="text-center"><strong>Religião</strong></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="religiao" id="religiao1" value="Acreditar em Deus torna as pessoas melhores" required>
                      <label class="form-check-label mb-2" for="religiao1">Acreditar em Deus torna as pessoas melhores</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="religiao" id="religiao2" value="Acreditar em Deus não necessariamente torna as pessoas melhores">
                      <label class="form-check-label" for="religiao2">Acreditar em Deus não necessariamente torna as pessoas melhores</label>
                    </div>
                  </td>
                </tr>

              </tbody>

            </table>

          </div>

        </div>

      </div>

      <!-- Botão de envio -->
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success">Continuar</button>
      </div>
  
    </form>
  
  </div>

  <script src="../../public/js/sobre_cursista.js"></script>
</body>
</html>
