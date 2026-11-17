<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/UserParticipanteModel.php';

class UserParticipanteControler{

    private $user_participante_model;

    public function __construct($telefone_passado=0, $progresso_participante_passado=0){

        // Pesquisador que está logado na sessão
        $id_pesquisador_logado = $_SESSION['id_pesquisador'] ?? null;

        $this->user_participante_model = new UserParticipanteModel( $telefone_passado, $progresso_participante_passado, $id_pesquisador_logado);
    }

    

    public function cadastrarUserParticipante() : void{
        try{
            $persistencia_banco = $this->user_participante_model->cadastrarUserParticipanteBanco();
            if($persistencia_banco){
                session_regenerate_id(true);
                $_SESSION['id_participante'] = $this->getIdUltimaPersistencia();
                header('Location: /views/formularios/formulario_sobre_cursista.php');
                exit;
            }
            else{   
<<<<<<< HEAD
                $_SESSION['mensagem_erro_user_participante'] = "Infelizmente ocorreu um erro ao salvar o telefone do participante, tente novamente.";
                header('Location: /pesquisa_educacional/index.php');
=======
                $_SESSION['mensagem_erro_user_participante'] = "Ocorreu um erro ao salvar o telefone do participante, tente novamente.";
                header('Location: /index.php');
>>>>>>> lucas
                exit;
            }
        }
        catch(Exception $exception){
<<<<<<< HEAD
            $_SESSION['mensagem_excecao'] = "Infelizmente ocorreu um erro ao cadastrar os dados do participante, tente novamente.\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
=======
            $_SESSION['mensagem_excecao'] = $exception->getMessage();
            header("Location: /views/erro.php");
>>>>>>> lucas
            exit;
        }
    }   

    public function atualizarProgressoParticipante($id_participante, $novo_progresso) : bool{
        try{
            $requisicao_atualizacao = $this->user_participante_model->atualizarProgressoParticipanteBanco($id_participante, $novo_progresso);
            if($requisicao_atualizacao){
                return true;
            }
            return false;
        }
        catch(Exception $exception){
<<<<<<< HEAD
            $_SESSION['mensagem_excecao'] = "Infelizmente ocorreu um erro ao atualizar o progresso do participante\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
=======
            $_SESSION['mensagem_excecao'] = $exception->getMessage();
            header("Location: /views/erro.php");
>>>>>>> lucas
            exit;
        }
    }

    public function verificarExistenciaUserParticipante():bool{
        try{
            $participante_testado = $this->user_participante_model->getUserParticipanteBanco($this->user_participante_model->getTelefone());
            if($participante_testado != null){
                return true;
            }
            else{
                return false;
            }
        }
        catch(Exception $exception){
<<<<<<< HEAD
            $_SESSION['mensagem_excecao'] = "Infelizmente ocorreu um erro ao verificar credênciais do participante, tente novamente.\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
=======
            $_SESSION['mensagem_excecao'] = $exception->getMessage();
            header("Location: /views/erro.php");
>>>>>>> lucas
            exit;
        }
    }

    public function getUserParticipante(): UserParticipanteModel | null{
        try{
            $participante = $this->user_participante_model->getUserParticipanteBanco($this->user_participante_model->getTelefone());
            if($participante != null){
                $id = $participante[0]['id_participante'];
                $telefone = $participante[0]['telefone'];
                $progresso = $participante[0]['progresso_participante'];
                $id_pesquisador = $participante[0]['id_pesquisador_responsavel'] ?? null;
                $participante_obtido = new UserParticipanteModel($telefone, $progresso, $id_pesquisador);
                $participante_obtido->setIdParticipante($id);
                return $participante_obtido;
            }
            else{
                return null;
            }
        }
        catch(Exception $exception){
<<<<<<< HEAD
            $_SESSION['mensagem_excecao'] = "Infelizmente ocorreu um erro ao obter a credênciais do participante, tente novamente.\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
=======
            $_SESSION['mensagem_excecao'] = $exception->getMessage();
            header("Location: /views/erro.php");
>>>>>>> lucas
            exit;
        }
    }

    /**
     * progresso_participante no banco = quantidade de formulários já concluídos (0 a 7). 7 = pesquisa concluída.
     * Redireciona para o próximo formulário: 0=cursista, 1=família, 2=formação, 3=carreira,
     * 4=exercício profissão, 5=condição estudo, 6=vida geral, 7=concluído (página de sucesso).
     */
    public function redirecionarBaseadoProgressoParticipante($progresso) : void{
        try{
            $p = (int) $progresso;

            if ($p >= 7) {
                header('Location: /views/success.php');
                exit;
            }

            switch ($p) {
                case 0:
                    header('Location: /views/formularios/formulario_sobre_cursista.php');
                    exit;
                case 1:
                    header('Location: /views/formularios/formulario_sobre_familia.php');
                    exit;
                case 2:
                    header('Location: /views/formularios/formulario_sobre_formacao_escolar.php');
                    exit;
                case 3:
                    header('Location: /views/formularios/formulario_sobre_carreira.php');
                    exit;
                case 4:
                    header('Location: /views/formularios/formulario_sobre_exercicio_profissao.php');
                    exit;
                case 5:
                    header('Location: /views/formularios/formulario_sobre_condicao_estudo.php');
                    exit;
                case 6:
                    header('Location: /views/formularios/formulario_sobre_vida_geral.php');
                    exit;
                default:
                    $_SESSION['mensagem_erro_user_participante'] = "Progresso do participante inválido. Entre em contato com o suporte ou tente novamente.";
                    header('Location: /index.php');
                    exit;
            }
        }
        catch(Exception $exception){
<<<<<<< HEAD
            $_SESSION['mensagem_excecao'] = "Infelizmente ocorreu um erro no redirecianamento ao formulário, tente novamente.\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
=======
            $_SESSION['mensagem_excecao'] = $exception->getMessage();
            header("Location: /views/erro.php");
>>>>>>> lucas
            exit;
        }
    }

    public function getIdUltimaPersistencia() : string | null{
        try{
           return $this->user_participante_model->getIdUltimaPersistenciaBanco();
        }
        catch(Exception $exception){
<<<<<<< HEAD
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção, tente novamente.\nErro -> " . $exception->getMessage();
            header("Location: /pesquisa_educacional/views/erro.php");
=======
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /views/erro.php");
>>>>>>> lucas
            exit;
        }
    }

    public function listarTodosUsersParticipantes(): array {
        try {
            return $this->user_participante_model->listarTodosUsersParticipantes();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao listar participantes: " . $exception->getMessage();
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarParticipantePorId($id) {
        try {
            return $this->user_participante_model->buscarParticipantePorIdBanco($id);
        } catch (Exception $e) {
            error_log("Erro ao buscar participante: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Lista todos os participantes de um pesquisador específico
     */
    public function listarParticipantesPorPesquisador($id_pesquisador) {
        try {
            return $this->user_participante_model->buscarParticipantesPorPesquisadorId($id_pesquisador);
        } catch (Exception $e) {
            error_log("Erro ao listar participantes do pesquisador: " . $e->getMessage());
            return [];
        }
    }

}

?>