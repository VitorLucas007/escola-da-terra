<h3 class="mb-3">Formulário: Sobre Vida Geral</h3>

<?php if (!empty($dados_vida_geral) && !empty($dados_vida_geral['dados'])): ?>
    <?php
        // Extrai os dados principais e as tabelas relacionadas
        $info = $dados_vida_geral['dados'];
        $frequencia_bebidas = $dados_vida_geral['frequencia_bebidas'] ?? [];
        $razoes_alimentacao = $dados_vida_geral['razoes_alimentacao'] ?? [];
        $problemas_semanas = $dados_vida_geral['problemas_semanas'] ?? [];
        $atividades_fora_trabalho = $dados_vida_geral['atividades_fora_trabalho'] ?? [];
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">1. Saúde e Hábitos</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Situação da saúde:</strong> <span><?php echo htmlspecialchars($info['situacao_saude'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Tem doença crônica:</strong> <span><?php echo !empty($info['tem_doenca_cronica']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Tem plano de saúde:</strong> <span><?php echo !empty($info['tem_plano_saude']) ? 'Sim' : 'Não'; ?></span></li>
                <?php if (!empty($info['tem_plano_saude'])): ?>
                    <li class="list-group-item d-flex justify-content-between"><strong>Qual plano:</strong> <span><?php echo htmlspecialchars($info['plano_saude'] ?? 'Não informado'); ?></span></li>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between"><strong>Altura (m):</strong> <span><?php echo htmlspecialchars($info['altura'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Peso (kg):</strong> <span><?php echo htmlspecialchars($info['peso'] ?? 'Não informado'); ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Já foi internado(a):</strong> <span><?php echo !empty($info['foi_internado_hospital']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Consome bebidas alcoólicas:</strong> <span><?php echo !empty($info['bebe_alcool']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Usa cigarro:</strong> <span><?php echo htmlspecialchars($info['usa_cigarro'] ?? 'Não informado'); ?></span></li>
                <?php if (($info['usa_cigarro'] ?? 'Jamais') !== 'Jamais'): ?>
                     <li class="list-group-item d-flex justify-content-between"><strong>Cigarros por dia:</strong> <span><?php echo htmlspecialchars($info['quantidade_cigarros_dia'] ?? 0); ?></span></li>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between"><strong>Tem alimentação equilibrada:</strong> <span><?php echo !empty($info['tem_alimentacao_equilibrada']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item"><strong>Razão para ausência de tratamento:</strong><p class="mb-0 fst-italic ps-2">"<?php echo htmlspecialchars($info['razao_ausencia_tratamento'] ?? '...'); ?>"</p></li>
            </ul>
        </div>
    </div>

    <?php if (!empty($frequencia_bebidas)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">2. Frequência de Bebidas Alcoólicas</h5></div>
        <div class="card-body p-0">
            <?php foreach ($frequencia_bebidas as $bebida): ?>
                 <div class="p-3 border-bottom">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Bebida:</strong> <span><?php echo htmlspecialchars($bebida['bebida'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Frequência:</strong> <span><?php echo htmlspecialchars($bebida['nivel_frequencia'] ?? 'Não informada'); ?></span></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($razoes_alimentacao)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">3. Razões para Alimentação Desequilibrada</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($razoes_alimentacao as $razao): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($razao['descricao_razao'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>

    <?php if (!empty($problemas_semanas)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">4. Problemas nas Últimas Semanas</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($problemas_semanas as $problema): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($problema['descricao_problema'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>

    <?php if (!empty($atividades_fora_trabalho)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">5. Atividades Fora do Trabalho</h5></div>
        <div class="card-body"><ul class="list-group list-group-flush">
            <?php foreach ($atividades_fora_trabalho as $atividade): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($atividade['descricao_atividade'] ?? 'Não informado'); ?></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">6. Comentários Finais</h5></div>
        <div class="card-body">
            <p class="mb-1"><strong>O que mais gosta de fazer:</strong></p>
            <p class="fst-italic ps-3">"<?php echo htmlspecialchars($info['gosta_fazer'] ?? '...'); ?>"</p>
            <p class="mb-1"><strong>Comentário sobre a pesquisa:</strong></p>
            <p class="fst-italic ps-3 mb-0">"<?php echo htmlspecialchars($info['comentario_pesquisa'] ?? '...'); ?>"</p>
        </div>
    </div>

<?php else: ?>
    <div class="alert alert-warning text-center">
        Este participante ainda não respondeu ao formulário "Sobre Vida Geral".
    </div>
<?php endif; ?>