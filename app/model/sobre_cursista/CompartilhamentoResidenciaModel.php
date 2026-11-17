<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/BancoDeDados.php';  


class CompartilhamentoResidenciaModel{

    private $banco_de_dados;
    private $sobre_cursista_id;

    public function __construct($sobre_cursista_id){
        $this->sobre_cursista_id = $sobre_cursista_id;
        $this->banco_de_dados = new BancoDeDados();
    }

    public function cadastrarCompartilhamentoResidenciaBanco($valor_compartilhamento) : bool{
        $sql = "INSERT INTO CompartilhamentoResidencia(sobre_cursista_id, compartilha_com)
        VALUES(:sobre_cursista_id, :compartilha_com)
        ";
        
        $parametros = [
            ":sobre_cursista_id" => $this->sobre_cursista_id,
            ":compartilha_com" => $valor_compartilhamento,
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function buscarPorCursistaIdBanco($id_sobre_cursista) {
    $sql = "SELECT * FROM CompartilhamentoResidencia WHERE sobre_cursista_id = :id";
    $parametros = [':id' => $id_sobre_cursista];
    return $this->banco_de_dados->consultar($sql, $parametros);
}

}



?>