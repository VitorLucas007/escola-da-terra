<?php 


require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDedados.php';

class FonteStressModel {
    private $banco_de_dados;
    private $id_fonte_stress;


    public function __construct($id_fonte_stress)
    {
        $this->id_fonte_stress = $id_fonte_stress;
        $this->banco_de_dados = new BancoDeDados();
    }


    //CRUD

    public function cadastrarFonteStress(array $valores_fonte_stress): bool {
        $sql = "INSERT INTO FonteStress(
        'sobre_exercicio_profissao_id',
        'descricao_fonte'
        ) VALUES (
        ':sobre_exercicio_profissao_id',
        ':descricao_fonte'
        )";
        $params = [
            'sobre_exercicio_profissao_id' => $valores_fonte_stress['sobre_exercicio_profissao_id'],
            'descricao_fonte' => $valores_fonte_stress['descricao_fonte']
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoFonteStrees(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}


?>