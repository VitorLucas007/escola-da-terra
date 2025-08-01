 <?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_familia/InformacaoFilhoMaiorIdadeModel.php';


class InformacaoFilhoMaiorIdadeController
{
    private $informacao_filho_maior_idade_model;

    public function __construct($id_informacao_filho_maior_idade)
    {
        $this->informacao_filho_maior_idade_model = new InformacaoFilhoMaiorIdadeModel($id_informacao_filho_maior_idade);
    }

    public function cadastrarDadosInformacaoFilhoMaior($valores_informacao_filho_maior): string | null
    {
        try {
            $persistencia_banco = $this->informacao_filho_maior_idade_model->inserirInformacaoFilhoMaiorIdade($valores_informacao_filho_maior);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoInformacaoFilhoMaior();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoInformacaoFilhoMaior(): string
    {
        try {
            return $this->informacao_filho_maior_idade_model->getUltimoIdInsercaoInformacaoFilhoMaior();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}