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

    // Configurar validação para garantir que pelo menos um checkbox seja marcado
    configurarValidacaoCheckboxes() {
        const form = document.querySelector('.form-container');
        
        if (form) {
            form.addEventListener('submit', (e) => {
                // Validar categorias de livros
                const categoriasCheckboxes = document.querySelectorAll('input[name="categoria_livro_frequente[]"]');
                const categoriaOutroCheck = document.getElementById('categoria_livro_frequente_outro');
                const categoriaOutroTexto = document.getElementById('especificacao_outra_categoria');
                
                let algumaMarcada = false;
                categoriasCheckboxes.forEach(cb => {
                    if (cb.checked) algumaMarcada = true;
                });
                
                if (categoriaOutroCheck && categoriaOutroCheck.checked && categoriaOutroTexto.value.trim()) {
                    algumaMarcada = true;
                }
                
                if (!algumaMarcada) {
                    e.preventDefault();
                    alert('Por favor, selecione pelo menos uma categoria de livro que você lê com frequência.');
                    return false;
                }
                
                // Validar locais de acesso à internet
                const locaisCheckboxes = document.querySelectorAll('input[name="local_acesso_internet[]"]');
                const localOutroCheck = document.getElementById('local_acesso_outro');
                const localOutroTexto = document.getElementById('local_acesso_especificacao');
                
                let algumLocalMarcado = false;
                locaisCheckboxes.forEach(cb => {
                    if (cb.checked) algumLocalMarcado = true;
                });
                
                if (localOutroCheck && localOutroCheck.checked && localOutroTexto.value.trim()) {
                    algumLocalMarcado = true;
                }
                
                if (!algumLocalMarcado) {
                    e.preventDefault();
                    alert('Por favor, selecione pelo menos um local onde você acessa a internet.');
                    return false;
                }
            });
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ValidacoesSobreCondicaoEstudo();
});