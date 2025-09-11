class ValidacoesSobreFormacaoEscolar {

  constructor() {
    console.log("✔️ Script de Validações iniciado.");
    this.contadorGraduacao = 1;
    this.contadorEspecializacao = 1;
    
    this.validarAnoConclusaoEnsinoFundamentalMenor();
    this.validarAnoConclusaoEnsinoFundamentalMaior();
    this.validarAnoConclusaoEnsinoMedio();
    this.adicionarEventosBotoes();
    this.vincularSecoesCondicionais();
    this.inicializarContadores();
  }

  inicializarContadores() {
    // Contar quantos formulários já existem
    const graduacaoExistente = document.querySelectorAll('#accordionGraduacao .accordion-item').length;
    const especializacaoExistente = document.querySelectorAll('#accordionEspecializacao .accordion-item').length;
    
    this.contadorGraduacao = graduacaoExistente;
    this.contadorEspecializacao = especializacaoExistente;
    
    console.log(`Contadores inicializados - Graduação: ${this.contadorGraduacao}, Especialização: ${this.contadorEspecializacao}`);
  }

  validarAnoConclusaoEnsinoFundamentalMenor() { /* Implementar conforme necessário */ }
  validarAnoConclusaoEnsinoFundamentalMaior() { /* Implementar conforme necessário */ }
  validarAnoConclusaoEnsinoMedio() { /* Implementar conforme necessário */ }

  adicionarEventosBotoes() {
    console.log("Configurando eventos dos botões...");
    
    // Botão adicionar graduação
    const botaoGraduacao = document.getElementById('botao_adicionar_informacao_graduacao_mobile');
    if (botaoGraduacao) {
      botaoGraduacao.addEventListener('click', () => this.adicionarGraduacao());
      console.log("✅ Evento do botão graduação configurado");
    } else {
      console.error("❌ Botão graduação não encontrado");
    }

    // Botão adicionar especialização
    const botaoEspecializacao = document.getElementById('botao_adicionar_informacao_especializacao_mobile');
    if (botaoEspecializacao) {
      botaoEspecializacao.addEventListener('click', () => this.adicionarEspecializacao());
      console.log("✅ Evento do botão especialização configurado");
    } else {
      console.error("❌ Botão especialização não encontrado");
    }

    // Listener para mudança na quantidade de graduações
    const quantidadeGraduacao = document.getElementById('quantidade_cursos_graduacao');
    if (quantidadeGraduacao) {
      quantidadeGraduacao.addEventListener('change', (e) => this.ajustarQuantidadeGraduacao(parseInt(e.target.value)));
    }

    // Listener para mudança na quantidade de especializações
    const quantidadeEspecializacao = document.getElementById('quantidade_especializacoes');
    if (quantidadeEspecializacao) {
      quantidadeEspecializacao.addEventListener('change', (e) => this.ajustarQuantidadeEspecializacao(parseInt(e.target.value)));
    }
  }

  adicionarGraduacao() {
    console.log("Adicionando nova graduação...");
    
    const accordion = document.getElementById('accordionGraduacao');
    if (!accordion) {
      console.error("❌ Accordion de graduação não encontrado");
      return;
    }

    this.contadorGraduacao++;
    const novoIndice = this.contadorGraduacao - 1;

    const novoItem = this.criarItemGraduacao(novoIndice);
    accordion.appendChild(novoItem);

    // Atualizar campo de quantidade
    const quantidadeField = document.getElementById('quantidade_cursos_graduacao');
    if (quantidadeField) {
      quantidadeField.value = this.contadorGraduacao;
    }

    console.log(`✅ Graduação ${this.contadorGraduacao} adicionada`);
  }

  adicionarEspecializacao() {
    console.log("Adicionando nova especialização...");
    
    const accordion = document.getElementById('accordionEspecializacao');
    if (!accordion) {
      console.error("❌ Accordion de especialização não encontrado");
      return;
    }

    this.contadorEspecializacao++;
    const novoIndice = this.contadorEspecializacao - 1;

    const novoItem = this.criarItemEspecializacao(novoIndice);
    accordion.appendChild(novoItem);

    // Atualizar campo de quantidade
    const quantidadeField = document.getElementById('quantidade_especializacoes');
    if (quantidadeField) {
      quantidadeField.value = this.contadorEspecializacao;
    }

    console.log(`✅ Especialização ${this.contadorEspecializacao} adicionada`);
  }

  criarItemGraduacao(indice) {
    const div = document.createElement('div');
    div.className = 'accordion-item';
    div.innerHTML = `
      <h2 class="accordion-header" id="headingGraduacao-${indice}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                data-bs-target="#collapseGraduacao-${indice}" aria-expanded="false" 
                aria-controls="collapseGraduacao-${indice}">
          Curso de Graduação ${indice + 1}
        </button>
      </h2>
      
      <div id="collapseGraduacao-${indice}" class="accordion-collapse collapse" 
           aria-labelledby="headingGraduacao-${indice}" data-bs-parent="#accordionGraduacao">
        <div class="accordion-body">

          <div class="mb-3">
            <label class="form-label">Nome da instituição de ensino</label>
            <input type="text" name="nome_instituicao_graduacao[]" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Curso</label>
            <input type="text" name="curso_graduacao[]" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Modalidade de ensino</label>
            <select name="modalidade_graduacao[]" class="form-select" required>
              <option value="">Selecione</option>
              <option value="Presencial">Presencial</option>
              <option value="EAD">EAD</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Tipo de instituição</label>
            <select name="tipo_instituicao_graduacao[]" class="form-select" required>
              <option value="">Selecione</option>
              <option value="Publica">Pública</option>
              <option value="Privada">Privada</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Foi bolsista?</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="foi_bolsista_graduacao_${indice}" value="1">
              <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="foi_bolsista_graduacao_${indice}" value="0" required>
              <label class="form-check-label">Não</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Ano de conclusão <small class="text-muted">(Deixe em branco caso esteja em andamento)</small></label>
            <input type="number" name="ano_conclusao_graduacao[]" class="form-control" min="1900" max="2100">
          </div>

          <div class="mb-3">
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.accordion-item').remove()">
              🗑️ Remover esta graduação
            </button>
          </div>

        </div>
      </div>
    `;
    return div;
  }

  criarItemEspecializacao(indice) {
    const div = document.createElement('div');
    div.className = 'accordion-item';
    div.innerHTML = `
      <h2 class="accordion-header" id="headingEspecializacao-${indice}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                data-bs-target="#collapseEspecializacao-${indice}" aria-expanded="false" 
                aria-controls="collapseEspecializacao-${indice}">
          Curso de Especialização ${indice + 1}
        </button>
      </h2>
      
      <div id="collapseEspecializacao-${indice}" class="accordion-collapse collapse" 
           aria-labelledby="headingEspecializacao-${indice}" data-bs-parent="#accordionEspecializacao">
        <div class="accordion-body">

          <div class="mb-3">
            <label class="form-label">Nome da instituição de ensino</label>
            <input type="text" name="nome_instituicao_especializacao[]" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Curso</label>
            <input type="text" name="curso_especializacao[]" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Modalidade de ensino</label>
            <select name="modalidade_especializacao[]" class="form-select" required>
              <option value="">Selecione</option>
              <option value="Presencial">Presencial</option>
              <option value="EAD">EAD</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Tipo de instituição</label>
            <select name="tipo_instituicao_especializacao[]" class="form-select" required>
              <option value="">Selecione</option>
              <option value="Publica">Pública</option>
              <option value="Privada">Privada</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Foi bolsista?</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="foi_bolsista_especializacao_${indice}" value="1">
              <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="foi_bolsista_especializacao_${indice}" value="0" required>
              <label class="form-check-label">Não</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Ano de ingresso</label>
            <input type="number" name="ano_ingresso_especializacao[]" class="form-control" min="1900" max="2100" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Ano de conclusão <small class="text-muted">(Deixe em branco caso esteja em andamento)</small></label>
            <input type="number" name="ano_conclusao_especializacao[]" class="form-control" min="1900" max="2100">
          </div>

          <div class="mb-3">
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.accordion-item').remove()">
              🗑️ Remover esta especialização
            </button>
          </div>

        </div>
      </div>
    `;
    return div;
  }

  ajustarQuantidadeGraduacao(quantidade) {
    console.log(`Ajustando quantidade de graduações para: ${quantidade}`);
    const accordion = document.getElementById('accordionGraduacao');
    const itensExistentes = accordion.querySelectorAll('.accordion-item').length;

    if (quantidade > itensExistentes) {
      // Adicionar itens
      for (let i = itensExistentes; i < quantidade; i++) {
        const novoItem = this.criarItemGraduacao(i);
        accordion.appendChild(novoItem);
      }
    } else if (quantidade < itensExistentes) {
      // Remover itens (manter pelo menos o primeiro)
      const items = accordion.querySelectorAll('.accordion-item');
      for (let i = itensExistentes - 1; i >= Math.max(quantidade, 1); i--) {
        if (items[i]) items[i].remove();
      }
    }

    this.contadorGraduacao = Math.max(quantidade, 1);
  }

  ajustarQuantidadeEspecializacao(quantidade) {
    console.log(`Ajustando quantidade de especializações para: ${quantidade}`);
    const accordion = document.getElementById('accordionEspecializacao');
    const itensExistentes = accordion.querySelectorAll('.accordion-item').length;

    if (quantidade > itensExistentes) {
      // Adicionar itens
      for (let i = itensExistentes; i < quantidade; i++) {
        const novoItem = this.criarItemEspecializacao(i);
        accordion.appendChild(novoItem);
      }
    } else if (quantidade < itensExistentes) {
      // Remover itens (manter pelo menos o primeiro)
      const items = accordion.querySelectorAll('.accordion-item');
      for (let i = itensExistentes - 1; i >= Math.max(quantidade, 1); i--) {
        if (items[i]) items[i].remove();
      }
    }

    this.contadorEspecializacao = Math.max(quantidade, 1);
  }

  _gerenciarCampos(seletorCampos, habilitar) {
    const campos = document.querySelectorAll(seletorCampos);
    console.log(`   🔎 Gerenciando ${campos.length} campo(s) com o seletor "${seletorCampos}". Habilitar: ${habilitar}`);
    campos.forEach(campo => {
      campo.disabled = !habilitar;
      if (!habilitar) {
        if (campo.type === 'radio' || campo.type === 'checkbox') {
          campo.checked = false;
        } else {
          campo.value = '';
        }
      }
    });
  }

  _vincularRadioACollapse(nomeRadio, idCollapse, seletorCampos) {
    console.log(`--- Tentando vincular rádio "${nomeRadio}" ao collapse "#${idCollapse}" ---`);
    const collapseElement = document.getElementById(idCollapse);
    const radios = document.getElementsByName(nomeRadio);

    if (!collapseElement) {
        console.error(`❌ ERRO: Elemento collapse com ID '#${idCollapse}' NÃO FOI ENCONTRADO.`);
        return;
    }
    if (radios.length === 0) {
        console.error(`❌ ERRO: Nenhum botão de rádio com o nome '${nomeRadio}' foi encontrado.`);
        return;
    }
    console.log(`   ✅ Elemento "#${idCollapse}" e rádio "${nomeRadio}" encontrados.`);

    try {
      const bsCollapse = new bootstrap.Collapse(collapseElement, { toggle: false });

      radios.forEach(radio => {
        radio.addEventListener('change', (e) => {
          const habilitar = e.target.value === '1';
          console.log(`   📘 Rádio "${nomeRadio}" alterado para '${e.target.value}'. Habilitar campos: ${habilitar}`);
          this._gerenciarCampos(seletorCampos, habilitar);
          habilitar ? bsCollapse.show() : bsCollapse.hide();
        });
      });

      // Define o estado inicial ao carregar a página
      const radioSelecionado = document.querySelector(`input[name="${nomeRadio}"]:checked`);
      const deveHabilitar = radioSelecionado && radioSelecionado.value === '1';
      
      console.log(`   🔧 Estado inicial para "${nomeRadio}": ${deveHabilitar ? 'Habilitado' : 'Desabilitado'}`);
      this._gerenciarCampos(seletorCampos, deveHabilitar);
      if(!deveHabilitar) {
        bsCollapse.hide();
      }

    } catch (e) {
      console.error(`❌ ERRO CRÍTICO ao inicializar o Bootstrap Collapse para "#${idCollapse}". Verifique se o JavaScript do Bootstrap está carregado corretamente.`, e);
    }
  }

  _vincularRadioAMultiplosCollapses(nomeRadio, idsCollapse, seletorCampos) {
    console.log(`--- Tentando vincular rádio "${nomeRadio}" aos collapses [${idsCollapse.join(', ')}] ---`);
    
    const collapseElements = idsCollapse.map(id => document.getElementById(id));
    const radios = document.getElementsByName(nomeRadio);

    // Verificar se todos os elementos existem
    const elementosInvalidos = collapseElements.filter((el, index) => {
        if (!el) {
            console.error(`❌ ERRO: Elemento collapse com ID '#${idsCollapse[index]}' NÃO FOI ENCONTRADO.`);
            return true;
        }
        return false;
    });

    if (elementosInvalidos.length > 0) return;
    if (radios.length === 0) {
        console.error(`❌ ERRO: Nenhum botão de rádio com o nome '${nomeRadio}' foi encontrado.`);
        return;
    }

    console.log(`   ✅ Elementos encontrados: ${idsCollapse.length} collapses e ${radios.length} rádios.`);

    try {
        // Criar instâncias do Bootstrap Collapse para cada elemento
        const bsCollapses = collapseElements.map(el => new bootstrap.Collapse(el, { toggle: false }));

        radios.forEach(radio => {
            radio.addEventListener('change', (e) => {
                const habilitar = e.target.value === '1';
                console.log(`   📘 Rádio "${nomeRadio}" alterado para '${e.target.value}'. Habilitar campos: ${habilitar}`);
                
                this._gerenciarCampos(seletorCampos, habilitar);
                
                // Mostrar/ocultar todos os collapses
                bsCollapses.forEach(collapse => {
                    habilitar ? collapse.show() : collapse.hide();
                });
            });
        });

        // Define o estado inicial ao carregar a página
        const radioSelecionado = document.querySelector(`input[name="${nomeRadio}"]:checked`);
        const deveHabilitar = radioSelecionado && radioSelecionado.value === '1';
        
        console.log(`   🔧 Estado inicial para "${nomeRadio}": ${deveHabilitar ? 'Habilitado' : 'Desabilitado'}`);
        this._gerenciarCampos(seletorCampos, deveHabilitar);
        
        if (!deveHabilitar) {
            bsCollapses.forEach(collapse => collapse.hide());
        }

    } catch (e) {
        console.error(`❌ ERRO CRÍTICO ao inicializar os Bootstrap Collapses. Verifique se o JavaScript do Bootstrap está carregado corretamente.`, e);
    }
  }

  vincularSecoesCondicionais() {
    console.log("Iniciando a vinculação das seções condicionais...");
    
    // Especialização (apenas um collapse inicial)
    const camposEspecializacao = '#accordionEspecializacao input, #accordionEspecializacao select, #accordionEspecializacao button, #quantidade_especializacoes';
    this._vincularRadioACollapse('fez_especializacao', 'collapseEspecializacao-0', camposEspecializacao);

    // Aperfeiçoamento (múltiplos collapses)
    const camposAperfeicoamento = '#collapseAperfeicoamento1 input, #collapseAperfeicoamento1 select, #collapseAperfeicoamento1 button, #collapseAperfeicoamento2 input, #collapseAperfeicoamento2 select, #collapseAperfeicoamento2 button, #quantidade_cursos_aperfeicoamento';
    this._vincularRadioAMultiplosCollapses('fez_curso_aperfeicoamento', ['collapseAperfeicoamento1', 'collapseAperfeicoamento2'], camposAperfeicoamento);

    // Mestrado (apenas um collapse)
    const camposMestrado = '#collapseMestrado input, #collapseMestrado select, #collapseMestrado button';
    this._vincularRadioACollapse('fez_mestrado', 'collapseMestrado', camposMestrado);
    
    console.log("Vinculação concluída.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
    new ValidacoesSobreFormacaoEscolar();
});