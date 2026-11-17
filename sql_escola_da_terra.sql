/* SCRIPT DE CRIAÇÃO DO ESQUEMA USADO NA PESQUISA */

DROP DATABASE IF EXISTS pesquisa_educacional;

CREATE DATABASE pesquisa_educacional;

USE pesquisa_educacional;

/* Tabela 'UserAdmin', que representa administradores da aplicação */
CREATE TABLE UserAdmin (
    id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

/* Tabela 'UserParticipante', que representa o usuário que responde */
CREATE TABLE UserParticipante (
    id_participante INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    telefone VARCHAR(20) NOT NULL UNIQUE,
    progresso_participante TINYINT UNSIGNED NOT NULL DEFAULT 0,
    id_pesquisador_responsavel INT UNSIGNED NULL,
    
    FOREIGN KEY (id_pesquisador_responsavel) REFERENCES UserAdmin(id_user)
) ENGINE=InnoDB;

/* ************ PRIMEIRO FORMULÁRIO ********** */

/* Tabela 'SobreCursista', que representa as informações sobre o primeiro formulário */
CREATE TABLE SobreCursista (
    id_informacao_cursista INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    participante_id INT UNSIGNED NOT NULL,
    ano_nascimento YEAR NOT NULL,
    sexo ENUM('Masculino', 'Feminino', 'Não declarado') NOT NULL,
    estado_naturalidade CHAR(2) NOT NULL,
    municipio_naturalidade VARCHAR(50) NOT NULL,
    estado_reside_atualmente CHAR(2) NOT NULL,
    municipio_reside_atualmente VARCHAR(50) NOT NULL,
    anos_reside_atualmente TINYINT UNSIGNED NOT NULL,
    residencia_propria TINYINT(1) NOT NULL,
    tem_filhos TINYINT(1) NOT NULL,
    quantidade_filhos TINYINT UNSIGNED,
    vive_com_filhos TINYINT(1) NOT NULL,
    filhos_vivem_com VARCHAR(50),
    estado_civil ENUM('Casado(a)', 'União estável', 'Separado(a)', 'Jamais casado', 'Viúvo(a)', 'Divorciado(a)') NOT NULL,
    anos_tempo_casado TINYINT UNSIGNED,
    anos_uniao_estavel TINYINT UNSIGNED,
    data_nascimento_conjuge DATE,
    profissao_conjuge VARCHAR(60),
    casou_varias_vezes TINYINT(1) NOT NULL,
    quantidade_casamentos TINYINT UNSIGNED,
    sindicalizado TINYINT(1) NOT NULL,
    tempo_sindicalizado TINYINT UNSIGNED,
    transporte_frequente VARCHAR(50) NOT NULL,
    tem_religiao TINYINT(1) NOT NULL,
    religiao_praticada VARCHAR(50),
    tem_opcao_partidaria TINYINT(1) NOT NULL,
    opcao_partidaria VARCHAR(50),
    partidos_votados_ultimas_eleicoes VARCHAR(100),
    escala_politica_esquerda_direita TINYINT UNSIGNED CHECK (escala_politica_esquerda_direita BETWEEN 1 AND 10),
    
    CONSTRAINT fk_sobre_cursista_participante FOREIGN KEY (participante_id)
        REFERENCES UserParticipante(id_participante)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE OpiniaoTemaSobreCursista (
    id_opiniao INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_cursista_id INT UNSIGNED NOT NULL,
    tema_opiniao ENUM(
        'posse_de_armas',
        'migracao',
        'homossexualismo',
        'pobreza',
        'pena_de_morte',
        'sindicatos',
        'criminalidade',
        'adolescentes',
        'drogas',
        'religião'
    ) NOT NULL,
    texto_opiniao VARCHAR(150) ,
    CONSTRAINT fk_sobre_cursista_id FOREIGN KEY (sobre_cursista_id)
        REFERENCES SobreCursista(id_informacao_cursista)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT uq_opiniao_unica_por_tema UNIQUE (sobre_cursista_id, tema_opiniao) /* garante uma opinião por tema em relação ao participante. */
) ENGINE=InnoDB;

/* Tabela 'CompartilhamentoResidencia', que é uma tabela filha de 'SobreCursista' */
CREATE TABLE CompartilhamentoResidencia (
    id_compartilhamento_residencia INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_cursista_id INT UNSIGNED ,
    compartilha_com VARCHAR(40) ,
    CONSTRAINT fk_compartilhamento_sobrecursista FOREIGN KEY (sobre_cursista_id)
        REFERENCES SobreCursista(id_informacao_cursista)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* ************ SEGUNDO FORMULÁRIO ********** */

/* Tabela 'SobreFamilia', que diz respeito as informações do segundo formulário */
CREATE TABLE SobreFamilia (
    id_informacao_familiares INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    participante_id INT UNSIGNED ,
    possui_filhos TINYINT(1),
    quantidade_irmaos TINYINT UNSIGNED ,
    CONSTRAINT fk_sobre_familia_participante FOREIGN KEY (participante_id)
        REFERENCES UserParticipante(id_participante)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'InformacaoFilho', que representa informações de filhos relacionados ao participante */
CREATE TABLE InformacaoFilho (
    id_informacao_filho INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_familia_id INT UNSIGNED ,
    nome VARCHAR(60),
    sexo ENUM('Masculino', 'Feminino', 'Não declarado'),
    data_nascimento DATE ,
    vive_com_participante TINYINT ,
    solteiro TINYINT ,
    idade_saiu_casa TINYINT UNSIGNED,
    CONSTRAINT fk_filho_sobrefamilia FOREIGN KEY (sobre_familia_id)
        REFERENCES SobreFamilia(id_informacao_familiares)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'InformacaoFilhoMaiorIdade', relacionada a informação específica de filhos maiores de idade */
CREATE TABLE InformacaoFilhoMaiorIdade (
    id_informacao_filho_maior_idade INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    informacao_filho_id INT UNSIGNED,
    situacao_vida VARCHAR(40),
    CONSTRAINT fk_filho_maior_idade FOREIGN KEY (informacao_filho_id)
        REFERENCES InformacaoFilho(id_informacao_filho)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'InformacaoFilhoMenorIdade', que é filha de 'InformacaoFilho' */
CREATE TABLE InformacaoFilhoMenorIdade (
    id_informacao_filho_menor_idade INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    informacao_filho_id INT UNSIGNED,
    etapa_educacao ENUM('Educacao infantil', 'Educacao Fundamental', 'Ensino Medio'),
    habitacao_fora_escola ENUM('Em casa', 'Fora de casa'),
    acompanhante VARCHAR(60) ,
    
    CONSTRAINT fk_filho_menor_idade FOREIGN KEY (informacao_filho_id)
        REFERENCES InformacaoFilho(id_informacao_filho)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela InformacaoIrmao, que é uma tabela filha de 'SobreFamilia' */
CREATE TABLE InformacaoIrmao (
    id_informacao_irmao INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_familia_id INT UNSIGNED ,
    nome VARCHAR(50) ,
    profissao VARCHAR(60) DEFAULT 'Desconhecido',
    habita_mesma_localidade TINYINT ,
    local_habitacao VARCHAR(50),
    CONSTRAINT fk_irmao_sobre_familia FOREIGN KEY (sobre_familia_id)
        REFERENCES SobreFamilia(id_informacao_familiares)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'InformacaoGenitor', filha de 'SobreFamilia' */
CREATE TABLE InformacaoGenitor (
    id_informacao_genitor INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_familia_id INT UNSIGNED ,
    tipo_genitor ENUM('Mae', 'Pai') ,
    escolaridade ENUM(
        'Sem escolaridade',
        'Fundamental maior',
        'Fundamental menor',
        'Ensino medio',
        'Ensino superior',
        'Nao sabe informar'
    ) NOT NULL,
    profissao VARCHAR(60) DEFAULT 'Desconhecido',
    naturalidade VARCHAR(65) DEFAULT 'Desconhecido',
    religiao VARCHAR(40) DEFAULT 'Desconhecido',
    participa_grupo TINYINT ,
    grupos_participacao VARCHAR(150),
    CONSTRAINT fk_genitor_sobre_familia FOREIGN KEY (sobre_familia_id)
        REFERENCES SobreFamilia(id_informacao_familiares)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'InformacaoAvos', filha de 'SobreFamilia' */
CREATE TABLE InformacaoAvos (
    id_informacao_avos INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_familia_id INT UNSIGNED ,
    tipo_avos ENUM('Maternos', 'Paternos'),
    escolaridade_avo_masc ENUM(
        'Sem escolaridade',
        'Fundamental menor',
        'Fundamental maior',
        'Ensino medio',
        'Ensino superior',
        'Nao sabe responder'
    ) NOT NULL,
    escolaridade_avo_fem ENUM(
        'Sem escolaridade',
        'Fundamental menor',
        'Fundamental maior',
        'Ensino medio',
        'Ensino superior',
        'Nao sabe responder'
    ) NOT NULL,
    profissao_avo_masc VARCHAR(30) DEFAULT 'Desconhecido',
    profissao_avo_fem VARCHAR(30) DEFAULT 'Desconhecido',
    naturalidade_avo_masc VARCHAR(35) DEFAULT 'Desconhecido',
    naturalidade_avo_fem VARCHAR(35) DEFAULT 'Desconhecido',
    religiao_avos VARCHAR(60) DEFAULT 'Desconhecido',
    CONSTRAINT fk_avos_sobre_familia FOREIGN KEY (sobre_familia_id)
        REFERENCES SobreFamilia(id_informacao_familiares)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    
    CONSTRAINT uq_tipo_avos_familia UNIQUE (sobre_familia_id, tipo_avos)
) ENGINE=InnoDB;

/* ************ TERCEIRO FORMULÁRIO ********** */

/* Tabela 'SobreFormacaoEscolar', filha de 'UserParticipante' */
CREATE TABLE SobreFormacaoEscolar (
    id_informacao_formacao_escolar INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    participante_id INT UNSIGNED NOT NULL,
    quantidade_cursos_graduacao TINYINT UNSIGNED NOT NULL,
    quantidade_especializacoes TINYINT UNSIGNED NOT NULL,
    fez_curso_aperfeicoamento TINYINT NOT NULL,
    quantidade_cursos_aperfeicoamento TINYINT UNSIGNED NOT NULL,
    fez_mestrado TINYINT NOT NULL,
    fez_especializacao TINYINT NOT NULL,
    CONSTRAINT fk_sobre_formacao_escolar_participante FOREIGN KEY (participante_id)
        REFERENCES UserParticipante(id_participante)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'FormacaoBasica', filha de 'SobreFormacaoEscolar' */
CREATE TABLE FormacaoBasica (
    id_formacao_basica INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_formacao_escolar_id INT UNSIGNED NOT NULL,
    nivel_formacao ENUM('Fundamental_Menor', 'Fundamental_Maior', 'Ensino_Medio') NOT NULL,
    tipo_escola ENUM('Publica', 'Privada') NOT NULL,
    municipio_formacao VARCHAR(60) NOT NULL,
    ano_conclusao YEAR NOT NULL,
    CONSTRAINT fk_formacao_basica_formacao_escolar FOREIGN KEY (sobre_formacao_escolar_id)
        REFERENCES SobreFormacaoEscolar(id_informacao_formacao_escolar)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'FormacaoSuperior', filha de 'SobreFormacaoEscolar' */
CREATE TABLE FormacaoSuperior (
    id_formacao_superior INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_formacao_escolar_id INT UNSIGNED NOT NULL,
    nivel_formacao ENUM('Graduacao', 'Especializacao', 'Aperfeicoamento', 'Mestrado', 'Doutorado') NOT NULL,
    nome_instituicao VARCHAR(50) NOT NULL,
    curso VARCHAR(40) NOT NULL,
    modalidade ENUM('Presencial', 'EAD') NOT NULL,
    tipo_instituicao ENUM('Publica', 'Privada') NOT NULL,
    foi_bolsista TINYINT NOT NULL,
    ano_inicio YEAR,
    ano_conclusao YEAR,
    carga_horaria TINYINT UNSIGNED,
    CONSTRAINT fk_formacao_superior_formacao_escolar FOREIGN KEY (sobre_formacao_escolar_id)
        REFERENCES SobreFormacaoEscolar(id_informacao_formacao_escolar)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* ************ QUARTO FORMULÁRIO ********** */

/* Tabela 'SobreCarreira', que é a tabela principal do quarto formulário */
CREATE TABLE SobreCarreira (
    id_informacao_carreira INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    participante_id INT UNSIGNED NOT NULL,
    exercia_trabalho_anteriormente TINYINT NOT NULL,
    exerce_atividade_paralela TINYINT NOT NULL,
    atividade_paralela VARCHAR(150),
    mesmo_estabelecimento_desde_inicio TINYINT NOT NULL,
    quantidade_estabelecimentos_carreira TINYINT UNSIGNED NOT NULL,
    quantidade_estabelecimentos_atuais TINYINT UNSIGNED NOT NULL,
    tempo_como_professor TINYINT UNSIGNED NOT NULL,
    numero_alunos_maior_turma TINYINT UNSIGNED,
    numero_alunos_menor_turma TINYINT UNSIGNED,
    possui_equipamentos_necessarios TINYINT NOT NULL,
    equipamentos_desejados VARCHAR(255),
    
    CONSTRAINT fk_sobre_carreira_participante FOREIGN KEY (participante_id)
        REFERENCES UserParticipante(id_participante)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'TrabalhoAnterior', filha de 'SobreCarreira' */
CREATE TABLE TrabalhoAnterior (
    id_trabalho_anterior INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_carreira_id INT UNSIGNED NOT NULL,
    nome_profissao VARCHAR(40) NOT NULL,
    como_exercia VARCHAR(50) NOT NULL,
    CONSTRAINT fk_trabalho_anterior_sobre_carreira FOREIGN KEY (sobre_carreira_id)
        REFERENCES SobreCarreira(id_informacao_carreira)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'EstabelecimentoTrabalho', filha de 'SobreCarreira' */
CREATE TABLE EstabelecimentoTrabalho (
    id_estabelecimento_trabalho INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sobre_carreira_id INT UNSIGNED NOT NULL,
    nome_escola VARCHAR(40) NOT NULL,
    jornada_trabalho_semanal TINYINT UNSIGNED NOT NULL,
    situacao_funcional VARCHAR(40) NOT NULL,
    tipo_turma ENUM('Seriada', 'Multiseriada') NOT NULL,
    localizacao_escola ENUM('Sede', 'Municipio', 'Povoado') NOT NULL,
    dependencia_administrativa VARCHAR(35) NOT NULL,
    contexto_escolar VARCHAR(40) NOT NULL,
    CONSTRAINT fk_estabelecimento_sobre_carreira FOREIGN KEY (sobre_carreira_id)
        REFERENCES SobreCarreira(id_informacao_carreira)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'EtapaAtuanteEducacao', relacionada a tabela 'EstabelecimentoTrabalho' */
CREATE TABLE EtapaAtuanteEducacao (
    id_etapa_atuante_educacao INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_trabalho_id INT UNSIGNED NOT NULL,
    nivel_etapa ENUM(
        'Infantil',
        'Fundamental Inicial',
        'Fundamental final',
        'Ensino Medio',
        'EJA',
        'Educacao especial',
        'Educacao Indigena/Quilombola'
    ) NOT NULL,
    CONSTRAINT fk_etapa_atuante_sobre_carreira FOREIGN KEY (estabelecimento_trabalho_id)
        REFERENCES EstabelecimentoTrabalho(id_estabelecimento_trabalho)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* ************ QUINTO FORMULÁRIO ********** */

/* Tabela 'SobreExercicioProfissao', que é tabela principal do quinto formulário */
CREATE TABLE SobreExercicioProfissao (
    id_informacao_exercicio_profissao INT AUTO_INCREMENT PRIMARY KEY,
    participante_id INT UNSIGNED NOT NULL,
    docencia_como_projeto_vida TINYINT NOT NULL,
    justificativa_escolha_docencia VARCHAR(100) NOT NULL,
    identificacao_docencia ENUM('Apaixonante', 'Interessante', 'Pouco motivante', 'Desencorajadora') NOT NULL,
    horas_planejamento_semana TINYINT UNSIGNED NOT NULL,
    trabalha_final_semana ENUM('Sempre', 'Frequentemente', 'De vez em quando', 'Raramente', 'Jamais') NOT NULL,
    gosta_do_trabalho VARCHAR(100) NOT NULL,
    indicaria_docencia VARCHAR(50) NOT NULL,
    informa_profissao VARCHAR(50) NOT NULL,
    periodo_trabalhoso_ano ENUM('Inicio de ano', 'Fim de trimestre', 'Fim de ano', 'Todo o tempo') NOT NULL,
    doenca_oriunda_docencia TINYINT NOT NULL,
    descricao_doenca VARCHAR(60),
    comentarios_injustos_noticiarios VARCHAR(255) NOT NULL,
    reacao_problema_profissional VARCHAR(100) NOT NULL,
    acolhido_em_problema_escolar TINYINT NOT NULL,
    causa_prazer_docencia VARCHAR(255) NOT NULL,
    causa_desgosto_docencia VARCHAR(255) NOT NULL,
    grau_dedicacao_trabalho VARCHAR(100) NOT NULL,
    relacao_com_diretoria_escolar VARCHAR(100) NOT NULL,
    acha_remuneracao_justa TINYINT NOT NULL,
    justificativa_satisfacao_remuneracao VARCHAR(255) NOT NULL,
    salario_recebido ENUM(
        '1/2 salario minimo',
        '1 a 2 salarios minimos',
        '3 salarios minimos',
        'Mais de 3 salarios minimos',
        'Piso do magisterio'
    ) NOT NULL,
    mudaria_de_profissao TINYINT NOT NULL,
    profissao_mudanca VARCHAR(30),
    existe_programa_paz_diversidade TINYINT NOT NULL,
    sofreu_agressao_na_escola TINYINT NOT NULL,
    providencia_tomada_agressao VARCHAR(255),
    houve_caso_bullying TINYINT NOT NULL,
    providencia_tomada_bullying VARCHAR(70),
    CONSTRAINT fk_sobre_exercicio_profissao_participante FOREIGN KEY (participante_id)
        REFERENCES UserParticipante(id_participante)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'FonteStress', filha de 'SobreExercicioProfissao' */
CREATE TABLE FonteStress (
    id_fonte_stress INT AUTO_INCREMENT PRIMARY KEY,
    sobre_exercicio_profissao_id INT NOT NULL,
    descricao_fonte VARCHAR(30) NOT NULL,
    CONSTRAINT fk_fonte_stress_sobre_exercicio_profissao FOREIGN KEY (sobre_exercicio_profissao_id)
        REFERENCES SobreExercicioProfissao(id_informacao_exercicio_profissao)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'BeneficioRecebido', filha de 'SobreExercicioProfissao' */
CREATE TABLE BeneficioRecebidoSalario (
    id_beneficio_recebido INT AUTO_INCREMENT PRIMARY KEY,
    sobre_exercicio_profissao_id INT NOT NULL,
    descricao_beneficio VARCHAR(50) NOT NULL,
    CONSTRAINT fk_beneficio_recebido_salario_sobre_exercicio_profissao FOREIGN KEY (sobre_exercicio_profissao_id)
        REFERENCES SobreExercicioProfissao(id_informacao_exercicio_profissao)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'BeneficioOriundoAtividadesDocencia' */
CREATE TABLE BeneficioOriundoAtividadesDocencia (
    id_beneficio_oriundo_atividades_docencia INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    sobre_exercicio_profissao_id INT NOT NULL,
    identificacao_beneficio VARCHAR(60) NOT NULL,
    CONSTRAINT fk_beneficio_oriundo_sobre_exercicio_profissao FOREIGN KEY (sobre_exercicio_profissao_id)
        REFERENCES SobreExercicioProfissao(id_informacao_exercicio_profissao)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* ************ SEXTO FORMULÁRIO ********** */

/* Tabela 'SobreCondicaoEstudo', que é a tabela principal do sexto formulário */
CREATE TABLE SobreCondicaoEstudo (
    id_informacao_condicao_estudo INT AUTO_INCREMENT PRIMARY KEY,
    participante_id INT UNSIGNED NOT NULL,
    estuda_mais_frequencia VARCHAR(50) NOT NULL,
    frequenta_biblioteca TINYINT NOT NULL,
    local_biblioteca_frequentada VARCHAR(150),
    frequencia_leitura_livros ENUM('Muito', 'Moderadamente', 'Pouco', 'Raramente') NOT NULL,
    livros_lidos_este_ano TINYINT UNSIGNED NOT NULL,
    possui_biblioteca_particular TINYINT NOT NULL,
    tem_sala_trabalho VARCHAR(60) NOT NULL,
    quantidade_estimada_livros SMALLINT UNSIGNED NOT NULL,
    utiliza_computador_proprio TINYINT NOT NULL,
    frequencia_conexao_internet VARCHAR(40) NOT NULL,
    CONSTRAINT fk_sobre_condicao_estudo_participante
        FOREIGN KEY (participante_id)
        REFERENCES UserParticipante(id_participante)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'LeituraFrequente', filha de 'SobreCondicaoEstudo' */
CREATE TABLE LeituraFrequente (
    id_ler_frequentemente INT AUTO_INCREMENT PRIMARY KEY,
    sobre_condicao_estudo_id INT NOT NULL,
    veiculo_lido ENUM('Revistas', 'Jornais', 'Livros') NOT NULL,
    frequencia_leitura ENUM('Todos os dias', '1 a 3 vezes na semana', '2 a 3 vezes por mês', 'Raramente', 'Jamais') NOT NULL,
    CONSTRAINT fk_ler_frequentemente_sobre_condicao_estudo
        FOREIGN KEY (sobre_condicao_estudo_id)
        REFERENCES SobreCondicaoEstudo(id_informacao_condicao_estudo)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'UltimoLivroGostado', filha de 'SobreCondicaoEstudo' */
CREATE TABLE UltimoLivroGostado (
    id_ultimo_livro_gostado INT AUTO_INCREMENT PRIMARY KEY,
    sobre_condicao_estudo_id INT NOT NULL,
    ordem_preferencia TINYINT UNSIGNED NOT NULL,
    nome_livro VARCHAR(255) NOT NULL,
    CONSTRAINT fk_ultimo_livro_gostado_sobre_condicao_estudo
        FOREIGN KEY (sobre_condicao_estudo_id)
        REFERENCES SobreCondicaoEstudo(id_informacao_condicao_estudo)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'CategoriaLivroFrequente', filha de 'SobreCondicaoEstudo' */
CREATE TABLE CategoriaLivroFrequente (
    id_categoria_livro_frequente INT AUTO_INCREMENT PRIMARY KEY,
    sobre_condicao_estudo_id INT NOT NULL,
    nome_categoria VARCHAR(50) NOT NULL,
    CONSTRAINT fk_categoria_livro_frequente_sobre_condicao_estudo
        FOREIGN KEY (sobre_condicao_estudo_id)
        REFERENCES SobreCondicaoEstudo(id_informacao_condicao_estudo)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'AcessoInternet', filha de 'SobreCondicaoEstudo' */
CREATE TABLE AcessoInternet (
    id_acesso_internet INT AUTO_INCREMENT PRIMARY KEY,
    sobre_condicao_estudo_id INT NOT NULL,
    local_acesso VARCHAR(50) NOT NULL,
    CONSTRAINT fk_acesso_internet_sobre_condicao_estudo
        FOREIGN KEY (sobre_condicao_estudo_id)
        REFERENCES SobreCondicaoEstudo(id_informacao_condicao_estudo)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* ************ SÉTIMO FORMULÁRIO ********** */

/* Tabela 'SobreVidaGeral', filha de 'UserParticipante' */
CREATE TABLE SobreVidaGeral (
    id_sobre_vida_geral INT AUTO_INCREMENT PRIMARY KEY,
    participante_id INT UNSIGNED NOT NULL,
    situacao_saude ENUM('Excelente', 'Muito boa', 'Boa', 'Passável', 'Muito mal', 'Não posso dizer') NOT NULL,
    tem_doenca_cronica TINYINT NOT NULL,
    tem_plano_saude TINYINT NOT NULL,
    plano_saude VARCHAR(50),
    altura DECIMAL(3,2),
    peso DECIMAL(5,2),
    foi_internado_hospital TINYINT NOT NULL,
    bebe_alcool TINYINT NOT NULL,
    tem_alimentacao_equilibrada TINYINT NOT NULL,
    razao_ausencia_tratamento VARCHAR(100) NOT NULL,
    usa_cigarro ENUM('Todos os dias', 'Ocasionalmente', 'Jamais') NOT NULL,
    quantidade_cigarros_dia TINYINT UNSIGNED,
    gosta_fazer VARCHAR(255) NOT NULL,
    comentario_pesquisa TEXT,
    CONSTRAINT fk_sobre_vida_geral_participante
        FOREIGN KEY (participante_id)
        REFERENCES UserParticipante(id_participante)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'FrequenciaBebidaAlcoolica', filha de 'SobreVidaGeral' */
CREATE TABLE FrequenciaBebidaAlcoolica (
    id_frequencia_bebida_alcoolica INT AUTO_INCREMENT PRIMARY KEY,
    sobre_vida_geral_id INT NOT NULL,
    bebida ENUM('Vinho', 'Cerveja', 'Cachaça') NOT NULL,
    nivel_frequencia ENUM('Todos os dias', '1 a 3 vezes por semana', '2 a 3 vezes por mês', 'Raramente', 'Jamais') NOT NULL,
    CONSTRAINT fk_bebida_sobre_vida_geral
        FOREIGN KEY (sobre_vida_geral_id)
        REFERENCES SobreVidaGeral(id_sobre_vida_geral)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'RazaoAlimentacaoDesequilibrada', filha de 'SobreVidaGeral' */
CREATE TABLE RazaoAlimentacaoDesequilibrada (
    id_razao_alimentacao_desequilibrada INT AUTO_INCREMENT PRIMARY KEY,
    sobre_vida_geral_id INT NOT NULL,
    descricao_razao VARCHAR(100) NOT NULL,
    
    CONSTRAINT fk_razao_alimentacao_sobre_vida_geral
        FOREIGN KEY (sobre_vida_geral_id)
        REFERENCES SobreVidaGeral(id_sobre_vida_geral)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'ProblemaUltimasSemanas', filha de 'SobreVidaGeral'*/
CREATE TABLE ProblemaUltimasSemanas (
    id_problema_ultima_semana INT AUTO_INCREMENT PRIMARY KEY,
    sobre_vida_geral_id INT NOT NULL,
    descricao_problema VARCHAR(50) NOT NULL,
    CONSTRAINT fk_problema_ultima_semana_sobre_vida_geral
        FOREIGN KEY (sobre_vida_geral_id)
        REFERENCES SobreVidaGeral(id_sobre_vida_geral)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

/* Tabela 'AtividadeForaTrabalho', filha de 'SobreVidaGeral' */
CREATE TABLE AtividadeForaTrabalho (
    id_atividade_fora_trabalho INT AUTO_INCREMENT PRIMARY KEY,
    sobre_vida_geral_id INT NOT NULL,
    descricao_atividade VARCHAR(50) NOT NULL,
    CONSTRAINT fk_atividade_fora_trabalho_sobre_vida_geral
        FOREIGN KEY (sobre_vida_geral_id)
        REFERENCES SobreVidaGeral(id_sobre_vida_geral)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=INNODB;

USE pesquisa_educacional;