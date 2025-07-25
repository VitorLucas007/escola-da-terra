<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $mensagem_erro_user_participante = $_SESSION['mensagem_erro_user_participante'] ?? '';
    unset($_SESSION['mensagem_erro_user_participante']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa Educacional - Escola da Terra</title>
    <link rel="stylesheet" href="public/css/index.css">
    <link rel="icon" type="image/jpg" href="/pesquisa_educacional/public/assets/logos/favicon.jpg">
    <?php
        include  $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/cdn.php';
    ?>

</head>
<body>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/views/includes/header.php';
    ?>

    <div class="container container-texto">

        <div class="text-container">

            <div class="mb-4 text-start">
                <p class><strong>Prezado professor,</strong></p>

                <p>
                Este questionário foi elaborado pela equipe de coordenação do <strong>Observatório da Educação do Campo no Maranhão (OECM)</strong> e constitui uma proposta de pesquisa vinculada ao <strong>Programa Escola da Terra</strong>, cujo objetivo é promover a melhoria das condições de acesso, permanência e aprendizagem de estudantes do campo e quilombolas em suas comunidades, por meio do apoio à formação de professores que atuam nas turmas dos anos iniciais do ensino fundamental, compostas, em sua grande maioria, por estudantes de várias idades (turmas multiseriadas).
                </p>

                <p>
                Trata-se, pois, de um instrumento de análise acerca das condições de atuação docente em escolas localizadas em comunidades rurais e/ou quilombolas e que servirá de referencial para as próximas etapas da <strong>Ação Escola da Terra</strong>, além de se prestar ao objetivo de discussão acerca das políticas públicas sobre o tema no Maranhão.
                </p>

                <p>
                É nesse sentido ainda que sua contribuição se revela fundamental para a construção dessa cartografia das condições de atuação docente no Maranhão. Assim, gostaríamos de contar aqui com o seu compromisso pessoal ao responder as questões apresentadas com o maior grau de fidedignidade possível. <strong>Convém ressaltar que garantimos a total preservação do seu anonimato.</strong>
                </p>

                <p>
                Quanto aos critérios de elaboração deste questionário, observe que a maioria das questões é de múltipla escolha, exigindo apenas a seleção entre as alternativas disponíveis. Quando consideramos necessário, acrescentamos algumas indicações quanto ao número de opções que podem ser selecionadas em cada caso.
                </p>

                <p>
                Qualquer dúvida pode também ser tirada com a <a class="link-suporte" href="https://wa.me/5586995254202" target="_blank">equipe de suporte</a>.
                </p>

                <p><strong>Gratos pela sua colaboração.</strong><br>
                <em>Equipe de Coordenação do OECM.</em></p>
            </div>

            <!-- Obtenção do telefone -->
            <div class="d-flex flex-column align-items-center">

                <?php if (!empty($mensagem_erro_user_participante)): ?>
                    <div class="alert alert-info">
                        <?= htmlspecialchars($mensagem_erro_user_participante) ?>
                    </div>    
                <?php endif; ?>

                <!-- Formulário para o telefone -->
                <form action="/pesquisa_educacional/app/process/user_participante_process.php" method="post">
                    <!-- Campo Numérico para Telefone -->
                    <div class="mt-3 w-100" style="max-width: 300px;">
                        <label for="telefone" class="form-label fw-bold ">Insira seu número de telefone:</label>
                        <input type="text" id="telefone" name="telefone" class="form-control text-center input-telefone" placeholder="(DDD) 99999-9999" required pattern="\(\d{2}\)\s?\d{4,5}-\d{4}" autocomplete="tel">
                    </div>

                    <!-- Checkbox para confirmação de consentimento -->
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="aceite" required>
                        <label class="form-check-label" for="aceite">
                            Aceito responder o questionário
                        </label>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary">Iniciar</button>
                    </div>

                </form>

                <!-- Mensagem informativa: -->
                <p class="mensagem-informativa-footer">Se você já iniciou anteriormente, não se preocupe, você irá iniciar de onde parou.</p>

            </div>

        </div>
    </div>

    <script src="public/js/index.js"></script>
</body>
</html>
