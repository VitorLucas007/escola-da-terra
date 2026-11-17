class ValidacoesSobreFamilia{
  constructor() {
    this.adicionarEventosBotoes();
    this.atualizarCamposIdadeSaiuCasaFilho();
    this.modificarInputTabelaFilhos();
    this.modificarInputTabelaIrmaos();
    this.validarCampoGrupoPoliticoPai();
    this.validarCampoGrupoPoliticoMae();
    this.validarCampoPossuiIrmaos();
    this.validarCampoHabitaMesmaLocalidade();
  }

  adicionarEventosBotoes(){
    const botao_adicionar_filho = document.getElementById('botao_adicionar_filho');
    const botao_adicionar_filho_mobile = document.getElementById('botao_adicionar_filho_mobile');
    const botao_remover_filho = document.getElementById('botao_remover_filho');
    const botao_adicionar_filho_maior_idade = document.getElementById('botao_adicionar_filho_maior_idade');
    const botao_remover_filho_maior_idade = document.getElementById('botao_remover_filho_maior_idade');
    const botao_adicionar_filho_menor_idade = document.getElementById('botao_adicionar_filho_menor_idade');
    const botao_remover_filho_menor_idade = document.getElementById('botao_remover_filho_menor_idade');
    const botao_adicionar_situacao_irmao = document.getElementById('botao_adicionar_situacao_irmao');
    const botao_remover_situacao_irmao = document.getElementById('botao_remover_situacao_irmao');


    if(botao_adicionar_filho && botao_adicionar_filho_mobile && botao_remover_filho && botao_adicionar_filho_maior_idade && botao_remover_filho_maior_idade
      && botao_adicionar_filho_menor_idade && botao_remover_filho_menor_idade
      && botao_adicionar_situacao_irmao && botao_remover_situacao_irmao
    ){
      botao_adicionar_filho.addEventListener('click', this.adicionarLinhaFilho.bind(this));
      botao_adicionar_filho_mobile.addEventListener('click', this.adicionarLinhaFilhoMobile.bind(this));
      botao_remover_filho.addEventListener('click', this.removerUltimaLinhaFilho.bind(this));
      botao_adicionar_filho_maior_idade.addEventListener('click', this.adicionarLinhaFilhoMaiorIdade.bind(this));
      botao_remover_filho_maior_idade.addEventListener('click', this.removerUltimaLinhaFilhoMaiorIdade.bind(this));
      botao_adicionar_filho_menor_idade.addEventListener('click', this.adicionarLinhaFilhoMenorIdade.bind(this));
      botao_remover_filho_menor_idade.addEventListener('click', this.removerUltimaLinhaFilhoMenorIdade.bind(this));
      botao_adicionar_situacao_irmao.addEventListener('click', this.adicionarLinhaSituacaoIrmao.bind(this));
      botao_remover_situacao_irmao.addEventListener('click', this.removerUltimaLinhaSituacaoIrmao.bind(this));
    }
    else{
      console.log("Não foi possível adicionar o evento de clique aos botões da página.");
    }

  }

  atualizarCamposIdadeSaiuCasaFilho() {
    const selects = document.querySelectorAll('.vive_com_participante_filho');
    const camposIdade = document.querySelectorAll('.idade_saiu_casa_filho');

    selects.forEach((select, index) => {
      const campoIdade = camposIdade[index];

      if (select.value === '0') {
        campoIdade.disabled = false;
      } else {
        campoIdade.disabled = true;
        campoIdade.value = '';
      }

      // Atualiza quando o valor mudar
      select.addEventListener('change', () => {
        if (select.value === '0') {
          campoIdade.disabled = false;
        } else {
          campoIdade.disabled = true;
          campoIdade.value = '';
        }
      });
    });
  }

  // Função que adiciona o conteúdo de uma nova linha a tabela de informações de filhos:
  adicionarLinhaFilho() {
      const tabela = document.querySelector('#InformacaoFilho tbody');
      const novaLinha = document.createElement('tr');
      novaLinha.innerHTML = `
      <td><input type="text" name="nome_filho[]" class="form-control nome_filho" required></td>

      <td>
          <select name="sexo[]" class="form-select sexo_filho" required>
          <option value="">Selecione</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
          <option value="Não declarado">Não declarar</option>
          </select>
      </td>

      <td><input type="date"  name="data_nascimento[]" class="form-control data_nascimento_filho" required></td>

      <td>
          <select name="vive_com_participante[]" class="form-select vive_com_participante_filho" required>
          <option value="">Selecione</option>
          <option value="1'">Sim</option>
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

      <td><input type="number" name="idade_saiu_casa[]" class="form-control idade_saiu_casa_filho" min="0"></td>
      `;
      tabela.appendChild(novaLinha);
      this.atualizarCamposIdadeSaiuCasaFilho();
  }

  adicionarLinhaFilhoMobile(){
    const container = document.getElementById('accordionFilhos');
    const id_container = container.childElementCount;
    container.innerHTML += `
      <div class="accordion-item" id="item-filho-${id_container}">
        
        <h2 class="accordion-header" id="heading-${id_container}">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${id_container}" aria-expanded="false" aria-controls="collapse-${id_container}">
              Informação Filho ${id_container + 1}
          </button>
        </h2>
        
        <div id="collapse-${id_container}" class="accordion-collapse collapse" aria-labelledby="heading-${id_container}" data-bs-parent="#accordionFilhos">
            
            <div class="accordion-body">
              <div class="mb-3">
                  <label for="nome_filho" class="form-label">Nome (primeiro nome)</label>
                  <input type="text" class="form-control nome_filho" name="nome_filho[]" id="nome_filho" required>
              </div>

              <div class="mb-3">
                <label for="sexo_filho" class="form-label">Sexo</label>
                <select class="form-select sexo_filho" name="sexo[]" id="sexo_filho" required>
                    <option value="">Selecione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Não declarado">Não declarar</option>
                </select>
              </div>

              <div class="mb-3">
                  <label for="data_nascimento" class="form-label">Data de nascimento</label>
                  <input type="date" class="form-control data_nascimento_filho" name="data_nascimento[]" id="data_nascimento" required>
              </div>

              <div class="mb-3">
                  <label for="vive_com" class="form-label">Vive com você?</label>
                  <select class="form-select vive_com_participante_filho" name="vive_com_participante[]" id="vive_com" required>
                      <option value="">Selecione</option>
                      <option value="1">Sim</option>
                      <option value="0">Não</option>
                  </select>
              </div>

              <div class="mb-3">
                  <label for="solteiro" class="form-label">É solteiro(a)?</label>
                  <select class="form-select solteiro_filho" name="solteiro[]" id="solteiro" required>
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

          <button type="button" name="btnRemoverFilhoMobile" data-id="${id_container}" class="btn btn-danger w-100 mt-3">Excluir informação</button>

        </div>
    
      </div> 
    
    `;
    this.adicionarEventoBotoesRemocaoInstaciaFilhoMobile();
    this.atualizarCamposIdadeSaiuCasaFilho();
  }

  // Função que adiciona linha na tabela que obtém informações de situação de vida sobre filhos maiores de idade:
  adicionarLinhaFilhoMaiorIdade() {
      const tabela = document.querySelector('#InformacaoFilhoMaiorIdade tbody');
      const novaLinha = document.createElement('tr');
      novaLinha.innerHTML = `
      <tr>
        <td><input type="text" name="nome_filho_maior_idade[]" class="form-control" required></td>
        <td>
          <select name="situacao_vida" class="form-select" required>
              <option value="">Selecione</option>
              <option value="Estudante sem atividade profissional">Estudante sem atividade profissional</option>
              <option value="Aprendiz ou estagiário remunerado">Aprendiz ou estagiário remunerado</option>
              <option value="Assalariado ou trabalhador independente">Assalariado ou trabalhador independente</option>
              <option value="Servidor Público">Servidor Público</option>
              <option value="Desempregado">Desempregado</option>

          </select>
        </td>
      </tr>
      `;
      tabela.appendChild(novaLinha);
  }

  // Função que adiciona linha na tabela que obtém informações de filhos menor de idade
  adicionarLinhaFilhoMenorIdade() {
      const tabela = document.querySelector('#InformacaoFilhoMenorIdade tbody');
      const novaLinha = document.createElement('tr');
      novaLinha.innerHTML = `
        <tr>
          <td><input type="text" name="nome_filho_menor_idade[]" class="form-control" required></td>
          <td>
              <select name="etapa_educacao" class="form-select" required>
                  <option value="">Selecione</option>
                  <option value="Educacao infantil">Educacao Infantil</option>
                  <option value="Educacao Fundamental">Educacao Fundamental</option>
                  <option value="Ensino Médio">Ensino Médio</option>
              </select>
          </td>

          <td>
              <select name="habitacaao_fora_escola" class="form-select" required>
                  <option value="">Selecione</option>
                  <option value="Em casa">Em casa</option>
                  <option value="Fora de casa">Fora de casa</option>
              </select>
          </td>

          <td>
              <select name="acompanhante" class="form-select" required>
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
      `;
      tabela.appendChild(novaLinha);
  }

  adicionarLinhaSituacaoIrmao() {
    const tabela = document.querySelector('#InformacaoSituacaoIrmao tbody');
    const novaLinha = document.createElement('tr');
    novaLinha.innerHTML = `
    <tr>
      <td><input type="text" name="nome_irmao[]" class="form-control nome_irmao" required></td>
      <td><input type="text" name="profissao_irmao[]" class="form-control profissao_irmao" required></td>

      <td>
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
    `;
    tabela.appendChild(novaLinha);
    this.validarCampoHabitaMesmaLocalidade();
  }

  // Função que remove a ultima linha da tabela de informações de filhos:
  removerUltimaLinhaFilho() {
    const tabela = document.querySelector('#InformacaoFilho tbody');
    const linhas = tabela.querySelectorAll('tr');
    if (linhas.length > 1) {
        tabela.removeChild(linhas[linhas.length - 1]);
    } else {
        alert("É necessário informar ao menos uma instância de filho.");
    }
  }

  // Função que remove a ultima linha da tabela de informações de filhos maiores de idade:
  removerUltimaLinhaFilhoMaiorIdade() {
    const tabela = document.querySelector('#InformacaoFilhoMaiorIdade tbody');
    const linhas = tabela.querySelectorAll('tr');
    if (linhas.length > 1) {
        tabela.removeChild(linhas[linhas.length - 1]);
    }
  }

  // Função que remove linha relacionada a tabela de informações de filhos menores de idade
  removerUltimaLinhaFilhoMenorIdade() {
    const tabela = document.querySelector('#InformacaoFilhoMenorIdade tbody');
    const linhas = tabela.querySelectorAll('tr');
    if (linhas.length > 1) {
        tabela.removeChild(linhas[linhas.length - 1]);
    }
  }

  removerUltimaLinhaSituacaoIrmao() {
    const tabela = document.querySelector('#InformacaoSituacaoIrmao tbody');
    const linhas = tabela.querySelectorAll('tr');
    if (linhas.length > 1) {
        tabela.removeChild(linhas[linhas.length - 1]);
    }
  }

  removerContainerInstanciaFilhoMobile(id_bloco) {
    const container = document.getElementById('item-filho-' + id_bloco);
    container.remove();
  }


  /**
   * Desktop e mobile repetem os mesmos campos (classes .nome_filho etc.).
   * O bloco oculto pelo Bootstrap fica com display:none; campos required lá
   * disparam "not focusable" no submit. Só o bloco visível deve ficar habilitado.
   */
  sincronizarCamposFilhosResponsivos() {
    const possuiFilhos = document.querySelector('input[name="possui_filhos"]:checked')?.value === '1';
    const containerDesktop = document.getElementById('InformacaoFilho')?.closest('.container');
    const containerMobile = document.getElementById('accordionFilhos')?.closest('.container');
    const isDesktop = window.matchMedia('(min-width: 992px)').matches;

    const setBloco = (container, ativo) => {
      if (!container) return;
      container.querySelectorAll('input, select, textarea').forEach((el) => {
        if (el.type === 'hidden') return;
        el.disabled = !ativo;
        if (!ativo) el.value = '';
      });
      container.querySelectorAll('button').forEach((btn) => {
        btn.disabled = !ativo;
      });
    };

    if (!possuiFilhos) {
      setBloco(containerDesktop, false);
      setBloco(containerMobile, false);
    } else {
      setBloco(containerDesktop, isDesktop);
      setBloco(containerMobile, !isDesktop);
    }

    const camposDemaisTabelas = [
      ...document.querySelectorAll('.nome_filho_maior_idade'),
      ...document.querySelectorAll('.situacao_vida'),
      ...document.querySelectorAll('.nome_filho_menor_idade'),
      ...document.querySelectorAll('.etapa_educacao'),
      ...document.querySelectorAll('.habitacao_fora_escola'),
      ...document.querySelectorAll('.acompanhante'),
    ];
    const botoesMaiorMenor = [
      document.getElementById('botao_adicionar_filho_maior_idade'),
      document.getElementById('botao_remover_filho_maior_idade'),
      document.getElementById('botao_adicionar_filho_menor_idade'),
      document.getElementById('botao_remover_filho_menor_idade'),
    ].filter(Boolean);

    camposDemaisTabelas.forEach((el) => {
      el.disabled = !possuiFilhos;
      if (!possuiFilhos) el.value = '';
    });
    botoesMaiorMenor.forEach((btn) => {
      btn.disabled = !possuiFilhos;
    });
  }

  // Lógica que ativa e desativa os inputs relacionados a tabela de informações dos filhos:
  modificarInputTabelaFilhos () {
    const radios = document.getElementsByName('possui_filhos');
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        this.sincronizarCamposFilhosResponsivos();
      });
    });

    let resizeTimer;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => this.sincronizarCamposFilhosResponsivos(), 150);
    });

    this.sincronizarCamposFilhosResponsivos();
  }

  modificarInputTabelaIrmaos () {
    const radios = document.getElementsByName('possui_irmaos');
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
          const camposTabela = [
              document.getElementById('quantidade_irmaos'),
              ...document.querySelectorAll('.nome_irmao'),
              ...document.querySelectorAll('.profissao_irmao'),
              ...document.querySelectorAll('.habita_mesma_localidade'),
              ...document.querySelectorAll('.botao_remover_situacao_irmao'),
              ...document.querySelectorAll('.botao_adicionar_situacao_irmao'),
          ];

          if (radio.checked && radio.value === '1') {
            camposTabela.forEach(campo => {
              campo.disabled = false;
          })
          } else{
              document.querySelectorAll('.local_habitacao').forEach(campo => {
                campo.disabled = true;
                campo.value = '';
              })
              camposTabela.forEach(campo => {
                campo.disabled = true;
                campo.value = '';
                campo.checked = false;
              })
          }
      });
    });

    const camposTabelaIniciais = [
      document.getElementById('quantidade_irmaos'),
      ...document.querySelectorAll('.nome_irmao'),
      ...document.querySelectorAll('.profissao_irmao'),
      ...document.querySelectorAll('.habita_mesma_localidade'),
      ...document.querySelectorAll('.botao_remover_situacao_irmao'),
      ...document.querySelectorAll('.botao_adicionar_situacao_irmao'),
    ];

    camposTabelaIniciais.forEach(campo => {
      campo.disabled = true;
    })

  }

  validarCampoGrupoPoliticoPai(){
    const radios = document.getElementsByName('participa_grupo_pai');
    const campoTexto = document.getElementById('grupo_participacao_pai');

    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoTexto.disabled = false;
          campoTexto.required = true;
        } else{
          campoTexto.disabled = true;
          campoTexto.value = '';
          campoTexto.required = false;
        }
      });
    })

    campoTexto.disabled = true;
  }

  validarCampoGrupoPoliticoMae(){
    const radios = document.getElementsByName('participa_grupo_mae');
    const campoTexto = document.getElementById('grupo_participacao_mae');

    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoTexto.disabled = false;
          campoTexto.required = true;
        } else{
          campoTexto.disabled = true;
          campoTexto.value = '';
          campoTexto.required = false;
        }
      });
    })

    campoTexto.disabled = true;
  }

  validarCampoPossuiIrmaos(){
    const radios = document.getElementsByName('possui_irmaos');
    const campoNumerico = document.getElementById('quantidade_irmaos');

    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoNumerico.disabled = false;
          campoNumerico.required = true;
        } else{
          campoNumerico.disabled = true;
          campoNumerico.value = '0';
          campoNumerico.required = false;
        }
      });
    })

    campoNumerico.disabled = true;
  }

  validarCampoHabitaMesmaLocalidade(){
    const selects = document.querySelectorAll('.habita_mesma_localidade');
    const camposTextos = document.querySelectorAll('.local_habitacao');

    selects.forEach((select, index) => {
      const campoTexto = camposTextos[index];

      // Ativa/desativa baseado no valor selecionado
      if (select.value === '0') {
        campoTexto.disabled = false;
      } else {
        campoTexto.disabled = true;
        campoTexto.value = ''; // limpa se desativar
      }

      // Atualiza quando o valor mudar
      select.addEventListener('change', () => {
        if (select.value === '0') {
          campoTexto.disabled = false;
        } else {
          campoTexto.disabled = true;
          campoTexto.value = '';
        }
      });

    });

  }

  adicionarEventoBotoesRemocaoInstaciaFilhoMobile(){
    const botoes_remover_filho_mobile = document.getElementsByName('btnRemoverFilhoMobile');
    botoes_remover_filho_mobile.forEach(botao => {
      botao.addEventListener('click', () => {
        const id_bloco = botao.getAttribute('data-id');
        this.removerContainerInstanciaFilhoMobile(id_bloco);
      });
    })
  }

};

document.addEventListener('DOMContentLoaded', () => {
  new ValidacoesSobreFamilia();
});
