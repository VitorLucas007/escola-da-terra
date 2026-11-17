class ValidacoesSobreVidaGeral{
    constructor(){
        this.ativarCampoEspecificacaoPlanoSaude();
        this.ativarCampoEspecificacaoQuantidadeCigarrosDia();
        this.ativarEspecificacaoFrequenciaBebidaAlcolica();
        this.ativarEspecificacaoRazaoAlimentacaoDesequilibrada();
        this.ativarCampoEspecificacaoOutraRazaoAlimentacaoDesequilibrada();
        this.ativarEspecificacaoOutraAtividadeForaTrabalho();
        this.validarGruposCheckboxMultivalorados();
    }

    ativarCampoEspecificacaoPlanoSaude(){
        const radios = document.getElementsByName('tem_plano_saude');
        const campoTexto = document.getElementById('plano_saude');
        
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === "1") {
                    campoTexto.style.display = 'block';
                    document.getElementById('plano_saude').required = true;
                } else {
                    campoTexto.style.display = 'none';
                    document.getElementById('plano_saude').value = '';
                    document.getElementById('plano_saude').required = false;
                }
            });
        });
        
    }
    
    ativarCampoEspecificacaoQuantidadeCigarrosDia(){
        const radios = document.getElementsByName('usa_cigarro');
        const campoTexto = document.getElementById('quantidade_cigarros_dia');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === "Todos os dias") {
                    campoTexto.style.display = 'block';
                    document.getElementById('quantidade_cigarros_dia').required = true;
                } else {
                    campoTexto.style.display = 'none';
                    document.getElementById('quantidade_cigarros_dia').value = '';
                    document.getElementById('quantidade_cigarros_dia').required = false;
                }
            });
        });
    }

    ativarEspecificacaoFrequenciaBebidaAlcolica(){
        const radios = document.getElementsByName('bebe_alcool');
        const tabela_especificacao = document.getElementById('frequenciaBebidaContainer');
        const inputsVinho = document.getElementsByName('nivel_frequencia_vinho');
        const inputsCerveja = document.getElementsByName('nivel_frequencia_cerveja');
        const inputsCachaca = document.getElementsByName('nivel_frequencia_cachaca');
        const input_vinho_todo_dia = document.getElementById('vinho_todo_dia');
        const input_cerveja_todo_dia = document.getElementById('cerveja_todo_dia');
        const input_cachaca_todo_dia = document.getElementById('cachaca_todo_dia');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === "1") {
                    tabela_especificacao.style.display = 'block';
                    input_vinho_todo_dia.required = true;
                    input_cerveja_todo_dia.required = true;
                    input_cachaca_todo_dia.required = true;
                } else {
                    tabela_especificacao.style.display = 'none';
                    inputsVinho.forEach(input => {
                        input.checked = false;
                    })
                    inputsCerveja.forEach(input => {
                        input.checked = false;
                    })
                    inputsCachaca.forEach(input => {
                        input.checked = false;
                    })
                    input_vinho_todo_dia.required = false;
                    input_cerveja_todo_dia.required = false;
                    input_cachaca_todo_dia.required = false;
                }
            });
        });
    }

    ativarEspecificacaoRazaoAlimentacaoDesequilibrada(){
        const radios = document.getElementsByName('tem_alimentacao_equilibrada');
        const tabela_especificacao = document.getElementById('causaDesequilibrioContainer');
        const inputs_especificacao = document.getElementsByName('descricao_razao[]');
        const inputs_especificacao_outra_razao = document.getElementById('input_outra_razao');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === "0") {
                    tabela_especificacao.style.display = 'block';
                } else {
                    tabela_especificacao.style.display = 'none';
                    inputs_especificacao.forEach(input => {
                        input.checked = false;
                    })
                    inputs_especificacao_outra_razao.checked = false;
                    this.mudarAtributosCampoEspecificacaoOutraRazaoAlimentacaoDesequilibrada();
                }
            });
        });

    }

    ativarCampoEspecificacaoOutraRazaoAlimentacaoDesequilibrada(){
        const checkbox = document.getElementById('input_outra_razao');
        const campoTexto = document.getElementById('descricao_outra_razao');
        
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                campoTexto.style.display = 'block';
                campoTexto.required = true;
            } else {
                this.mudarAtributosCampoEspecificacaoOutraRazaoAlimentacaoDesequilibrada();
            }
        });
        
    }

    mudarAtributosCampoEspecificacaoOutraRazaoAlimentacaoDesequilibrada(){
        const campo = document.getElementById('descricao_outra_razao');
        campo.required = false;
        campo.style.display = 'none';
        campo.value = '';
    }

    ativarEspecificacaoOutraAtividadeForaTrabalho(){
        const checkbox = document.getElementById('outra_atividade');
        const campoTexto = document.getElementById('campo_outra_atividade');
        
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                campoTexto.style.display = 'block';
                campoTexto.required = true;
            } else {
                campoTexto.style.display = 'none';
                campoTexto.value = '';
                campoTexto.required = false;
            }
        });
    }

    validarGruposCheckboxMultivalorados(){
        const form = document.querySelector('form.form-container');
        if (!form) return;

        form.addEventListener('submit', (e) => {
            const problemaMarcado = Array.from(
                document.querySelectorAll('input[type="checkbox"][name="descricao_problema[]"]')
            ).some(cb => cb.checked);

            const atividadeMarcada = Array.from(
                document.querySelectorAll('input[type="checkbox"][name="descricao_atividade[]"]')
            ).some(cb => cb.checked) || document.getElementById('outra_atividade')?.checked;

            if (!problemaMarcado) {
                e.preventDefault();
                alert('Selecione ao menos uma opção em "Ao longo das últimas semanas, você diria que...".');
                return;
            }

            if (!atividadeMarcada) {
                e.preventDefault();
                alert('Selecione ao menos uma opção em "Fora do trabalho você faz...".');
                return;
            }

            const alimentacaoNao = document.querySelector('input[type="radio"][name="tem_alimentacao_equilibrada"]:checked')?.value === '0';
            if (alimentacaoNao) {
                const razaoMarcada = Array.from(
                    document.querySelectorAll('input[type="checkbox"][name="descricao_razao[]"]')
                ).some(cb => cb.checked) || document.getElementById('input_outra_razao')?.checked;

                if (!razaoMarcada) {
                    e.preventDefault();
                    alert('Selecione ao menos uma opção em "Por qual razão?" (alimentação não equilibrada).');
                    return;
                }
            }
        });
    }

}

document.addEventListener('DOMContentLoaded', () => {
    new ValidacoesSobreVidaGeral();
})