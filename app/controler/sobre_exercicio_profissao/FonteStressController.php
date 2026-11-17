 <?php 
 
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/sobre_exercicio_profissao/FonteStressModel.php';


 class FonteStressController {
    private $fonte_stress_model;

    public function __construct($id_fonte_stress)
    {
        $this->fonte_stress_model = new FonteStressModel($id_fonte_stress);
    }

    public function cadastrarDadosFonteStress($valores_fonte_stress): string | null{
        try {
            $persistencia_banco = $this->fonte_stress_model->cadastrarFonteStress($valores_fonte_stress);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoFonteStress();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit;
        } catch (Exception $excpetion) {
            echo "Execessao encontrada ->" . $excpetion->getMessage();
            exit;
        }
    }

    public function getUltimoIdInsercaoFonteStress(): string {
        try {
            return $this->fonte_stress_model->getUltimoIdInsercaoFonteStress();
        } catch (Exception $excpetion) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /views/erro.php");
            exit;
        }
    }

    public function buscarFontesStressPorExercicioId($id_exercicio_profissao) {
    return $this->fonte_stress_model->buscarPorExercicioProfissaoIdBanco($id_exercicio_profissao);
    }
 }
 
 ?>