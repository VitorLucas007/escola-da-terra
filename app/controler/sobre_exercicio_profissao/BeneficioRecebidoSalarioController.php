<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/sobre_exercicio_profissao/BeneficioRecebidosSalarioModel.php';


class BeneficioRecebidoSalarioController {
    private $beneficio_recebido_salario_model;

    public function __construct($id_beneficio_recebido_salario)
    {
        $this->beneficio_recebido_salario_model = new BeneficioRecebidoSalarioModel($id_beneficio_recebido_salario);
    }

    public function cadastrarBeneficioSalarioRecebido($valores_beneficio_recebido_salario): string | null {
        try {
            $persistencia_banco = $this->beneficio_recebido_salario_model->cadastrarBeneficioRecebidoSalario($valores_beneficio_recebido_salario);
            if ($persistencia_banco) {
                $ultimo_id_insercao = $this->getUltimoIdInsercaoBeneficioRecebidoSalario();
                return $ultimo_id_insercao;
            }
            echo "Ocorreu um erro ao persistir os valores";
            exit; 
        } catch (Exception $exception) {
            echo "Excessão encontrada ->" . $exception->getMessage();
            exit;
        }
    }


    public function getUltimoIdInsercaoBeneficioRecebidoSalario(): string {
        try {
            return $this->beneficio_recebido_salario_model->getUltimoIdInsercaoBeneficioRecebidoSalario();
        } catch (\Throwable $th) {
            $_SESSION['mensagem_execao'] = "Erro ao obter o ultimo ID de inserção";
            header("Location: /pesquisa_educacional/views/erro.php");
            exit;
        }
    }
}



?>