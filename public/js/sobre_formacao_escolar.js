class ValidacoesSobreFormacaoEscolar{

  constructor(){
    this.validarAnoConclusaoEnsinoFundamentalMenor();
    this.validarAnoConclusaoEnsinoFundamentalMaior();
    this.validarAnoConclusaoEnsinoMedio();
    this.adicionarEventosBotoes();
    this.validarCampofezEspecializacao();
    this.validarCampoFezCursosAperfeicoamento();
    this.validarCampoFezMestrado();
  }

  validarAnoConclusaoEnsinoFundamentalMenor(){
    const input_ano_conclusao_fundamental_menor = document.getElementById('ano_conclusao_fundamental_menor');
    input_ano_conclusao_fundamental_menor.addEventListener('input', () => {
      const valor = input_ano_conclusao_fundamental_menor.value;
      const erroSpan = input_ano_conclusao_fundamental_menor.nextElementSibling;

      if (!/^\d{4}$/.test(valor)) {
        erroSpan.textContent = 'Digite um valor com 4 dígitos.';
        erroSpan.style.display = 'inline';
        input_ano_conclusao_fundamental_menor.classList.add('is-invalid');
      } else if (parseInt(valor) < 1950 || parseInt(valor) > 2011) {
        erroSpan.textContent = 'Ano deve estar entre 1950 e 2010.';
        erroSpan.style.display = 'inline';
        input_ano_conclusao_fundamental_menor.classList.add('is-invalid');
      } else {
        erroSpan.textContent = '';
        erroSpan.style.display = 'none';
        input_ano_conclusao_fundamental_menor.classList.remove('is-invalid');
      }
    });
  }

  validarAnoConclusaoEnsinoFundamentalMaior(){
    const input_ano_conclusao_fundamental_maior = document.getElementById('ano_conclusao_fundamental_maior');

    input_ano_conclusao_fundamental_maior.addEventListener('input', () => {
      const valor = input_ano_conclusao_fundamental_maior.value;
      const erroSpan = input_ano_conclusao_fundamental_maior.nextElementSibling;

      if (!/^\d{4}$/.test(valor)) {
        erroSpan.textContent = 'Digite um valor com 4 dígitos.';
        erroSpan.style.display = 'inline';
        input_ano_conclusao_fundamental_maior.classList.add('is-invalid');
      } else if (parseInt(valor) < 1954 || parseInt(valor) > 2015) {
        erroSpan.textContent = 'Ano deve estar entre 1954 e 2014.';
        erroSpan.style.display = 'inline';
        input_ano_conclusao_fundamental_maior.classList.add('is-invalid');
      } else {
        erroSpan.textContent = '';
        erroSpan.style.display = 'none';
        input_ano_conclusao_fundamental_maior.classList.remove('is-invalid');
      }
    });
    
  }

  validarAnoConclusaoEnsinoMedio(){

    const input_ano_conclusao_ensino_medio = document.getElementById('ano_conclusao_ensino_medio');

    input_ano_conclusao_ensino_medio.addEventListener('input', () => {
      const valor = input_ano_conclusao_ensino_medio.value;
      const erroSpan = input_ano_conclusao_ensino_medio.nextElementSibling;

      if (!/^\d{4}$/.test(valor)) {
        erroSpan.textContent = 'Digite um valor com 4 dígitos.';
        erroSpan.style.display = 'inline';
        input_ano_conclusao_ensino_medio.classList.add('is-invalid');
      } else if (parseInt(valor) < 1957 || parseInt(valor) > 2018) {
        erroSpan.textContent = 'Ano deve estar entre 1957 e 2018.';
        erroSpan.style.display = 'inline';
        input_ano_conclusao_ensino_medio.classList.add('is-invalid');
      } else {
        erroSpan.textContent = '';
        erroSpan.style.display = 'none';
        input_ano_conclusao_ensino_medio.classList.remove('is-invalid');
      }
    });
   
  }

  adicionarEventosBotoes(){
    botao_adicionar_informacao_graduacao = document.getElementById('botao_adicionar_informacao_graduacao');
    botao_adicionar_informacao_graduacao_mobile = document.getElementById('botao_adicionar_informacao_graduacao_mobile');
    botao_remover_informacao_graduacao = document.getElementById('botao_remover_informacao_graduacao');
    botao_adicionar_informacao_especializacao = document.getElementById('botao_adicionar_informacao_especializacao');
    botao_adicionar_informacao_especializacao_mobile = document.getElementById('botao_adicionar_informacao_especializacao_mobile');
    botao_remover_informacao_especializacao = document.getElementById('botao_remover_informacao_especializacao');

    if(botao_adicionar_informacao_graduacao && botao_remover_informacao_graduacao
      && botao_adicionar_informacao_especializacao && botao_remover_informacao_especializacao && botao_adicionar_informacao_graduacao_mobile &&
      botao_adicionar_informacao_especializacao_mobile
    ){
      botao_adicionar_informacao_graduacao.addEventListener('click', this.adicionarLinhaInformacaoGraduacao.bind(this));
      botao_adicionar_informacao_graduacao_mobile.addEventListener('click', this.adicionarLinhaInformacaoGraduacaoMobile.bind(this));
      botao_remover_informacao_graduacao.addEventListener('click', this.removerUltimaLinhaInformacaoGraduacao.bind(this));
      botao_adicionar_informacao_especializacao.addEventListener('click', this.adicionarLinhaInformacaoEspecializacao.bind(this));
      botao_adicionar_informacao_especializacao_mobile.addEventListener('click', this.adicionarLinhaInformacaoEspecializacaoMobile.bind(this));
      botao_remover_informacao_especializacao.addEventListener('click', this.removerUltimaLinhaInformacaoEspecializacao.bind(this));  
    }
    else{
      window.alert("Não foi possível adicionar o evento de clique aos botões da página.");
    }

  }

  adicionarLinhaInformacaoGraduacao() {
      const tabela = document.querySelector('#InformacaoGraduacao tbody');
      const novaLinha = document.createElement('tr');
      novaLinha.innerHTML = `
        <tr>
            <td><input type="text" name="nome_instituicao_graduacao[]" class="form-control" required></td>
            <td><input type="text" name="curso_graduacao[]" class="form-control" required></td>
            <td>
                <select name="modalidade_graduacao[]" class="form-select" required>
                  <option value="">Selecione</option>
                  <option value="Presencial">Presencial</option>
                  <option value="EAD">EAD</option>
                </select>
            </td>

            <td>
                <select name="tipo_instituicao_graduacao[]" class="form-select" required>
                  <option value="">Selecione</option>
                  <option value="Publica">Publica</option>
                  <option value="Privada">Privada</option>
                </select>
            </td>

            <td>
              <div class="mb-2">
                <div class="form-check">
                  <label for="foi_bolsista_graduacao" class="form-check-label">Sim</label>
                  <input type="radio"  name="foi_bolsista_graduacao[]" class="form-check-input" value="1">
                </div>

                <div class="form-check">
                  <label for="foi_bolsista_graduacao" class="form-check-label">Não</label>
                  <input type="radio"  name="foi_bolsista_graduacao[]" class="form-check-input" value="0" required>
                <div>

              </div>

            </td>

            <td>
              <input
                  type="number"
                  class="form-control"
                  name="ano_conclusao_graduacao[]"
              />
            </td>

        </tr>
      `;
      tabela.appendChild(novaLinha);
  }

  adicionarLinhaInformacaoGraduacaoMobile(){
    const container = document.getElementById('accordionGraduacao');
    const id_container = container.childElementCount;
    container.innerHTML += ` 
      <div class="accordion-item">

        <h2 class="accordion-header" id="headingGraduacao-${id_container}">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGraduacao-${id_container}" aria-expanded="true" aria-controls="collapseGraduacao-${id_container}">
            Curso de Graduação ${id_container + 1}
          </button>
        </h2>
        
        <div id="collapseGraduacao-${id_container}" class="accordion-collapse collapse show" aria-labelledby="headingGraduacao-${id_container}" data-bs-parent="#accordionGraduacao">
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

            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.accordion-item').remove()">Excluir valor</button>
            </div>

          </div>

        </div>

      </div>

    `;
  }

  adicionarLinhaInformacaoEspecializacao() {
    const tabela = document.querySelector('#InformacaoEspecializacao tbody');
    const novaLinha = document.createElement('tr');
    novaLinha.innerHTML = `
      <tr>
        <td><input type="text" name="nome_instituicao_especializacao[]" class="form-control nome_instituicao_especializacao" required></td>
        <td><input type="text" name="curso_especializacao[]" class="form-control curso_especializacao" required></td>
        <td>
            <select name="modalidade_especializacao[]" class="form-select modalidade_especializacao" required>
              <option value="">Selecione</option>
              <option value="Presencial">Presencial</option>
              <option value="EAD">EAD</option>
            </select>
        </td>

        <td>
            <select name="tipo_instituicao_especializacao[]" class="form-select tipo_instituicao_especializacao" required>
              <option value="">Selecione</option>
              <option value="Publica">Publica</option>
              <option value="Privada">Privada</option>
            </select>
        </td>

        <td>
          <div class="mb-2">
            <div class="form-check">
              <label for="foi_bolsista_especializacao" class="form-check-label">Sim</label>
              <input type="radio"  name="foi_bolsista_especializacao[]" class="form-check-input foi_bolsista_especializacao" value="1">
            </div>

            <div class="form-check">
              <label for="foi_bolsista_especializacao" class="form-check-label">Não</label>
              <input type="radio"  name="foi_bolsista_especializacao[]" class="form-check-input foi_bolsista_especializacao" value="0" required>
            <div>

          </div>

        </td>

        <td>
          <input
              type="number"
              class="form-control ano_ingresso_especializacao"
              name="ano_ingresso_especializacao[]"
              required
          />
        </td>

        <td>
          <input
              type="number"
              class="form-control ano_conclusao_especializacao"
              name="ano_conclusao_especializacao[]"
          />
        </td>

      </tr>
    `;
    tabela.appendChild(novaLinha);
  }

  adicionarLinhaInformacaoEspecializacaoMobile(){
    const container = document.getElementById('accordionEspecializacao');
    const id_container = container.childElementCount;
    container.innerHTML += ` 
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingEspecializacao-${id_container}">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEspecializacao-${id_container}" aria-expanded="true" aria-controls="collapseEspecializacao-${id_container}">
            Curso de Especialização ${id_container +  1}
          </button>
        </h2>
        
        <div id="collapseEspecializacao-${id_container}" class="accordion-collapse collapse show" aria-labelledby="headingEspecializacao-${id_container}" data-bs-parent="#accordionEspecializacao">
          
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

              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.accordion-item').remove()">Excluir valor</button>
              </div>

            </div>

          </div>
      
        </div>
    
      </div>
   `;
  }


  removerUltimaLinhaInformacaoGraduacao() {
    const tabela = document.querySelector('#InformacaoGraduacao tbody');
    const linhas = tabela.querySelectorAll('tr');
    if (linhas.length > 1) {
        tabela.removeChild(linhas[linhas.length - 1]);
    }
  }

  removerUltimaLinhaInformacaoEspecializacao() {
    const tabela = document.querySelector('#InformacaoEspecializacao tbody');
    const linhas = tabela.querySelectorAll('tr');
    if (linhas.length > 1) {
        tabela.removeChild(linhas[linhas.length - 1]);
    }
  }

  validarCampofezEspecializacao(){
    const radios = document.getElementsByName('fez_especializacao');
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        const camposTabela = [
          ...document.querySelectorAll('.nome_instituicao_especializacao'),
          ...document.querySelectorAll('.curso_especializacao'),
          ...document.querySelectorAll('.modalidade_especializacao'),
          ...document.querySelectorAll('.tipo_instituicao_especializacao'),
          ...document.querySelectorAll('.foi_bolsista_especializacao'),
          ...document.querySelectorAll('.ano_ingresso_especializacao'),
          ...document.querySelectorAll('.ano_conclusao_especializacao'),
          botao_adicionar_informacao_especializacao = document.getElementById('botao_adicionar_informacao_especializacao'),
          botao_adicionar_informacao_especializacao_mobile = document.getElementById('botao_adicionar_informacao_especializacao_mobile'),
          botao_remover_informacao_especializacao = document.getElementById('botao_remover_informacao_especializacao'),
          quantidade_especializacoes = document.getElementById('quantidade_especializacoes'),
        ]

        if (radio.checked && radio.value === '1') {
          camposTabela.forEach(campo => {
            campo.disabled = false;
          })
        } else{
          camposTabela.forEach(campo => {
            campo.disabled = true;
            campo.value = '';
          })
        }
      });
    });

    const camposIniciaisTabela = [
      ...document.querySelectorAll('.nome_instituicao_especializacao'),
      ...document.querySelectorAll('.curso_especializacao'),
      ...document.querySelectorAll('.modalidade_especializacao'),
      ...document.querySelectorAll('.tipo_instituicao_especializacao'),
      ...document.querySelectorAll('.foi_bolsista_especializacao'),
      ...document.querySelectorAll('.ano_ingresso_especializacao'),
      ...document.querySelectorAll('.ano_conclusao_especializacao'),
      botao_adicionar_informacao_especializacao = document.getElementById('botao_adicionar_informacao_especializacao'),
      botao_adicionar_informacao_especializacao_mobile = document.getElementById('botao_adicionar_informacao_especializacao_mobile'),
      botao_remover_informacao_especializacao = document.getElementById('botao_remover_informacao_especializacao'),
      quantidade_especializacoes = document.getElementById('quantidade_especializacoes'),
    ];

    camposIniciaisTabela.forEach(campo => {
      campo.disabled = true;
    })
  }

  validarCampoFezCursosAperfeicoamento(){
    const radios = document.getElementsByName('fez_curso_aperfeicoamento');
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        const camposTabela = [  
        ...document.querySelectorAll('.nome_instituicao_aperfeicoamento'),
        ...document.querySelectorAll('.curso_aperfeicoamento'),
        ...document.querySelectorAll('.modalidade_aperfeicoamento'),
        ...document.querySelectorAll('.tipo_instituicao_aperfeicoamento'),
        ...document.querySelectorAll('.foi_bolsista_aperfeicoamento'),
        ...document.querySelectorAll('.carga_horaria_aperfeicoamento'),
        ...document.querySelectorAll('.ano_ingresso_aperfeicoamento'),
        ...document.querySelectorAll('.ano_conclusao_aperfeicoamento'),
        quantidade_cursos_aperfeicoamento = document.getElementById('quantidade_cursos_aperfeicoamento'),
        ];

        if (radio.checked && radio.value === '1') {
          camposTabela.forEach(campo => {
            campo.disabled = false;
          })
        } else{
          camposTabela.forEach(campo => {
            campo.disabled = true;
            campo.value = '';
          })
        }
      });
    });

    const camposIniciaisTabela = [  
      ...document.querySelectorAll('.nome_instituicao_aperfeicoamento'),
      ...document.querySelectorAll('.curso_aperfeicoamento'),
      ...document.querySelectorAll('.modalidade_aperfeicoamento'),
      ...document.querySelectorAll('.tipo_instituicao_aperfeicoamento'),
      ...document.querySelectorAll('.foi_bolsista_aperfeicoamento'),
      ...document.querySelectorAll('.carga_horaria_aperfeicoamento'),
      ...document.querySelectorAll('.ano_ingresso_aperfeicoamento'),
      ...document.querySelectorAll('.ano_conclusao_aperfeicoamento'),
      quantidade_cursos_aperfeicoamento = document.getElementById('quantidade_cursos_aperfeicoamento'),
    ]
    camposIniciaisTabela.forEach(campo => {
      campo.disabled = true;
    })
  }

  validarCampoFezMestrado(){
    const radios = document.getElementsByName('fez_mestrado');
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        const camposTabela = [  
          ...document.querySelectorAll('.nome_instituicao_mestrado'),
          ...document.querySelectorAll('.curso_mestrado'),
          ...document.querySelectorAll('.modalidade_mestrado'),
          ...document.querySelectorAll('.tipo_instituicao_mestrado'),
          ...document.querySelectorAll('.foi_bolsista_mestrado'),
          ...document.querySelectorAll('.ano_ingresso_mestrado'),
          ...document.querySelectorAll('.ano_conclusao_mestrado'),
        ];

        if (radio.checked && radio.value === '1') {
          camposTabela.forEach(campo => {
            campo.disabled = false;
          })
        }
        else{
          camposTabela.forEach(campo => {
            campo.disabled = true;
            campo.value = '';
            campo.checked = false;
          })
        }

      });
    
    });

    const camposIniciaisTabela = [  
      ...document.querySelectorAll('.nome_instituicao_mestrado'),
      ...document.querySelectorAll('.curso_mestrado'),
      ...document.querySelectorAll('.modalidade_mestrado'),
      ...document.querySelectorAll('.tipo_instituicao_mestrado'),
      ...document.querySelectorAll('.foi_bolsista_mestrado'),
      ...document.querySelectorAll('.ano_ingresso_mestrado'),
      ...document.querySelectorAll('.ano_conclusao_mestrado'),
    ];
    camposIniciaisTabela.forEach(campo => {
      campo.disabled = true;
    })
  
  }

}

document.addEventListener("DOMContentLoaded", () => {
    new ValidacoesSobreFormacaoEscolar();
})
