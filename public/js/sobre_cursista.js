class ValidacoesSobreCursista {
  constructor() {
    this.validarAnoNascimento();
    this.carregarValoresEstados();
    this.carregarValoresCidadesBaseadoEstadoNaturalidade();
    this.carregarValoresCidadesBaseadoEstadoResidenteAtualmente();
    this.validarAnosResideAtualmente();
    this.ativarEspecificacaoQuantidadeFilhos();
    this.ativarEspeficicacaoResidenciaFilhos();
    this.ativarEspecificacaoDadosCasamentoUniaoEstavel()
    this.ativarEspecificacaoQuantidadeCasamentos();
    this.ativacaoEspecificacaoAnosSindicalizado();
    this.ativarEspecificacaoReligiaoPraticada();
    this.ativarEspecificacaoOpcaoPartidaria();
    this.atualizarValorEscalaPolitica();
    this.desabilitarSliderEscalaPolitica();
<<<<<<< HEAD
    this.validarAusenciaCampoCompartilhaCom();
    this.validarCampoViveComFilhos();
=======

    this.validarGrupoCompartilhaCom();
    this.logicaExclusivaSozinho();
>>>>>>> lucas
  }

  validarAnoNascimento() {  
    const input = document.getElementById('ano_nascimento');

    input.addEventListener('input', () => {
      input.value = input.value.replace(/[^0-9]/g, '').slice(0, 4);
      const erroSpan = document.getElementById('erro_ano_nascimento');
      const valor = parseInt(input.value);
    
      if (input.value.length === 4) {
        if (valor < 1940 || valor > 2004) {
          erroSpan.style.display = 'inline';
          input.setCustomValidity("Ano fora do intervalo permitido.");
        } else {
          erroSpan.style.display = 'none';
          input.setCustomValidity(""); // Libera envio
        }
      }
       else {
        erroSpan.style.display = 'inline';
        input.setCustomValidity("Ano inválido.");
      }

    });
  }

  carregarValoresEstados(){
    const estado_naturalidade_select = document.getElementById('estado_naturalidade');
    const estado_reside_atualmente_select = document.getElementById('estado_reside_atualmente');
    
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
      .then(response => response.json())
      .then(estados => {
        estados.forEach(estado => {
          const option = document.createElement('option');
          option.id = estado.id
          option.value = estado.nome;
          option.textContent = estado.nome;
          estado_naturalidade_select.appendChild(option);
          estado_reside_atualmente_select.appendChild(option.cloneNode(true));
        });
      })
      .catch(error => {
        console.error('Erro ao carregar os estados:', error);
        alert('Não foi possível carregar a lista de estados.');
      }
    );

  }

  carregarValoresCidadesBaseadoEstadoNaturalidade(){
    const estado_naturalidade_select = document.getElementById('estado_naturalidade');
    const municipio_naturalidade_select = document.getElementById('municipio_naturalidade');

    estado_naturalidade_select.addEventListener('change', () => {
      const estado_selecionado = estado_naturalidade_select.options[estado_naturalidade_select.selectedIndex]
      const estadoId = estado_selecionado.id;
      municipio_naturalidade_select.innerHTML = '<option value="">Carregando cidades...</option>';
      municipio_naturalidade_select.disabled = true;
    
      if (estadoId) {
        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`)
          .then(response => response.json())
          .then(cidades => {
            municipio_naturalidade_select.innerHTML = '<option value="">Selecione uma cidade</option>';
            cidades.forEach(cidade => {
              const option = document.createElement('option');
              option.id = cidade.id
              option.value = cidade.nome;
              option.textContent = cidade.nome;
              municipio_naturalidade_select.appendChild(option);
            });
            municipio_naturalidade_select.disabled = false;
          })
          .catch(error => {
            console.error('Erro ao carregar as cidades:', error);
            alert('Não foi possível carregar a lista de cidades.');
          });
      } 
      else {
        municipio_naturalidade_select.innerHTML = '<option value="">Selecione um estado primeiro</option>';
        municipio_naturalidade_select.disabled = true;
      }
    });

  }

  carregarValoresCidadesBaseadoEstadoResidenteAtualmente(){
    const estado_reside_atualmente_select = document.getElementById('estado_reside_atualmente');
    const municipio_reside_atualmente_select = document.getElementById('municipio_reside_atualmente');
    estado_reside_atualmente_select.addEventListener('change', () => {
      const estado_selecionado = estado_reside_atualmente_select.options[estado_reside_atualmente_select.selectedIndex]
      const estadoId = estado_selecionado.id;
      municipio_reside_atualmente_select.innerHTML = '<option value="">Carregando cidades...</option>';
      municipio_reside_atualmente_select.disabled = true;

      if (estadoId) {
        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`)
          .then(response => response.json())
          .then(cidades => {
            municipio_reside_atualmente_select.innerHTML = '<option value="">Selecione uma cidade</option>';
            cidades.forEach(cidade => {
              const option = document.createElement('option');
              option.id = cidade.id
              option.value = cidade.nome;
              option.textContent = cidade.nome;
              municipio_reside_atualmente_select.appendChild(option);
            });
            municipio_reside_atualmente_select.disabled = false;
          })
          .catch(error => {
            console.error('Erro ao carregar as cidades:', error);
            alert('Não foi possível carregar a lista de cidades.');
          });
      } else {
        municipio_reside_atualmente_select.innerHTML = '<option value="">Selecione um estado primeiro</option>';
        municipio_reside_atualmente_select.disabled = true;
      }

    });
  }
  
  validarAnosResideAtualmente() {
    const input = document.getElementById('anos_reside_atualmente');
    input.addEventListener('input', () => {
      input.value = input.value.replace(/[^0-9]/g, '').slice(0, 4);
      const erroSpan = document.getElementById('erro_anos_reside_atualmente');
      const valor = parseInt(input.value);
  
      if (input.value.length > 0) {
        if (valor <= 0 || valor > 99) {
          erroSpan.style.display = 'inline';
          input.setCustomValidity("Valor Inválido");
        } else {
          erroSpan.style.display = 'none';
          input.setCustomValidity("");
        }
      } else {
        erroSpan.style.display = 'none';
        input.setCustomValidity("Valor inválido.");
      }
      
    });
  }

  ativarEspecificacaoQuantidadeFilhos(){
    const radios = document.getElementsByName('tem_filhos');
    const campoTexto = document.getElementById('quantidade_filhos');
    
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoTexto.style.display = "block";
          campoTexto.required = true;
        } else{
          campoTexto.style.display = "none";
          campoTexto.value = '';
          campoTexto.required = false;
        }
      });
    });
      
  }

  ativarEspeficicacaoResidenciaFilhos(){
    const radios = document.getElementsByName('vive_com_filhos');
    const campoTexto = document.getElementById('filhos_vivem_com');
    
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '0') {
          campoTexto.style.display = "block";
          campoTexto.required = true;
        } else{
          campoTexto.style.display = "none";
          campoTexto.value = '';
          campoTexto.required = false;
        }
      });
    });
  
  }

  ativarEspecificacaoDadosCasamentoUniaoEstavel(){
    const radios = document.getElementsByName('estado_civil');
    const quantidade_anos_casado = document.getElementById('anos_tempo_casado');
    const quantidade_anos_uniao = document.getElementById('anos_uniao_estavel');
    const data_nascimento_conjuge = document.getElementById('data_nascimento_conjuge');
    const profissao_conjuge = document.getElementById('profissao_conjuge');
    
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === 'Casado(a)'){ 
          quantidade_anos_casado.disabled = false;
          quantidade_anos_casado.required = true;
          quantidade_anos_uniao.disabled = true;
          quantidade_anos_uniao.value = '';
          quantidade_anos_uniao.required = false;
          data_nascimento_conjuge.disabled = false;
          data_nascimento_conjuge.required = true;
          profissao_conjuge.disabled = false;
          profissao_conjuge.required = true;
        } 
        else if(radio.checked && radio.value === 'União estável'){
          quantidade_anos_uniao.disabled = false;
          quantidade_anos_uniao.required = true;
          quantidade_anos_casado.disabled = true;
          quantidade_anos_casado.value = '';
          quantidade_anos_casado.required = false;
          data_nascimento_conjuge.disabled = false;
          data_nascimento_conjuge.required = true;
          profissao_conjuge.disabled = false;
          profissao_conjuge.required = true;
        }
        else{
          quantidade_anos_casado.disabled = true;
          quantidade_anos_casado.value = '';  
          quantidade_anos_casado.required = false;
          quantidade_anos_uniao.disabled = true;
          quantidade_anos_uniao.value = '';
          quantidade_anos_uniao.required = false;
          data_nascimento_conjuge.disabled = true;
          data_nascimento_conjuge.value = '';
          data_nascimento_conjuge.required = false;
          profissao_conjuge.disabled = true;
          profissao_conjuge.value = '';
          profissao_conjuge.required = false;
        }
      });
    });

    quantidade_anos_casado.disabled = true;
    quantidade_anos_uniao.disabled = true;
    data_nascimento_conjuge.disabled = true;
    profissao_conjuge.disabled = true; 
  }
  
  ativarEspecificacaoQuantidadeCasamentos(){
    const radios = document.getElementsByName('casou_varias_vezes');
    const campoTexto = document.getElementById('quantidade_casamentos');
    
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoTexto.style.display = "block";
          campoTexto.required = true;
        } else{
          campoTexto.style.display = "none";
          campoTexto.value = '';
          campoTexto.required = false;
        }
      });
    });
  
  }

  ativacaoEspecificacaoAnosSindicalizado(){
    const radios = document.getElementsByName('sindicalizado');
    const campoTexto = document.getElementById('tempo_sindicalizado');
    
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoTexto.disabled = false;
          campoTexto.required = true;
        } else{
          campoTexto.required = false;
          campoTexto.disabled = true;
        }
      });
    });
    campoTexto.disabled = true;
  }

  ativarEspecificacaoReligiaoPraticada(){
    const radios = document.getElementsByName('tem_religiao');
    const campoTexto = document.getElementById('religiao_praticada');

    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoTexto.style.display = "block";
          campoTexto.required = true;
        } else{
          campoTexto.style.display = "none";
          campoTexto.required = false;
          campoTexto.value = '';
        }
      })
    })

  }

  ativarEspecificacaoOpcaoPartidaria(){
    const radios = document.getElementsByName('tem_opcao_partidaria');
    const campoTexto = document.getElementById('opcao_partidaria');
    
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked && radio.value === '1') {
          campoTexto.style.display = "block";
          campoTexto.required = true;
        } else{
          campoTexto.style.display = "none";
          campoTexto.required = false;
          campoTexto.value = '';
        }
      });
    });
  }
  
  atualizarValorEscalaPolitica(valor) {
    const input_escala = document.getElementById('escala_politica_esquerda_direita');
    const visualizacao_valor =  document.getElementById('valor_escala');

    input_escala.addEventListener('input', () => {
      visualizacao_valor.textContent = input_escala.value;
    })

  }
  
  desabilitarSliderEscalaPolitica(marcado) {
    const checkbox_desabilitacao = document.getElementById('nao_quer_responder_escala_politica');
    const slider = document.getElementById('escala_politica_esquerda_direita');
    const output = document.getElementById('valor_escala');

    checkbox_desabilitacao.addEventListener('change', () => {
      if(checkbox_desabilitacao.checked){
        slider.disabled = true;
        output.textContent = 'Sem resposta'; 
        slider.required = false;
      }
      else{
        slider.disabled = false;
        slider.required = true;
        output.textContent = 5;
      }
    })
  }

  validarAusenciaCampoCompartilhaCom(){
    const formulario = document.getElementById("formulario_sobre_cursista");
    formulario.addEventListener("submit", () => {
      const checkboxes_compartilha_com = document.getElementsByName("compartilha_com[]");
      if(checkboxes_compartilha_com.length === 0){
        alert("Alguns valores requeridos não foram enviados, verifique e tente novamente.");
        event.preventDefault();
      }
    })
  }

