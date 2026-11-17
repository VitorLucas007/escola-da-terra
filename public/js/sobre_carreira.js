class ValidacoesSobreCarreira {
    constructor() {
        this.ativacaoCamposAtividadesAnteriores();
        this.ativarCamposEspecificacaoAtividadesParalelas();
        this.ativarInputEspecificacaoOutraDependenciaAdministrativa();
        this.ativarInputEspecificacaoOutroContextoEscolar();
        this.adicionarEventoBotaoAdicionarLinhaTabelaEstabelecimentoEscolar();
        this.adicionarEventosBotoesRemocaoLinhaTabelaEstabelecimentoEscolar();
        this.adicionarEventoBotaoAdicionarLinhaTabelaEstabelecimentoEscolarMobile();
        this.validacaoCampoEquipamentosDesejados();
        this.sincronizarEstabelecimentosResponsivos();
        this.validarEtapasModalidadesNoSubmit();
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => this.sincronizarEstabelecimentosResponsivos(), 150);
        });
    }

    /**
     * Tabela desktop e accordion mobile repetem os mesmos names (nome_escola[] etc.).
     * O bloco oculto (Bootstrap) mantém campos required e gera "not focusable" no submit.
     */
    sincronizarEstabelecimentosResponsivos() {
        const wrapperDesktop = document.getElementById('tabelaEscolas')?.closest('.table-responsive');
        const wrapperMobile = document.getElementById('accordionEscolas')?.parentElement;
        const isDesktop = window.matchMedia('(min-width: 992px)').matches;

        const setBloco = (container, ativo) => {
            if (!container) return;
            container.querySelectorAll('input, select, textarea, button').forEach((el) => {
                if (el.type === 'hidden') return;
                el.disabled = !ativo;
                if (!ativo) {
                    if (el.type === 'checkbox' || el.type === 'radio') {
                        el.checked = false;
                    } else if (el.tagName !== 'BUTTON' && el.type !== 'button' && el.type !== 'submit') {
                        el.value = '';
                    }
                }
            });
        };

        if (wrapperDesktop && wrapperMobile) {
            setBloco(wrapperDesktop, isDesktop);
            setBloco(wrapperMobile, !isDesktop);
        }
    }

    /** Pelo menos uma etapa/modalidade por estabelecimento (required no 1º checkbox obrigava só Infantil). */
    validarEtapasModalidadesNoSubmit() {
        const form = document.querySelector('form.form-container');
        if (!form) return;
        form.addEventListener('submit', (e) => {
            const isDesktop = window.matchMedia('(min-width: 992px)').matches;

            const grupoInvalido = (container) => {
                const boxes = container.querySelectorAll(
                    'input[type="checkbox"][name*="etapa_atuante_educacao"]'
                );
                if (boxes.length === 0) return false;
                if (boxes[0].disabled) return false;
                return !Array.from(boxes).some((cb) => cb.checked);
            };

            if (isDesktop) {
                for (const tr of document.querySelectorAll('#tabelaEscolas tbody tr')) {
                    if (grupoInvalido(tr)) {
                        e.preventDefault();
                        alert('Selecione ao menos uma etapa/modalidade em cada estabelecimento de ensino.');
                        return;
                    }
                }
            } else {
                for (const body of document.querySelectorAll('#accordionEscolas .accordion-body')) {
                    if (grupoInvalido(body)) {
                        e.preventDefault();
                        alert('Selecione ao menos uma etapa/modalidade em cada estabelecimento de ensino.');
                        return;
                    }
                }
            }
        });
    }

    adicionarEventoBotaoAdicionarLinhaTabelaEstabelecimentoEscolarMobile(){
        const botaoAdicionar = document.getElementById("btnAdicionarEscolaMobile");
        botaoAdicionar.addEventListener('click', this.adicionarLinhaTabelaEstabelecimentoTrabalhoMobile.bind(this));
    }


    adicionarEventoBotaoAdicionarLinhaTabelaEstabelecimentoEscolar(){
        const botao_adicionar_linha_estabelecimento_escolar = document.getElementById('btnAdicionarEscola');
        botao_adicionar_linha_estabelecimento_escolar.addEventListener('click', this.adicionarLinhaTabelaEstabelecimentoTrabalho.bind(this));
    }


    adicionarEventosBotoesRemocaoLinhaTabelaEstabelecimentoEscolar(){
        const botoes_remover_linha_estabelecimento_escolar_mobile = document.getElementsByName('btnRemoverEscola');
        botoes_remover_linha_estabelecimento_escolar_mobile.forEach(botao => {
            botao.addEventListener('click', this.removerLinhaTabelaEstabelecimentoTrabalho.bind(this));
        });
    }
    
    adicionarEventosBotoesRemocaoLinhaTabelaEstabelecimentoEscolarMobile(){
        const botoes = document.getElementsByName('btnRemoverEscolaMobile');
        botoes.forEach(botao => {
            botao.addEventListener('click', (event) => {
                const id_bloco = botao.getAttribute('data-id');
                this.removerLinhaTabelaEstabelecimentoTrabalhoMobile(id_bloco);
            });
        });
    }


    ativacaoCamposAtividadesAnteriores(){
        const radioSim = document.getElementById('atividade_sim');
        const radioNao = document.getElementById('atividade_nao');
        const divDetalhes = document.getElementById('detalhes_atividade');
        const campo_texto_especificao_profissao_anterior = document.getElementById('nome_profissao');  
        const input_especificacao_exercicio_profissao_requerida = document.getElementById('exercia_conta_propia');
        
        [radioSim, radioNao].forEach(radio => {
          radio.addEventListener('change', () => {
            if(radioSim.checked){
                divDetalhes.style.display = 'block';
                campo_texto_especificao_profissao_anterior.required = true;
                input_especificacao_exercicio_profissao_requerida.required = true;        
            }
            else{
                divDetalhes.style.display = 'none';
                campo_texto_especificao_profissao_anterior.required = false;
                input_especificacao_exercicio_profissao_requerida.required = false;
            }
          });
        });
        

    }

    ativarCamposEspecificacaoAtividadesParalelas(){
        const paralelaSim = document.getElementById('paralela_sim');
        const paralelaNao = document.getElementById('paralela_nao');
        const inputParalela = document.getElementById('atividade_paralela');

        [paralelaSim, paralelaNao].forEach(radio => {
          radio.addEventListener('change', () => {
            if(paralelaSim.checked){
                inputParalela.style.display = 'block';
                inputParalela.required = true;
            }
            else{
                inputParalela.style.display = 'none';
                inputParalela.required = false;
            }
          });
        });
    
    }

    ativarInputEspecificacaoOutraDependenciaAdministrativa(){
        const selects = document.querySelectorAll('.dependencia_administrativa');
        const inputs_texto = document.querySelectorAll('.dependencia_administrativa_outro');

        selects.forEach(select => {
            select.addEventListener('change', () => {
                if (select.value === 'Outra') {
                    inputs_texto.forEach(input => {
                        input.style.display = 'block';
                        input.required = true;
                    });
                } else {
                    inputs_texto.forEach(input => {
                        input.style.display = 'none';
                        input.value = '';
                        input.required = false;
                    });
                }
            });
        });
    }

    ativarInputEspecificacaoOutroContextoEscolar(){
        const selects = document.querySelectorAll('.contexto_escolar');
        const inputs_texto = document.querySelectorAll('.contexto_escolar_outro');

        selects.forEach(select => {
            select.addEventListener('change', () => {
                if (select.value === 'Outra') {
                    inputs_texto.forEach(input => {
                        input.style.display = 'block';
                        input.required = true;
                    });
                } else {
                    inputs_texto.forEach(input => {
                        input.style.display = 'none';
                        input.value = '';
                        input.required = false;
                    });
                }
            });
        });
    }

    adicionarLinhaTabelaEstabelecimentoTrabalho(){
        const tabela = document.querySelector('#tabelaEscolas tbody');
        const linha = document.createElement('tr');
        const indice = tabela.querySelectorAll('tr').length;
        linha.innerHTML = `
            <td><input type="text" class="form-control" name="nome_escola[]" required></td>

            <td>
                <select class="form-select" name="situacao_funcional[]" required>
                    <option value="">Selecione</option>
                    <option>Professor Concursado</option>
                    <option>Professor contratado (ILT)</option>
                    <option>Professor contratado em outro regime</option>
                    <option>Funcionário Público cedido</option>
                    <option>Voluntário</option>
                    <option>Cedido</option>
                </select>
            </td>

            <td>
                <select class="form-select" name="localizacao_escola[]" required>
                    <option value="">Selecione</option>
                    <option value="Sede">Sede</option>
                    <option value="Municipio">Municipio</option>
                    <option value="Povoado">Povoado</option>
                </select>
            </td>

            <td>
                <div class="text-start text-wrap" style="min-width: 180px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${indice}][etapas][]" value="Infantil" id="etapa_infantil">
                        <label class="form-check-label" for="etapa_infantil">Educação Infantil</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${indice}][etapas][]" value="Fundamental inicial" id="etapa_fundamental_inicial">
                        <label class="form-check-label" for="etapa_fundamental_inicial">Ensino Fundamental (Séries Iniciais)</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${indice}][etapas][]" value="Fundamental final" id="etapa_fundamental_final">
                        <label class="form-check-label" for="etapa_fundamental_final">Ensino Fundamental (Séries Finais)</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${indice}][etapas][]" value="Ensino Medio" id="etapa_medio">
                        <label class="form-check-label" for="etapa_medio">Ensino Médio</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${indice}][etapas][]" value="EJA" id="etapa_eja">
                        <label class="form-check-label" for="etapa_eja">Educação de Jovens e Adultos (EJA)</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${indice}][etapas][]" value="Educacao Especial" id="etapa_especial">
                        <label class="form-check-label" for="etapa_especial">Educação Especial</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${indice}][etapas][]" value="Educacao Indigena/Quilombola" id="etapa_indigena">
                        <label class="form-check-label" for="etapa_indigena">Educação Indígena e/ou Quilombola</label>
                    </div>
                </div>
            </td>

            <td>
                <input type="number" id="jornada_trabalho_semanal" name="jornada_trabalho_semanal[]" class="form-control" required>
            </td>

            <td>
                <select class="form-select" name="tipo_turma[]" required>
                    <option value="">Selecione</option>
                    <option value="Seriada">Seriada</option>
                    <option value="Multiseriada">Multiseriada</option>
                </select>
            </td>

            <td>
                <select class="form-select dependencia_administrativa" name="dependencia_administrativa[]" required>
                    <option value="">Selecione</option>
                    <option>Pública municipal</option>
                    <option>Pública estadual</option>
                    <option>Conveniada com o poder público</option>
                    <option>Comunitária</option>
                    <option>Filantrópica</option>
                    <option>Confessional</option>
                    <option value="Outra">Outra</option>
                </select>
                <input type="text" name="dependencia_administrativa_outro[]" placeholder="Especifique" class="form-control mt-2 dependencia_administrativa_outro" id="campo_dependencia_outro" style="display: none;">
            </td>

            <td>
                <select class="form-select contexto_escolar" name="contexto_escolar[]">
                    <option value="">Selecione</option>
                    <option>Escola de Educação do Campo</option>
                    <option>Escola de Comunidades Quilombolas</option>
                    <option value="Outra">Outra</option>
                </select>
                <input type="text" name="contexto_escolar_outro[]" placeholder="Especifique" class="form-control mt-2 contexto_escolar_outro" id="campo_contexto_outro" style="display: none;">
            </td>

            <td>
                <button type="button"  name="btnRemoverEscola" id="btnRemoverEscola" class="btn btn-danger btn-sm w-100 w-md-auto px-2 py-2">Remover</button>
            </td>        
        `;
        tabela.appendChild(linha); 
        this.adicionarEventosBotoesRemocaoLinhaTabelaEstabelecimentoEscolar();
        this.ativarInputEspecificacaoOutraDependenciaAdministrativa();
        this.ativarInputEspecificacaoOutroContextoEscolar();
        this.sincronizarEstabelecimentosResponsivos();
    }

    removerLinhaTabelaEstabelecimentoTrabalho(){
        const tabela = document.querySelector('#tabelaEscolas tbody');
        const linhas = tabela.querySelectorAll('tr');
        if (linhas.length > 1) {
            tabela.removeChild(linhas[linhas.length - 1]);
        }
    }

    removerLinhaTabelaEstabelecimentoTrabalhoMobile(id_bloco){
        const container_accordion = document.getElementById('escola-bloco-' + id_bloco);
        container_accordion.remove();
    }

    adicionarLinhaTabelaEstabelecimentoTrabalhoMobile(){
        const container = document.getElementById("accordionEscolas");
        const id = container.childElementCount;
        container.innerHTML += `  
            <div class="accordion-item" id="escola-bloco-${id}">
                            
                <h2 class="accordion-header" id="heading-${id}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${id}">
                    Estabelecimento de trabalho ${id + 1}
                    </button>
                </h2>
                
                <div id="collapse-${id}" class="accordion-collapse collapse" data-bs-parent="#accordionEscolas">
                    
                    <div class="accordion-body">
                        
                        <div class="mb-2">
                            <strong>Nome da Escola:</strong><br>
                            <input type="text" class="form-control" name="nome_escola[]" required>
                        </div>

                        <div class="mb-2">
                            <strong>Situação Funcional:</strong><br>
                            <select class="form-select" name="situacao_funcional[]" required>
                                <option value="">Selecione</option>
                                <option>Professor Concursado</option>
                                <option>Professor contratado (ILT)</option>
                                <option>Outro regime</option>
                                <option>Funcionário Público cedido</option>
                                <option>Voluntário</option>
                                <option>Cedido</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <strong>Localização:</strong><br>
                            <select class="form-select" name="localizacao_escola[]" required>
                                <option value="">Selecione</option>
                                <option value="Sede">Sede</option>
                                <option value="Municipio">Municipio</option>
                                <option value="Povoado">Povoado</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <strong>Etapas/Modalidades:</strong><br>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${id}][etapas][]" value="Infantil">
                                <label class="form-check-label">Educação Infantil</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${id}][etapas][]" value="Fundamental inicial">
                                <label class="form-check-label">Ensino Fundamental (Séries Iniciais)</label>
                            </div>
                        
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${id}][etapas][]" value="Fundamental final">
                                <label class="form-check-label">Ensino Fundamental (Séries Finais)</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${id}][etapas][]" value="Ensino media">
                                <label class="form-check-label">Ensino Medio</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${id}][etapas][]" value="EJA">
                                <label class="form-check-label">Educação de jovens e adutos</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${id}][etapas][]" value="Educacao especial">
                                <label class="form-check-label">Educação especial</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="etapa_atuante_educacao[${id}][etapas][]" value="Educacao Indigena/Quilombola">
                                <label class="form-check-label">Educação indígena e/ou Quilombola</label>
                            </div>

                        </div>

                        <div class="mb-2">
                            <strong>Jornada de Trabalho (Horas):</strong>
                            <input type="number" class="form-control" name="jornada_trabalho_semanal[]" required>
                        </div>

                        <div class="mb-2">
                            <strong>Tipo de Turmas:</strong>
                            <select class="form-select" name="tipo_turma[]" required>
                                <option value="">Selecione</option>
                                <option>Seriada</option>
                                <option>Multiseriada</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <strong>Dependência Administrativa:</strong>
                            
                            <select class="form-select dependencia_administrativa" name="dependencia_administrativa[]" required>
                                <option value="">Selecione</option>
                                <option>Pública municipal</option>
                                <option>Pública estadual</option>
                                <option>Conveniada com o poder público</option>
                                <option>Comunitária</option>
                                <option>Filantrópica</option>
                                <option>Confessional</option>
                                <option value="Outra">Outra</option>
                            </select>
                            
                            <input type="text" name="dependencia_administrativa_outro[] " class="form-control mt-2 dependencia_administrativa_outro" placeholder="Se outra, especifique">
                        
                        </div>

                        <div class="mb-2">
                            <strong>Tipo de Escola:</strong>
                            <select class="form-select contexto_escolar" name="contexto_escolar[]" required>
                                <option value="">Selecione</option>
                                <option>Escola de Educação do Campo</option>
                                <option>Escola de Comunidades Quilombola</option>
                                <option>Outra</option>
                            </select>
                            
                            <input type="text" name="contexto_escolar_outro[]" class="form-control mt-2 contexto_escolar_outro" placeholder="Se outra, especifique">
                        </div>

                        <button type="button" name="btnRemoverEscolaMobile" data-id="${id}" class="btn btn-danger w-100 mt-3">Remover</button>
                    
                    </div>

                </div>
                        
            </div>
        `;
        this.adicionarEventosBotoesRemocaoLinhaTabelaEstabelecimentoEscolarMobile();
        this.ativarInputEspecificacaoOutraDependenciaAdministrativa();
        this.ativarInputEspecificacaoOutroContextoEscolar();
        this.sincronizarEstabelecimentosResponsivos();
    }

    validacaoCampoEquipamentosDesejados(){
        const radios = document.getElementsByName('possui_equipamentos_necessarios');
        const containerTexto = document.getElementById('campo_equipamentos_desejados');
        const campo_texto_especificacao = document.getElementById('equipamentos_desejados');

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === '0') {
                containerTexto.style.display = 'block';
                campo_texto_especificacao.required = true;
                } else {
                containerTexto.style.display = 'none';
                campo_texto_especificacao.value = '';
                campo_texto_especificacao.required = false;
                }
            });
        });
    }

}

  
document.addEventListener('DOMContentLoaded', () => {
    new ValidacoesSobreCarreira();
})
