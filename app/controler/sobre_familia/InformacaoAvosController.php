 <?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_familia/InformacaoAvosModel.php';


class InformacaoAvosController {
    private $informacao_avos_model;

    public function __construct($id_informacao_avos) {
        $this->informacao_avos_model = new InformacaoAvosModel($id_informacao_avos);
    }

    public function cadastrarDadosInformacaoAvos($valores_informacao_avos) : string | null {
        try {
            $persistencia_banco = $this->informacao_avos_model->inserirInformacaoAvos($valores_informacao_avos);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoInformacaoAvos();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoInformacaoAvos() : string {
        try {
            return $this->informacao_avos_model->getUltimoIdInsercaoInformacaoAvos();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarAvosPorFamiliaId($id_sobre_familia) {
    return $this->informacao_avos_model->buscarPorSobreFamiliaIdBanco($id_sobre_familia);
    }
}