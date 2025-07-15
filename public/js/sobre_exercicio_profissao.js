class ValidacoesSobreExercicioProfissao{
    constructor(){
        this.ativarCampoEspecificacaoDoencaOriundaDocenca();
        this.ativarCampoEspecificacaoOutroBeneficioOriundoDocencia();
        this.ativarContadorInterativoCampoComentariosNoticiarios();
        this.ativarCampoEspecificacaoCasoAgressaoEscola();    
        this.ativarCampoEspecificacaoCasoBullyngEscola();
        this.ativarCampoEspecificacaoOutraFonteStress();
        this.ativarCampoEspecificacaoOutraBeneficioRecebidoSalario();
        this.ativarCampoEspecificacaoProfissaoMudanca();
    }
    
    ativarCampoEspecificacaoDoencaOriundaDocenca(){
        const checkboxes = document.getElementsByName('doenca_oriunda_docencia');
        const campoDoenca = document.getElementById('campo_qual_doenca');
        const inputDoenca = document.getElementById('descricao_doenca');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (checkbox.value === '1') {
                    campoDoenca.style.display = 'block';
                    inputDoenca.required = true;
                } else {
                    campoDoenca.style.display = 'none';
                    inputDoenca.value = '';
                    inputDoenca.required = false;
                }
            });
        });

    }

    ativarCampoEspecificacaoOutroBeneficioOriundoDocencia(){
        const checkboxOutra = document.getElementById('outra_formacao');
        const campoOutro = document.getElementById('campo_outro_beneficio');
        const inputOutro = document.getElementById('beneficio_docencia_outro');

        checkboxOutra.addEventListener('change', function () {
            if (this.checked) {
                campoOutro.style.display = 'block';
                inputOutro.required = true;
            } else {
                campoOutro.style.display = 'none';
                inputOutro.value = '';
                inputOutro.required = false;
            }
        });
    }

    ativarContadorInterativoCampoComentariosNoticiarios(){
        const textarea = document.getElementById('comentarios_injustos');
        const contador = document.getElementById('contador-caracteres');

        textarea.addEventListener('input', function () {
            contador.textContent = this.value.length;
        });
    }

    ativarCampoEspecificacaoCasoAgressaoEscola(){
        const radios = document.getElementsByName('sofreu_agressao_na_escola');
        const campoTexto = document.getElementById('campo_providencia_tomada_agressao');
        const inputTexto = document.getElementById('providencia_tomada_agressao');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === '1') {
                    campoTexto.style.display = "block";
                    inputTexto.required = true;
                } else{
                    campoTexto.style.display = "none";
                    inputTexto.value = '';
                    inputTexto.required = false;
                }
            });
        })

    }

    ativarCampoEspecificacaoCasoBullyngEscola(){
        const radios = document.getElementsByName('houve_caso_bullying');
        const campoTexto = document.getElementById('campo_providencia_tomada_bullying');
        const inputTexto = document.getElementById('providencia_tomada_bullying');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === '1') {
                    campoTexto.style.display = "block";
                    inputTexto.required = true;
                } else{
                    campoTexto.style.display = "none";
                    inputTexto.value = '';
                    inputTexto.required = false;
                }
            });
        })
    }

    ativarCampoEspecificacaoOutraFonteStress(){
        const checkbox_outra_fonte = document.getElementById('stress_outro');
        const campo_outra_fonte = document.getElementById('campo_outra_fonte_stress');

        checkbox_outra_fonte.addEventListener('change', function () {
            if (this.checked) {
                campo_outra_fonte.style.display = 'block';
                campo_outra_fonte.required = true;
            } else {
                campo_outra_fonte.style.display = 'none';
                campo_outra_fonte.value = '';
                campo_outra_fonte.required = false;
            }
        });

    }

    ativarCampoEspecificacaoOutraBeneficioRecebidoSalario(){
        const checkbox_outro = document.getElementById('beneficio_outro');
        const compo_outro_beneficio = document.getElementById('campo_descricao_beneficio_outro');

        checkbox_outro.addEventListener('change', function () {
            if (this.checked) {
                compo_outro_beneficio.style.display = 'block';
                compo_outro_beneficio.required = true;
            } else {
                compo_outro_beneficio.style.display = 'none';
                compo_outro_beneficio.value = '';
                compo_outro_beneficio.required = false;
            }
        });

    }

    ativarCampoEspecificacaoProfissaoMudanca(){
        const radios = document.getElementsByName('mudaria_de_profissao');
        const campoTexto = document.getElementById('campo_profissao_mudanca');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === "1") {
                    campoTexto.style.display = 'block';
                    document.getElementById('profissao_mudanca').required = true;
                } else {
                    campoTexto.style.display = 'none';
                    document.getElementById('profissao_mudanca').value = '';
                    document.getElementById('profissao_mudanca').required = false;
                }
            });
        });
    }


}

document.addEventListener('DOMContentLoaded', () => {
  new ValidacoesSobreExercicioProfissao();
});