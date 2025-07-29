<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';    

class OpiniaoTemaSobreCursistaModel{

    private $participante_id;
    private $banco_de_dados;

    public function __construct($participante_id){
        $this->participante_id = $participante_id;
        $this->banco_de_dados = new BancoDeDados();
    }

    public function cadastrarOpiniaoTemaSobreCursista($tema_opiniao, $texto_opiniao): bool{
        $sql = "INSERT INTO OpiniaoTemaSobreCursista(sobre_cursista_id, tema_opiniao, texto_opiniao)
        VALUES(:sobre_cursista_id, :tema_opiniao, :texto_opiniao)
        " ;

        $parametros = [
            'sobre_cursista_id' => $this->participante_id,
            ':tema_opiniao' => $tema_opiniao,
            ':texto_opiniao' => $texto_opiniao,
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }




}




?>