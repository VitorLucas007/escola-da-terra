<h3 class="mb-3">Formulário: Sobre o Exercício da Profissão</h3>

<?php if (!empty($dados_exercicio) && !empty($dados_exercicio['dados'])): ?>
    <?php
        // Extrai os dados principais e as tabelas relacionadas
        $info = $dados_exercicio['dados'];
        $fontes_stress = $dados_exercicio['fontes_stress'] ?? [];
        $beneficios_salario = $dados_exercicio['beneficios_salario'] ?? [];
        $beneficios_docencia = $dados_exercicio['beneficios_docencia'] ?? [];
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">1. Percepções Gerais</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Docência como projeto de vida:</strong> <span><?php echo !empty($info['docencia_como_projeto_vida']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item"><strong>Justificativa para a escolha:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['justificativa_escolha_docencia'] ?? '...'); ?>"</p></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Identificação com a docência:</strong> <span><?php echo htmlspecialchars($info['identificacao_docencia'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Indicaria a docência para alguém:</strong> <span><?php echo htmlspecialchars($info['indicaria_docencia'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Informa a profissão como:</strong> <span><?php echo htmlspecialchars($info['informa_profissao'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Mudaria de profissão:</strong> <span><?php echo !empty($info['mudaria_de_profissao']) ? 'Sim' : 'Não'; ?></span></li>
                <?php if (!empty($info['mudaria_de_profissao'])): ?>
                    <li class="list-group-item d-flex justify-content-between"><strong>Para qual profissão:</strong> <span><?php echo htmlspecialchars($info['profissao_mudanca'] ?? 'Não informado'); ?></span></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">2. Rotina de Trabalho</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Horas de planejamento por semana:</strong> <span><?php echo htmlspecialchars($info['horas_planejamento_semana'] ?? 0); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Trabalha no final de semana:</strong> <span><?php echo htmlspecialchars($info['trabalha_final_semana'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Período mais trabalhoso do ano:</strong> <span><?php echo htmlspecialchars($info['periodo_trabalhoso_ano'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item"><strong>O que gosta no trabalho:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['gosta_do_trabalho'] ?? '...'); ?>"</p></li>
                <li class="list-group-item"><strong>Grau de dedicação:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['grau_dedicacao_trabalho'] ?? '...'); ?>"</p></li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">3. Remuneração</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Acha a remuneração justa:</strong> <span><?php echo !empty($info['acha_remuneracao_justa']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item"><strong>Justificativa sobre a remuneração:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['justificativa_satisfacao_remuneracao'] ?? '...'); ?>"</p></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Faixa salarial recebida:</strong> <span><?php echo htmlspecialchars($info['salario_recebido'] ?? 'Não informado'); ?></span></li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">4. Saúde e Bem-Estar</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Possui doença oriunda da docência:</strong> <span><?php echo !empty($info['doenca_oriunda_docencia']) ? 'Sim' : 'Não'; ?></span></li>
                <?php if (!empty($info['doenca_oriunda_docencia'])): ?>
                    <li class="list-group-item d-flex justify-content-between"><strong>Qual doença:</strong> <span><?php echo htmlspecialchars($info['descricao_doenca'] ?? 'Não informado'); ?></span></li>
                <?php endif; ?>
                <li class="list-group-item"><strong>O que mais causa prazer:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['causa_prazer_docencia'] ?? '...'); ?>"</p></li>
                <li class="list-group-item"><strong>O que mais causa desgosto:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['causa_desgosto_docencia'] ?? '...'); ?>"</p></li>
            </ul>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">5. Ambiente e Relações Profissionais</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Reação a comentários injustos:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['comentarios_injustos_noticiarios'] ?? '...'); ?>"</p></li>
                <li class="list-group-item"><strong>Reação a um problema profissional:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['reacao_problema_profissional'] ?? '...'); ?>"</p></li>
                <li class="list-group-item"><strong>Relação com a diretoria:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['relacao_com_diretoria_escolar'] ?? '...'); ?>"</p></li>
                <li class="list-group-item d-flex justify-content-between"><strong>É acolhido(a) em problemas na escola:</strong> <span><?php echo !empty($info['acolhido_em_problema_escolar']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Existe programa para paz/diversidade:</strong> <span><?php echo !empty($info['existe_programa_paz_diversidade']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Sofreu agressão na escola:</strong> <span><?php echo !empty($info['sofreu_agressao_na_escola']) ? 'Sim' : 'Não'; ?></span></li>
                 <?php if (!empty($info['sofreu_agressao_na_escola'])): ?>
                    <li class="list-group-item"><strong>Providência tomada (agressão):</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['providencia_tomada_agressao'] ?? '...'); ?>"</p></li>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between"><strong>Houve caso de bullying:</strong> <span><?php echo !empty($info['houve_caso_bullying']) ? 'Sim' : 'Não'; ?></span></li>
                 <?php if (!empty($info['houve_caso_bullying'])): ?>
                    <li class="list-group-item"><strong>Providência tomada (bullying):</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['providencia_tomada_bullying'] ?? '...'); ?>"</p></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <?php if (!empty($beneficios_salario)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">6. Benefícios Além do Salário</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($beneficios_salario as $b): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($b['descricao_beneficio'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($beneficios_docencia)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">7. Benefícios Oriundos da Docência</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($beneficios_docencia as $b): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($b['identificacao_beneficio'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>

    <?php if (!empty($fontes_stress)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">8. Fontes de Stress</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($fontes_stress as $fonte): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($fonte['descricao_fonte'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning text-center">
        Este participante ainda não respondeu ao formulário "Sobre o Exercício da Profissão".
    </div>
<?php endif; ?>
<hr class="my-5">