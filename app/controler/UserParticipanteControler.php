<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/UserParticipanteModel.php';

class UserParticipanteControler{

    private $user_participante_model;

    public function __construct($telefone_passado=0, $progresso_participante_passado=1){
        $this->user_participante_model = new UserParticipanteModel( $telefone_passado, $progresso_participante_passado);
    }

    public function cadastrarUserParticipante(){
        $persistencia_banco = $this->user_participante_model->cadastrarUserParticipanteBanco();
        if($persistencia_banco){
            header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_cursista.php');
            exit;
        }
        else{   
            $_SESSION['mensagem_erro_user_participante'] = "Ocorreu um erro ao salvar o telefone do participante, tente novamente.";
            header('Location: /pesquisa_educacional/index.php');
            exit;
        }
    }   

    public function atualizarProgressoParticipante($id_usuario_participante, $novo_progresso) : bool{
        $requisicao_atualizacao = $this->user_participante_model->atualizarProgressoParticipanteBanco($id_usuario_participante, $novo_progresso);
        if($requisicao_atualizacao){
            return true;
        }
        return false;
    }

    public function verificarExistenciaUserParticipante():bool{
        $participante_testado = $this->user_participante_model->getUserParticipanteBanco($this->user_participante_model->getTelefone());
        if($participante_testado != null){
            return true;
        }
        else{
            return false;
        }
    }

    public function getUserParticipante(): UserParticipanteModel | null{
        $participante = $this->user_participante_model->getUserParticipanteBanco($this->user_participante_model->getTelefone());
        if($participante != null){
            $id = $participante[0]['id_participante'];
            $telefone = $participante[0]['telefone'];
            $progresso = $participante[0]['progresso_participante'];
            $participante_obtido = new UserParticipanteModel($telefone, $progresso);
            $participante_obtido->setIdParticipante($id);
            return $participante_obtido;
        }
        else{
            return null;
        }
    }

    public function redirecionarBaseadoProgressoParticipante($progresso) : void{
        switch($progresso){
            case 1:
                header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_cursista.php');
                exit;
            case 2:
                header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_familia.php');
                exit;
            case 3:
                header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_formacao_escolar.php');
                exit;
            case 4:
                header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_carreira.php');
                exit;
            case 5:
                header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_exercicio_profissao.php');
                exit;
            case 6:
                header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_condicao_estudo.php');
                exit;
            case 7:
                header('Location: /pesquisa_educacional/views/formularios/formulario_sobre_vida_geral.php');
                exit;
            default:
                $_SESSION['mensagem_erro_user_participante'] = "Ocorreu um erro no redirecionamento ao formulário, tente novamente.";
                header('Location: /pesquisa_educacional/index.php');
                exit;    
            }
    }



}

?>