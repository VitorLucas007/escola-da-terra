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
    if (!input_ano_conclusao_fundamental_menor) return;
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
    if (!input_ano_conclusao_fundamental_maior) return;
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
    if (!input_ano_conclusao_ensino_medio) return;
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
    const btnAddGraduacao = document.getElementById('botao_adicionar_informacao_graduacao');
    if (btnAddGraduacao) {
      btnAddGraduacao.addEventListener('click', this.adicionarLinhaInformacaoGraduacao.bind(this));
    }

    const btnAddGraduacaoMobile = document.getElementById('botao_adicionar_informacao_graduacao_mobile');
    if (btnAddGraduacaoMobile) {
      btnAddGraduacaoMobile.addEventListener('click', this.adicionarLinhaInformacaoGraduacaoMobile.bind(this));
    }

    const btnRemoverGraduacao = document.getElementById('botao_remover_informacao_graduacao');
    if (btnRemoverGraduacao) {
      btnRemoverGraduacao.addEventListener('click', this.removerUltimaLinhaInformacaoGraduacao.bind(this));
    }

    const btnAddEspecializacao = document.getElementById('botao_adicionar_informacao_especializacao');
    if (btnAddEspecializacao) {
      btnAddEspecializacao.addEventListener('click', this.adicionarLinhaInformacaoEspecializacao.bind(this));
    }

    const btnAddEspecializacaoMobile = document.getElementById('botao_adicionar_informacao_especializacao_mobile');
    if (btnAddEspecializacaoMobile) {
      btnAddEspecializacaoMobile.addEventListener('click', this.adicionarLinhaInformacaoEspecializacaoMobile.bind(this));
    }

    const btnRemoverEspecializacao = document.getElementById('botao_remover_informacao_especializacao');
    if (btnRemoverEspecializacao) {
      btnRemoverEspecializacao.addEventListener('click', this.removerUltimaLinhaInformacaoEspecializacao.bind(this));
    }
  }

  adicionarLinhaInformacaoGraduacao() {
      const tabela = document.querySelector('#InformacaoGraduacao tbody');
      if (!tabela) return;
      const numeroLinhas = tabela.rows.length;
      const novaLinha = document.createElement('tr');
      novaLinha.innerHTML = `
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
              <label class="form-check-label">Sim</label>
              <input type="radio" name="foi_bolsista_graduacao_${numeroLinhas}" class="form-check-input" value="1">
            </div>
            <div class="form-check">
              <label class="form-check-label">Não</label>
              <input type="radio" name="foi_bolsista_graduacao_${numeroLinhas}" class="form-check-input" value="0" required>
            </div>
          </div>
        </td>
        <td>
          <input type="number" class="form-control" name="ano_conclusao_graduacao[]" />
        </td>
      `;
      tabela.appendChild(novaLinha);
  }

  adicionarLinhaInformacaoGraduacaoMobile(){
    const container = document.getElementById('accordionGraduacao');
    if (!container) return;
    const id_container = container.children.length;
    const novoItem = document.createElement('div');
    novoItem.classList.add('accordion-item');
    novoItem.innerHTML = ` 
        <h2 class="accordion-header" id="headingGraduacao-${id_container}">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGraduacao-${id_container}" aria-expanded="true" aria-controls="collapseGraduacao-${id_container}">
            Curso de Graduação ${id_container + 1}
          </button>
        </h2>
        <div id="collapseGraduacao-${id_container}" class="accordion-collapse collapse show" aria-labelledby="headingGraduacao-${id_container}" data-bs-parent="#accordionGraduacao">
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
              <label class="form-label">Modalidade</label>
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
                <input class="form-check-input" type="radio" name="foi_bolsista_graduacao_mobile_${id_container}" value="1">
                <label class="form-check-label">Sim</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="foi_bolsista_graduacao_mobile_${id_container}" value="0" required>
                <label class="form-check-label">Não</label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Ano de conclusão <small class="text-muted">(Opcional)</small></label>
              <input type="number" name="ano_conclusao_graduacao[]" class="form-control" min="1900" max="2100">
            </div>
            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.accordion-item').remove()">Excluir</button>
            </div>
          </div>
        </div>
    `;
    container.appendChild(novoItem);
  }

  adicionarLinhaInformacaoEspecializacao() {
    const tabela = document.querySelector('#InformacaoEspecializacao tbody');
    if (!tabela) return;
    const numeroLinhas = tabela.rows.length;
    const novaLinha = document.createElement('tr');
    novaLinha.innerHTML = `
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
            <label class="form-check-label">Sim</label>
            <input type="radio" name="foi_bolsista_especializacao_${numeroLinhas}" class="form-check-input foi_bolsista_especializacao" value="1">
          </div>
          <div class="form-check">
            <label class="form-check-label">Não</label>
            <input type="radio" name="foi_bolsista_especializacao_${numeroLinhas}" class="form-check-input foi_bolsista_especializacao" value="0" required>
          </div>
        </div>
      </td>
      <td>
        <input type="number" class="form-control ano_ingresso_especializacao" name="ano_ingresso_especializacao[]" required />
      </td>
      <td>
        <input type="number" class="form-control ano_conclusao_especializacao" name="ano_conclusao_especializacao[]" />
      </td>
    `;
    tabela.appendChild(novaLinha);
  }

  adicionarLinhaInformacaoEspecializacaoMobile(){
    const container = document.getElementById('accordionEspecializacao');
    if (!container) return;
    const id_container = container.children.length;
    const novoItem = document.createElement('div');
    novoItem.classList.add('accordion-item');
    novoItem.innerHTML = ` 
      <h2 class="accordion-header" id="headingEspecializacao-${id_container}">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEspecializacao-${id_container}" aria-expanded="true" aria-controls="collapseEspecializacao-${id_container}">
          Curso de Especialização ${id_container +  1}
        </button>
      </h2>
      <div id="collapseEspecializacao-${id_container}" class="accordion-collapse collapse show" aria-labelledby="headingEspecializacao-${id_container}" data-bs-parent="#accordionEspecializacao">
        <div class="accordion-body">
            <div class="mb-3">
              <label class="form-label">Nome da instituição</label>
              <input type="text" name="nome_instituicao_especializacao[]" class="form-control nome_instituicao_especializacao" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Curso</label>
              <input type="text" name="curso_especializacao[]" class="form-control curso_especializacao" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Modalidade</label>
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
                <input class="form-check-input foi_bolsista_especializacao" type="radio" name="foi_bolsista_especializacao_mobile_${id_container}" value="1">
                <label class="form-check-label">Sim</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input foi_bolsista_especializacao" type="radio" name="foi_bolsista_especializacao_mobile_${id_container}" value="0" required>
                <label class="form-check-label">Não</label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Ano de ingresso</label>
              <input type="number" name="ano_ingresso_especializacao[]" class="form-control ano_ingresso_especializacao" min="1900" max="2100" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Ano de conclusão <small class="text-muted">(Opcional)</small></label>
              <input type="number" name="ano_conclusao_especializacao[]" class="form-control ano_conclusao_especializacao" min="1900" max="2100">
            </div>
            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.accordion-item').remove()">Excluir</button>
            </div>
          </div>
        </div>
      </div>
   `;
    container.appendChild(novoItem);
  }

  removerUltimaLinhaInformacaoGraduacao() {
    const tabela = document.querySelector('#InformacaoGraduacao tbody');
    if (tabela && tabela.rows.length > 1) {
        tabela.deleteRow(-1);
    }
  }

  removerUltimaLinhaInformacaoEspecializacao() {
    const tabela = document.querySelector('#InformacaoEspecializacao tbody');
    if (tabela && tabela.rows.length > 1) {
        tabela.deleteRow(-1);
    }
  }

  _gerenciarCampos(campos, habilitar) {
    campos.forEach(seletor => {
      document.querySelectorAll(seletor).forEach(campo => {
        if (campo) {
          campo.disabled = !habilitar;
          if (!habilitar) {
            if (campo.type === 'radio' || campo.type === 'checkbox') {
              campo.checked = false;
            } else {
              campo.value = '';
            }
          }
        }
      });
    });
  }

  validarCampofezEspecializacao() {
    const campos = ['.nome_instituicao_especializacao', '.curso_especializacao', '.modalidade_especializacao', '.tipo_instituicao_especializacao', '.foi_bolsista_especializacao', '.ano_ingresso_especializacao', '.ano_conclusao_especializacao', '#botao_adicionar_informacao_especializacao', '#botao_adicionar_informacao_especializacao_mobile', '#botao_remover_informacao_especializacao', '#quantidade_especializacoes'];
    document.getElementsByName('fez_especializacao').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this._gerenciarCampos(campos, e.target.value === '1');
      });
    });
    this._gerenciarCampos(campos, false); // Estado inicial
  }

  validarCampoFezCursosAperfeicoamento() {
    const campos = ['.nome_instituicao_aperfeicoamento', '.curso_aperfeicoamento', '.modalidade_aperfeicoamento', '.tipo_instituicao_aperfeicoamento', '.foi_bolsista_aperfeicoamento', '.carga_horaria_aperfeicoamento', '.ano_ingresso_aperfeicoamento', '.ano_conclusao_aperfeicoamento', '#quantidade_cursos_aperfeicoamento'];
    document.getElementsByName('fez_curso_aperfeicoamento').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this._gerenciarCampos(campos, e.target.value === '1');
      });
    });
    this._gerenciarCampos(campos, false); // Estado inicial
  }

  validarCampoFezMestrado() {
    const campos = ['.nome_instituicao_mestrado', '.curso_mestrado', '.modalidade_mestrado', '.tipo_instituicao_mestrado', '.foi_bolsista_mestrado', '.ano_ingresso_mestrado', '.ano_conclusao_mestrado'];
    document.getElementsByName('fez_mestrado').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this._gerenciarCampos(campos, e.target.value === '1');
      });
    });
    this._gerenciarCampos(campos, false); // Estado inicial
  }
}

document.addEventListener("DOMContentLoaded", () => {
    new ValidacoesSobreFormacaoEscolar();
});