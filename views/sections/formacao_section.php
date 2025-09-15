<h3 class="mb-3">Formulário: Sobre Formação Escolar</h3>

<?php if (!empty($dados_formacao) && !empty($dados_formacao['dados'])): ?>
    <?php
        // Extrai os dados principais e as tabelas relacionadas com verificação
        $info = $dados_formacao['dados'];
        $formacao_basica = $dados_formacao['formacao_basica'] ?? [];
        $formacao_superior = $dados_formacao['formacao_superior'] ?? [];
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">1. Resumo da Formação</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Cursos de graduação:</strong> <span><?php echo htmlspecialchars($info['quantidade_cursos_graduacao'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Fez especialização:</strong> <span><?php echo !empty($info['fez_especializacao']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Quantidade de especializações:</strong> <span><?php echo htmlspecialchars($info['quantidade_especializacoes'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Fez curso de aperfeiçoamento:</strong> <span><?php echo !empty($info['fez_curso_aperfeicoamento']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Cursos de aperfeiçoamento:</strong> <span><?php echo htmlspecialchars($info['quantidade_cursos_aperfeicoamento'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Fez mestrado:</strong> <span><?php echo !empty($info['fez_mestrado']) ? 'Sim' : 'Não'; ?></span></li>
            </ul>
        </div>
    </div>

    <?php if (!empty($formacao_basica)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">2. Formação Básica</h5></div>
        <div class="card-body p-0">
            <?php foreach ($formacao_basica as $basica): ?>
                <div class="p-3 border-bottom">
                    <h6 class="fw-bold"><?php echo htmlspecialchars($basica['nivel_formacao'] ?? 'Nível não informado'); ?></h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Tipo de Escola:</strong> <span><?php echo htmlspecialchars($basica['tipo_escola'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Município:</strong> <span><?php echo htmlspecialchars($basica['municipio_formacao'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Ano de Conclusão:</strong> <span><?php echo htmlspecialchars($basica['ano_conclusao'] ?? 'Não informado'); ?></span></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($formacao_superior)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">3. Formação Superior e Pós-Graduação</h5></div>
        <div class="card-body p-0">
            <?php foreach ($formacao_superior as $superior): ?>
                <div class="p-3 border-bottom">
                     <h6 class="fw-bold"><?php echo htmlspecialchars($superior['curso'] ?? 'Curso não informado'); ?> (<?php echo htmlspecialchars($superior['nivel_formacao'] ?? 'Nível não informado'); ?>)</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Instituição:</strong> <span><?php echo htmlspecialchars($superior['nome_instituicao'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Tipo de Instituição:</strong> <span><?php echo htmlspecialchars($superior['tipo_instituicao'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Modalidade:</strong> <span><?php echo htmlspecialchars($superior['modalidade'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Foi Bolsista:</strong> <span><?php echo !empty($superior['foi_bolsista']) ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Ano de Início:</strong> <span><?php echo htmlspecialchars($superior['ano_inicio'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Ano de Conclusão:</strong> <span><?php echo htmlspecialchars($superior['ano_conclusao'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Carga Horária:</strong> <span><?php echo htmlspecialchars($superior['carga_horaria'] ?? 'Não informada'); ?> horas</span></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning text-center">
        Este participante ainda não respondeu ao formulário "Sobre Formação Escolar".
    </div>
<?php endif; ?>
<hr class="my-5">