<<<<<<< HEAD
  validarCampoViveComFilhos(){
    const inputs_tem_filhos = document.getElementsByName("tem_filhos");
    const inputs_vive_com_filhos = document.getElementsByName("vive_com_filhos");

    inputs_tem_filhos.forEach(input => {
      input.addEventListener("change", () => {
        if(input.checked && input.value === "1"){
          inputs_vive_com_filhos.forEach(input => {
            input.disabled = false;
            input.required = true
          })
        }
        else{
          inputs_vive_com_filhos.forEach(input => {
           input.disabled = true;
           input.required = false;
          })
        }
      })
    })

    inputs_vive_com_filhos.forEach(input => {
      input.disabled = true;
    })
        
=======
  validarGrupoCompartilhaCom() {
    // Encontra o formulário
    const form = document.querySelector('form.form-container');
    if (!form) return;

    // Adiciona um "escutador" para o evento de 'submit'
    form.addEventListener('submit', (event) => {
      
      // Pega todos os inputs do grupo "Você vive com:"
      const checkboxes = document.querySelectorAll('input[name="compartilha_com[]"][type="checkbox"]');
      const outroInput = document.getElementById('outro');
      const erroSpan = document.getElementById('erro_compartilha_com');

      let isChecked = false;
      // Verifica se algum checkbox está marcado
      checkboxes.forEach(cb => {
        if (cb.checked) isChecked = true;
      });

      // Verifica se o campo "Outro" tem algum texto
      const outroValue = outroInput.value.trim();

      // Se nenhum checkbox estiver marcado E o campo "Outro" estiver vazio
      if (!isChecked && outroValue === '') {
        // 1. Impede o envio do formulário
        event.preventDefault(); 
        
        // 2. Mostra a mensagem de erro
        if (erroSpan) erroSpan.style.display = 'block';

        // 3. (Opcional) Rola a tela até o campo para o usuário ver
        outroInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
      } else {
        // Se for válido, esconde a mensagem de erro (caso ela estivesse aparecendo)
        if (erroSpan) erroSpan.style.display = 'none';
      }
    });
  }

  logicaExclusivaSozinho() {
    // Lógica bônus para "Sozinho(a)"
    const sozinhoCheckbox = document.getElementById('sozinho');
    const outrosCheckboxes = [
      document.getElementById('familia'),
      document.getElementById('conjuge')
    ];
    const outroInput = document.getElementById('outro');

    if (!sozinhoCheckbox) return; // Sai se o elemento não for encontrado

    // Função para desmarcar "Sozinho"
    const uncheckSozinho = () => {
      sozinhoCheckbox.checked = false;
    };

    // Se marcar "Sozinho", desmarca os outros
    sozinhoCheckbox.addEventListener('change', () => {
      if (sozinhoCheckbox.checked) {
        outrosCheckboxes.forEach(cb => cb.checked = false);
        outroInput.value = '';
      }
    });

    // Se marcar qualquer outro checkbox ou digitar em "Outro", desmarca "Sozinho"
    outrosCheckboxes.forEach(cb => cb.addEventListener('change', uncheckSozinho));
    outroInput.addEventListener('input', uncheckSozinho);
>>>>>>> lucas
  }

}



document.addEventListener('DOMContentLoaded', function() {
  new ValidacoesSobreCursista();
})


