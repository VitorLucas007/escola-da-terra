 <?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

class RazaoAlimentacaoDesequilibradaModel {
    private $banco_de_dados;
    private $id_razao_alimentacao_desequilibrada;

    public function __construct($id_razao_alimentacao_desequilibrada)
    {
        $this->id_razao_alimentacao_desequilibrada = $id_razao_alimentacao_desequilibrada;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function inserirRazaoAlimentacaoDesequilibrada(array $valores_razao_alimentacao): bool
    {
        $sql = "INSERT INTO RazaoAlimentacaoDesequilibrada (
            sobre_vida_geral_id,
            descricao_razao
        ) VALUES (
            :sobre_vida_geral_id,
            :descricao_razao
        )";

        $params = [
            'sobre_vida_geral_id' => $valores_razao_alimentacao['sobre_vida_geral_id'],
            'descricao_razao' => $valores_razao_alimentacao['descricao_razao'],
        ];

        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoRazaoAlimentacaoDesequilibrada(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}