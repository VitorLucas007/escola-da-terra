<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';    

class OpiniaoTemaSobreCursistaModel{

    private $sobre_cursista_id;
    private $banco_de_dados;

    public function __construct($sobre_cursista_id){
        $this->sobre_cursista_id = $sobre_cursista_id;
        $this->banco_de_dados = new BancoDeDados();
    }

    public function cadastrarOpiniaoTemaSobreCursistaBanco($tema_opiniao, $texto_opiniao): bool{
        $sql = "INSERT INTO OpiniaoTemaSobreCursista(sobre_cursista_id, tema_opiniao, texto_opiniao)
        VALUES(:sobre_cursista_id, :tema_opiniao, :texto_opiniao)
        " ;

        $parametros = [
            'sobre_cursista_id' => $this->sobre_cursista_id,
            ':tema_opiniao' => $tema_opiniao,
            ':texto_opiniao' => $texto_opiniao,
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }




}




?>