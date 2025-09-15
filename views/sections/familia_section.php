<h3 class="mb-3">Formulário: Sobre a Família</h3>

<?php if (!empty($dados_familia) && !empty($dados_familia['dados'])): ?>
    <?php
        // Extrai os dados principais e as tabelas relacionadas com verificação
        $info = $dados_familia['dados'];
        $filhos = $dados_familia['filhos'] ?? [];
        $irmaos = $dados_familia['irmaos'] ?? [];
        $genitores = $dados_familia['genitores'] ?? [];
        $avos = $dados_familia['avos'] ?? [];
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">1. Informações Gerais</h5></div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Possui Filhos:</strong> <span><?php echo !empty($info['possui_filhos']) ? 'Sim' : 'Não'; ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Quantidade de Irmãos:</strong> <span><?php echo htmlspecialchars($info['quantidade_irmaos'] ?? 0); ?></span></li>
            </ul>
        </div>
    </div>

    <?php if (!empty($filhos)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">2. Filhos</h5></div>
        <div class="card-body p-0">
            <?php foreach ($filhos as $filho): ?>
                <div class="p-3 border-bottom">
                    <h6 class="fw-bold"><?php echo htmlspecialchars($filho['nome'] ?? 'Nome não informado'); ?></h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Sexo:</strong> <span><?php echo htmlspecialchars($filho['sexo'] ?? 'Não informado'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Data de Nascimento:</strong> <span><?php echo htmlspecialchars($filho['data_nascimento'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Vive com o participante:</strong> <span><?php echo !empty($filho['vive_com_participante']) ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>É solteiro(a):</strong> <span><?php echo !empty($filho['solteiro']) ? 'Sim' : 'Não'; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Idade que saiu de casa:</strong> <span><?php echo htmlspecialchars($filho['idade_saiu_casa'] ?? 'Não aplicável'); ?></span></li>

                        <?php if (isset($filho['situacao_vida'])): ?>
                        <li class="list-group-item d-flex justify-content-between mt-2"><strong>Situação de Vida (Maior de idade):</strong> <span><?php echo htmlspecialchars($filho['situacao_vida']); ?></span></li>
                        <?php endif; ?>

                        <?php if (isset($filho['etapa_educacao'])): ?>
                        <li class="list-group-item d-flex justify-content-between mt-2"><strong>Etapa da Educação (Menor de idade):</strong> <span><?php echo htmlspecialchars($filho['etapa_educacao']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Habitação fora da escola:</strong> <span><?php echo htmlspecialchars($filho['habitacao_fora_escola']); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Acompanhante:</strong> <span><?php echo htmlspecialchars($filho['acompanhante']); ?></span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($irmaos)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">3. Irmãos</h5></div>
        <div class="card-body p-0">
            <?php foreach ($irmaos as $irmao): ?>
                <div class="p-3 border-bottom">
                    <h6 class="fw-bold"><?php echo htmlspecialchars($irmao['nome'] ?? 'Nome não informado'); ?></h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Profissão:</strong> <span><?php echo htmlspecialchars($irmao['profissao'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Habita na mesma localidade:</strong> <span><?php echo !empty($irmao['habita_mesma_localidade']) ? 'Sim' : 'Não'; ?></span></li>
                        <?php if (empty($irmao['habita_mesma_localidade'])): ?>
                        <li class="list-group-item d-flex justify-content-between"><strong>Local onde habita:</strong> <span><?php echo htmlspecialchars($irmao['local_habitacao'] ?? 'Não informado'); ?></span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($genitores)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">4. Genitores (Mãe e Pai)</h5></div>
        <div class="card-body p-0">
            <?php foreach ($genitores as $genitor): ?>
                <div class="p-3 border-bottom">
                    <h6 class="fw-bold"><?php echo htmlspecialchars($genitor['tipo_genitor'] ?? 'Não informado'); ?></h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Escolaridade:</strong> <span><?php echo htmlspecialchars($genitor['escolaridade'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Profissão:</strong> <span><?php echo htmlspecialchars($genitor['profissao'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Naturalidade:</strong> <span><?php echo htmlspecialchars($genitor['naturalidade'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Religião:</strong> <span><?php echo htmlspecialchars($genitor['religiao'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Participa de grupos:</strong> <span><?php echo isset($genitor['participa_grupo']) ? ($genitor['participa_grupo'] ? 'Sim' : 'Não') : 'Não informado'; ?></span></li>
                        <?php if (!empty($genitor['participa_grupo'])): ?>
                        <li class="list-group-item d-flex justify-content-between"><strong>Quais grupos:</strong> <span><?php echo htmlspecialchars($genitor['grupos_participacao'] ?? 'Não informado'); ?></span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($avos)): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0">5. Avós</h5></div>
        <div class="card-body p-0">
            <?php foreach ($avos as $avo): ?>
                <div class="p-3 border-bottom">
                    <h6 class="fw-bold">Avós <?php echo htmlspecialchars($avo['tipo_avos'] ?? 'Não informado'); ?></h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between mt-2"><strong>Escolaridade do Avô:</strong> <span><?php echo htmlspecialchars($avo['escolaridade_avo_masc'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Profissão do Avô:</strong> <span><?php echo htmlspecialchars($avo['profissao_avo_masc'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Naturalidade do Avô:</strong> <span><?php echo htmlspecialchars($avo['naturalidade_avo_masc'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between mt-3"><strong>Escolaridade da Avó:</strong> <span><?php echo htmlspecialchars($avo['escolaridade_avo_fem'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Profissão da Avó:</strong> <span><?php echo htmlspecialchars($avo['profissao_avo_fem'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Naturalidade da Avó:</strong> <span><?php echo htmlspecialchars($avo['naturalidade_avo_fem'] ?? 'Não informada'); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between mt-3"><strong>Religião dos Avós:</strong> <span><?php echo htmlspecialchars($avo['religiao_avos'] ?? 'Não informada'); ?></span></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning text-center">
        Este participante ainda não respondeu ao formulário "Sobre a Família".
    </div>
<?php endif; ?>
<hr class="my-5">