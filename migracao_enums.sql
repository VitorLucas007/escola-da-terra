/* Migração dos ENUMs do banco já criado (InfinityFree) para os valores que os formulários enviam.
   Rode no phpMyAdmin (aba SQL). Os dados que já foram gravados com valor vazio ('') NÃO são recuperados:
   apague o participante de teste (no final deste arquivo) e preencha de novo. */

ALTER TABLE SobreCursista MODIFY estado_civil
    ENUM('Casado(a)', 'União estável', 'Separado(a)', 'Jamais casado', 'Viúvo(a)', 'Divorciado(a)') NOT NULL;

ALTER TABLE InformacaoAvos
    MODIFY escolaridade_avo_masc ENUM('Sem escolaridade', 'Fundamental menor', 'Fundamental maior', 'Ensino medio', 'Ensino superior', 'Nao sabe responder') NOT NULL,
    MODIFY escolaridade_avo_fem  ENUM('Sem escolaridade', 'Fundamental menor', 'Fundamental maior', 'Ensino medio', 'Ensino superior', 'Nao sabe responder') NOT NULL;

ALTER TABLE FormacaoBasica MODIFY nivel_formacao
    ENUM('Fundamental_Menor', 'Fundamental_Maior', 'Ensino_Medio') NOT NULL;

ALTER TABLE SobreExercicioProfissao
    MODIFY identificacao_docencia  ENUM('Apaixonante', 'Interessante', 'Pouco motivante', 'Desencorajadora') NOT NULL,
    MODIFY trabalha_final_semana   ENUM('Sempre', 'Frequentemente', 'De vez em quando', 'Raramente', 'Jamais') NOT NULL,
    MODIFY periodo_trabalhoso_ano  ENUM('Inicio de ano', 'Fim de trimestre', 'Fim de ano', 'Todo o tempo') NOT NULL;

ALTER TABLE SobreCondicaoEstudo MODIFY frequencia_leitura_livros
    ENUM('Muito', 'Moderadamente', 'Pouco', 'Raramente') NOT NULL;

ALTER TABLE LeituraFrequente MODIFY frequencia_leitura
    ENUM('Todos os dias', '1 a 3 vezes na semana', '2 a 3 vezes por mês', 'Raramente', 'Jamais') NOT NULL;

ALTER TABLE UltimoLivroGostado MODIFY ordem_preferencia TINYINT UNSIGNED NOT NULL;

ALTER TABLE SobreVidaGeral MODIFY situacao_saude
    ENUM('Excelente', 'Muito boa', 'Boa', 'Passável', 'Muito mal', 'Não posso dizer') NOT NULL;

ALTER TABLE FrequenciaBebidaAlcoolica MODIFY nivel_frequencia
    ENUM('Todos os dias', '1 a 3 vezes por semana', '2 a 3 vezes por mês', 'Raramente', 'Jamais') NOT NULL;

/* ------------------------------------------------------------------------------------------
   CORREÇÃO MANUAL dos dados do Participante A (telefone (86) 99999-0001) que ficaram vazios.
   Rode SOMENTE depois dos ALTER TABLE acima. Cada UPDATE localiza a linha por um valor que
   o formulário gravou corretamente (ano, nome do livro, nome da bebida, veículo).
   ------------------------------------------------------------------------------------------ */

/* Formação básica: as 3 linhas ficaram com nivel_formacao vazio. Identificadas pelo ano de conclusão. */
UPDATE FormacaoBasica SET nivel_formacao = 'Fundamental_Menor' WHERE ano_conclusao = 1996 AND nivel_formacao = '';
UPDATE FormacaoBasica SET nivel_formacao = 'Fundamental_Maior' WHERE ano_conclusao = 2000 AND nivel_formacao = '';
UPDATE FormacaoBasica SET nivel_formacao = 'Ensino_Medio'      WHERE ano_conclusao = 2003 AND nivel_formacao = '';

/* Leitura frequente: só "Livros" tinha valor inválido ("2 a 3 vezes por mês"). */
UPDATE LeituraFrequente SET frequencia_leitura = '2 a 3 vezes por mês'
WHERE veiculo_lido = 'Livros' AND frequencia_leitura = '';

/* Últimos livros: ordem_preferencia virou número; identificado pelo nome do livro. */
UPDATE UltimoLivroGostado SET ordem_preferencia = 1 WHERE nome_livro = 'Dom Casmurro';
UPDATE UltimoLivroGostado SET ordem_preferencia = 2 WHERE nome_livro = 'Vidas Secas';
UPDATE UltimoLivroGostado SET ordem_preferencia = 3 WHERE nome_livro = 'Pedagogia da Autonomia';

/* Bebidas: Vinho ("Raramente") já está certo; faltam Cerveja e Cachaça. */
UPDATE FrequenciaBebidaAlcoolica SET nivel_frequencia = '2 a 3 vezes por mês'
WHERE bebida = 'Cerveja' AND nivel_frequencia = '';
UPDATE FrequenciaBebidaAlcoolica SET nivel_frequencia = 'Jamais'
WHERE bebida = 'Cachaça' AND nivel_frequencia = '';

/* Conferir (nenhuma linha deve voltar vazia): */
SELECT * FROM FormacaoBasica;
SELECT * FROM LeituraFrequente;
SELECT * FROM UltimoLivroGostado;
SELECT * FROM FrequenciaBebidaAlcoolica;
