<h3 class="mb-3">Formulário: Sobre o Cursista</h3>

<?php if (!empty($dados_cursista) && !empty($dados_cursista['dados'])): ?>
    <?php
        // Extrai o array principal para facilitar o acesso
        $info = $dados_cursista['dados'];
        // Extrai as tabelas relacionadas com verificação de existência
        $compartilhamentos = $dados_cursista['compartilhamentos'] ?? [];
        $opinioes = $dados_cursista['opinioes'] ?? [];
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">1. Informações Pessoais e de Localização</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Ano de Nascimento:</strong> <span><?php echo htmlspecialchars($info['ano_nascimento'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Sexo:</strong> <span><?php echo htmlspecialchars($info['sexo'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Município de Naturalidade:</strong> <span><?php echo htmlspecialchars($info['municipio_naturalidade'] ?? 'Não informado'); ?>, <?php echo htmlspecialchars($info['estado_naturalidade'] ?? '--'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Município onde reside:</strong> <span><?php echo htmlspecialchars($info['municipio_reside_atualmente'] ?? 'Não informado'); ?>, <?php echo htmlspecialchars($info['estado_reside_atualmente'] ?? '--'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Anos no município atual:</strong> <span><?php echo htmlspecialchars($info['anos_reside_atualmente'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Residência Própria:</strong> <span><?php echo !empty($info['residencia_propria']) ? 'Sim' : 'Não'; ?></span></li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">2. Família e Relacionamento</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Estado Civil:</strong> <span><?php echo htmlspecialchars($info['estado_civil'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Anos de Casado(a):</strong> <span><?php echo htmlspecialchars($info['anos_tempo_casado'] ?? 'Não aplicável'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Anos em União Estável:</strong> <span><?php echo htmlspecialchars($info['anos_uniao_estavel'] ?? 'Não aplicável'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Casou várias vezes:</strong> <span><?php echo !empty($info['casou_varias_vezes']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Quantidade de casamentos:</strong> <span><?php echo htmlspecialchars($info['quantidade_casamentos'] ?? 'Não aplicável'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Data de Nascimento do Cônjuge:</strong> <span><?php echo htmlspecialchars($info['data_nascimento_conjuge'] ?? 'Não aplicável'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Profissão do Cônjuge:</strong> <span><?php echo htmlspecialchars($info['profissao_conjuge'] ?? 'Não aplicável'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Tem Filhos:</strong> <span><?php echo !empty($info['tem_filhos']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Quantidade de Filhos:</strong> <span><?php echo htmlspecialchars($info['quantidade_filhos'] ?? 'Não aplicável'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Vive com os Filhos:</strong> <span><?php echo !empty($info['vive_com_filhos']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Com quem os filhos vivem:</strong> <span><?php echo htmlspecialchars($info['filhos_vivem_com'] ?? 'Não aplicável'); ?></span></li>
            </ul>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">3. Informações Adicionais</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>É sindicalizado:</strong> <span><?php echo !empty($info['sindicalizado']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Tempo sindicalizado (anos):</strong> <span><?php echo htmlspecialchars($info['tempo_sindicalizado'] ?? 'Não aplicável'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Transporte mais frequente:</strong> <span><?php echo htmlspecialchars($info['transporte_frequente'] ?? 'Não informado'); ?></span></li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">4. Religião e Política</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Tem religião:</strong> <span><?php echo !empty($info['tem_religiao']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Religião praticada:</strong> <span><?php echo htmlspecialchars($info['religiao_praticada'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Tem opção partidária:</strong> <span><?php echo !empty($info['tem_opcao_partidaria']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Opção partidária:</strong> <span><?php echo htmlspecialchars($info['opcao_partidaria'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Partidos votados nas últimas eleições:</strong> <span><?php echo htmlspecialchars($info['partidos_votados_ultimas_eleicoes'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Posicionamento Político (1=Esquerda, 10=Direita):</strong> <span><?php echo htmlspecialchars($info['escala_politica_esquerda_direita'] ?? 'Não informado'); ?></span></li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">5. Com quem reside</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <?php if (!empty($compartilhamentos)): ?>
                    <?php foreach ($compartilhamentos as $comp): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($comp['compartilha_com'] ?? 'Não informado'); ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item text-muted">Nenhuma informação fornecida.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">6. Opiniões sobre temas</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <?php if (!empty($opinioes)): ?>
                    <?php foreach ($opinioes as $opiniao): ?>
                        <li class="list-group-item">
                            <strong><?php echo htmlspecialchars($opiniao['tema_opiniao'] ?? 'Tema não informado'); ?>:</strong>
                            <p class="mb-0 fst-italic">"<?php echo htmlspecialchars($opiniao['texto_opiniao'] ?? '...'); ?>"</p>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item text-muted">Nenhuma opinião fornecida.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

<?php else: ?>
    <div class="alert alert-warning text-center">
        Este participante ainda não respondeu ao formulário "Sobre o Cursista".
    </div>
<?php endif; ?>
<hr class="my-5">