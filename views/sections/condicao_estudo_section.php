<h3 class="mb-3">Formulário: Sobre Condição de Estudo</h3>

<?php if (!empty($dados_condicao_estudo) && !empty($dados_condicao_estudo['dados'])): ?>
    <?php
        // Extrai os dados principais e as tabelas relacionadas
        $info = $dados_condicao_estudo['dados'];
        $leitura_frequente = $dados_condicao_estudo['leitura_frequente'] ?? [];
        $ultimos_livros = $dados_condicao_estudo['ultimos_livros'] ?? [];
        $categorias_livros = $dados_condicao_estudo['categorias_livros'] ?? [];
        $acesso_internet = $dados_condicao_estudo['acesso_internet'] ?? [];
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">1. Hábitos de Estudo e Leitura</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Onde estuda com mais frequência:</strong> <span><?php echo htmlspecialchars($info['estuda_mais_frequencia'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Frequenta biblioteca:</strong> <span><?php echo !empty($info['frequenta_biblioteca']) ? 'Sim' : 'Não'; ?></span></li>
                <?php if (!empty($info['frequenta_biblioteca'])): ?>
                    <li class="list-group-item d-flex justify-content-between"><strong>Qual(is) biblioteca(s):</strong> <span><?php echo htmlspecialchars($info['local_biblioteca_frequentada'] ?? 'Não informado'); ?></span></li>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between"><strong>Frequência de leitura de livros:</strong> <span><?php echo htmlspecialchars($info['frequencia_leitura_livros'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Livros lidos este ano:</strong> <span><?php echo htmlspecialchars($info['livros_lidos_este_ano'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Possui biblioteca particular:</strong> <span><?php echo !empty($info['possui_biblioteca_particular']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Quantidade estimada de livros:</strong> <span><?php echo htmlspecialchars($info['quantidade_estimada_livros'] ?? 0); ?></span></li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">2. Ambiente e Tecnologia</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Possui sala de trabalho/estudo:</strong> <span><?php echo htmlspecialchars($info['tem_sala_trabalho'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Utiliza computador próprio:</strong> <span><?php echo !empty($info['utiliza_computador_proprio']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Frequência de conexão à internet:</strong> <span><?php echo htmlspecialchars($info['frequencia_conexao_internet'] ?? 'Não informado'); ?></span></li>
            </ul>
        </div>
    </div>
    
    <?php if (!empty($leitura_frequente)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">3. Frequência de Leitura por Veículo</h5></div>
        <div class="card-body p-0">
            <?php foreach ($leitura_frequente as $leitura): ?>
                <div class="p-3 border-bottom">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Veículo:</strong> <span><?php echo htmlspecialchars($leitura['veiculo_lido'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Frequência:</strong> <span><?php echo htmlspecialchars($leitura['frequencia_leitura'] ?? 'Não informada'); ?></span></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($categorias_livros)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">4. Categorias de Livros Lidos Frequentemente</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($categorias_livros as $categoria): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($categoria['nome_categoria'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($ultimos_livros)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">5. Últimos Livros que Mais Gostou</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($ultimos_livros as $livro): ?>
                <li class="list-group-item"><strong><?php echo htmlspecialchars($livro['ordem_preferencia'] ?? '?'); ?>:</strong> <?php echo htmlspecialchars($livro['nome_livro'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>

    <?php if (!empty($acesso_internet)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">6. Locais de Acesso à Internet</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($acesso_internet as $acesso): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($acesso['local_acesso'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>
    
<?php else: ?>
    <div class="alert alert-warning text-center">
        Este participante ainda não respondeu ao formulário "Sobre Condição de Estudo".
    </div>
<?php endif; ?>
<hr class="my-5">