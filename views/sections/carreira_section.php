<h3 class="mb-3">Formulário: Sobre Carreira</h3>

<?php if (!empty($dados_carreira) && !empty($dados_carreira['dados'])): ?>
    <?php
    // Extrai os dados principais e as tabelas relacionadas
    $info = $dados_carreira['dados'];
    $trabalho_anterior = $dados_carreira['trabalho_anterior'] ?? [];
    $estabelecimentos = $dados_carreira['estabelecimentos'] ?? [];
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">1. Informações Gerais</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Exercia trabalho anteriormente:</strong> <span><?php echo !empty($info['exercia_trabalho_anteriormente']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Exerce atividade paralela:</strong> <span><?php echo !empty($info['exerce_atividade_paralela']) ? 'Sim' : 'Não'; ?></span></li>
                <?php if (!empty($info['exerce_atividade_paralela'])): ?>
                    <li class="list-group-item d-flex justify-content-between"><strong>Qual atividade:</strong> <span><?php echo htmlspecialchars($info['atividade_paralela'] ?? 'Não informado'); ?></span></li>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between"><strong>Atua no mesmo estabelecimento desde o início:</strong> <span><?php echo !empty($info['mesmo_estabelecimento_desde_inicio']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Qtd. de estabelecimentos na carreira:</strong> <span><?php echo htmlspecialchars($info['quantidade_estabelecimentos_carreira'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Qtd. de estabelecimentos atuais:</strong> <span><?php echo htmlspecialchars($info['quantidade_estabelecimentos_atuais'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Tempo como professor (anos):</strong> <span><?php echo htmlspecialchars($info['tempo_como_professor'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Nº de alunos na maior turma:</strong> <span><?php echo htmlspecialchars($info['numero_alunos_maior_turma'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Nº de alunos na menor turma:</strong> <span><?php echo htmlspecialchars($info['numero_alunos_menor_turma'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Dispõe dos equipamentos necessários:</strong> <span><?php echo !empty($info['possui_equipamentos_necessarios']) ? 'Sim' : 'Não'; ?></span></li>
                <?php if (empty($info['possui_equipamentos_necessarios'])): ?>
                    <li class="list-group-item d-flex justify-content-between"><strong>Equipamentos desejados:</strong> <span><?php echo htmlspecialchars($info['equipamentos_desejados'] ?? 'Não informado'); ?></span></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <?php if (!empty($trabalho_anterior)): ?>
        <?php if ($trabalho_anterior): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">2. Trabalho Anterior à Docência</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Profissão:</strong>
                            <span><?php echo htmlspecialchars($trabalho_anterior['nome_profissao']); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Como exercia:</strong>
                            <span><?php echo htmlspecialchars($trabalho_anterior['como_exercia']); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <?php if (!empty($estabelecimentos)): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">3. Estabelecimentos de Trabalho</h5>
            </div>
            <div class="card-body p-0">
                <?php foreach ($estabelecimentos as $est): ?>
                    <div class="p-3 border-bottom">
                        <h6 class="fw-bold"><?php echo htmlspecialchars($est['nome_escola'] ?? 'Nome não informado'); ?></h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between"><strong>Jornada Semanal (horas):</strong> <span><?php echo htmlspecialchars($est['jornada_trabalho_semanal'] ?? 0); ?></span></li>
                            <li class="list-group-item d-flex justify-content-between"><strong>Situação Funcional:</strong> <span><?php echo htmlspecialchars($est['situacao_funcional'] ?? 'Não informada'); ?></span></li>
                            <li class="list-group-item d-flex justify-content-between"><strong>Tipo de Turma:</strong> <span><?php echo htmlspecialchars($est['tipo_turma'] ?? 'Não informado'); ?></span></li>
                            <li class="list-group-item d-flex justify-content-between"><strong>Localização:</strong> <span><?php echo htmlspecialchars($est['localizacao_escola'] ?? 'Não informada'); ?></span></li>
                            <li class="list-group-item d-flex justify-content-between"><strong>Dependência Administrativa:</strong> <span><?php echo htmlspecialchars($est['dependencia_administrativa'] ?? 'Não informada'); ?></span></li>
                            <li class="list-group-item d-flex justify-content-between"><strong>Contexto Escolar:</strong> <span><?php echo htmlspecialchars($est['contexto_escolar'] ?? 'Não informado'); ?></span></li>

                            <?php if (!empty($est['etapas'])): ?>
                                <li class="list-group-item">
                                    <strong>Etapas de atuação:</strong>
                                    <ul class="list-unstyled ps-3 mt-1">
                                        <?php foreach ($est['etapas'] as $etapa): ?>
                                            <li>- <?php echo htmlspecialchars($etapa['nivel_etapa'] ?? 'Não informado'); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning text-center">
        Este participante ainda não respondeu ao formulário "Sobre Carreira".
    </div>
<?php endif; ?>
<hr class="my-5">