class ValidacoesSobreCondicaoEstudo{
    constructor(){
        this.ativarCampoEspecificacaoLocalBibliotecaFrequentada();
        this.ativarCampoEspecificacaoOutraCategoriaLivroFrequente();
        this.ativarCampoEspecificacaoOutroLocalAcessoInternet();
    }

    ativarCampoEspecificacaoLocalBibliotecaFrequentada(){
        const radios = document.getElementsByName('frequenta_biblioteca');
        const campoTexto = document.getElementById('local_biblioteca_frequentada');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === "1") {
                    campoTexto.style.display = 'block';
                    document.getElementById('local_biblioteca_frequentada').required = true;
                } else {
                    campoTexto.style.display = 'none';
                    document.getElementById('local_biblioteca_frequentada').value = '';
                    document.getElementById('local_biblioteca_frequentada').required = false;
                }
            });
        });
    }

    ativarCampoEspecificacaoOutraCategoriaLivroFrequente(){
        const checkbox = document.getElementById('categoria_livros_frequente_outro');
        const campoTexto = document.getElementById('especificacao_outra_categoria');
    
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


    ativarCampoEspecificacaoOutroLocalAcessoInternet(){
        const checkbox = document.getElementById('local_acesso_outro');
        const campoTexto = document.getElementById('local_acesso_especificacao');
    
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


}


document.addEventListener('DOMContentLoaded', () => {
    new ValidacoesSobreCondicaoEstudo();
})