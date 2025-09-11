 <?php 

 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

 require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_familia/InformacaoGenitorModel.php';
 

 class InformacaoGenitorController {
    private $informacao_genitor_model;

    public function __construct($id_informacao_genitor) {
        $this->informacao_genitor_model = new InformacaoGenitorModel($id_informacao_genitor);
    }

    public function cadastrarDadosInformacaoGenitor($valores_informacao_genitor) : string | null {
        try {
            $persistencia_banco = $this->informacao_genitor_model->inserirInformacaoGenitor($valores_informacao_genitor);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoInformacaoGenitor();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $exception) {
            echo "Exceção encontrada ->" . $exception->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoInformacaoGenitor() : string {
        try {
            return $this->informacao_genitor_model->getUltimoIdInsercaoInformacaoGenitor();
        } catch (Exception $exception) {
            $_SESSION['mensagem_excecao'] = "Erro ao obter o último ID de inserção.";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }

    public function buscarGenitoresPorFamiliaId($id_sobre_familia) {
    return $this->informacao_genitor_model->buscarPorSobreFamiliaIdBanco($id_sobre_familia);
    }


 }
 
 
 ?>