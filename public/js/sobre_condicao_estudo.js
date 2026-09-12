class ValidacoesSobreCondicaoEstudo {
    constructor() {
        this.ativarCampoEspecificacaoLocalBibliotecaFrequentada();
        this.ativarCampoEspecificacaoOutraCategoriaLivroFrequente();
        this.ativarCampoEspecificacaoOutroLocalAcessoInternet();
        this.configurarValidacaoCheckboxes();
    }

    ativarCampoEspecificacaoLocalBibliotecaFrequentada() {
        const radios = document.getElementsByName('frequenta_biblioteca');
        const campoTexto = document.getElementById('local_biblioteca_frequentada');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === "1") {
                    campoTexto.style.display = 'block';
                    campoTexto.required = true;
                } else {
                    campoTexto.style.display = 'none';
                    campoTexto.value = '';
                    campoTexto.required = false;
                }
            });
        });
    }

    ativarCampoEspecificacaoOutraCategoriaLivroFrequente() {
        const checkbox = document.getElementById('categoria_livro_frequente_outro');
        const campoTexto = document.getElementById('especificacao_outra_categoria');
        
        if (checkbox) {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    campoTexto.style.display = 'block';
                    campoTexto.required = true;
                    
                    // Quando o usuário digitar algo, adiciona ao array de categorias
                    campoTexto.addEventListener('blur', () => {
                        if (campoTexto.value.trim()) {
                            // Remove o valor antigo do array se existir
                            this.atualizarArrayCategorias(campoTexto.value.trim());
                        }
                    });
                } else {
                    campoTexto.style.display = 'none';
                    campoTexto.value = '';
                    campoTexto.required = false;
                    this.removerCategoriaOutro();
                }
            });
        }
    }

    ativarCampoEspecificacaoOutroLocalAcessoInternet() {
        const checkbox = document.getElementById('local_acesso_outro');
        const campoTexto = document.getElementById('local_acesso_especificacao');
        
        if (checkbox) {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    campoTexto.style.display = 'block';
                    campoTexto.required = true;
                    
                    // Quando o usuário digitar algo, adiciona ao array de locais
                    campoTexto.addEventListener('blur', () => {
                        if (campoTexto.value.trim()) {
                            this.atualizarArrayLocaisAcesso(campoTexto.value.trim());
                        }
                    });
                } else {
                    campoTexto.style.display = 'none';
                    campoTexto.value = '';
                    campoTexto.required = false;
                    this.removerLocalOutro();
                }
            });
        }
    }

    // Método auxiliar para adicionar categoria "outro" ao array
    atualizarArrayCategorias(valor) {
        // Cria um input hidden para adicionar ao array de categorias
        const form = document.querySelector('.form-container');
        
        // Remove input anterior se existir
        const inputAnterior = document.getElementById('categoria_outro_hidden');
        if (inputAnterior) {
            inputAnterior.remove();
        }
        
        // Cria novo input hidden
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.id = 'categoria_outro_hidden';
        hiddenInput.name = 'categoria_livro_frequente[]';
        hiddenInput.value = valor;
        form.appendChild(hiddenInput);
    }

    // Remove categoria "outro" do array
    removerCategoriaOutro() {
        const inputHidden = document.getElementById('categoria_outro_hidden');
        if (inputHidden) {
            inputHidden.remove();
        }
    }

    // Método auxiliar para adicionar local "outro" ao array
    atualizarArrayLocaisAcesso(valor) {
        const form = document.querySelector('.form-container');
        
        // Remove input anterior se existir
        const inputAnterior = document.getElementById('local_outro_hidden');
        if (inputAnterior) {
            inputAnterior.remove();
        }
        
        // Cria novo input hidden
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.id = 'local_outro_hidden';
        hiddenInput.name = 'local_acesso_internet[]';
        hiddenInput.value = valor;
        form.appendChild(hiddenInput);
    }

    // Remove local "outro" do array
    removerLocalOutro() {
        const inputHidden = document.getElementById('local_outro_hidden');
        if (inputHidden) {
            inputHidden.remove();
        }
    }

    /**
     * Pelo menos uma opção por grupo (qualquer checkbox, não só a primeira).
     * Não use required no HTML num único checkbox do grupo — isso obriga só a 1ª opção.
     * "Outro" conta como escolha mesmo antes de preencher o texto (o campo vira required via JS).
     */
    configurarValidacaoCheckboxes() {
        const form = document.querySelector('.form-container');
        if (!form) return;

        form.addEventListener('submit', (e) => {
            const algumMarcado = (nome) =>
                Array.from(document.querySelectorAll('input[type="checkbox"]')).some(
                    (c) => c.name === nome && c.checked
                );

            if (
                !algumMarcado('categoria_livro_frequente[]') &&
                !document.getElementById('categoria_livro_frequente_outro')?.checked
            ) {
                e.preventDefault();
                alert('Por favor, selecione pelo menos uma categoria de livro que você lê com frequência (incluindo "Outros tipos", se for o caso).');
                return;
            }

            if (
                !algumMarcado('local_acesso_internet[]') &&
                !document.getElementById('local_acesso_outro')?.checked
            ) {
                e.preventDefault();
                alert('Por favor, selecione pelo menos um local onde você acessa a internet (incluindo "Outro", se for o caso).');
                return;
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ValidacoesSobreCondicaoEstudo();
});