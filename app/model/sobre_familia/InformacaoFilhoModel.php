<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';

class InformacaoFilhoModel
{
    private $banco_de_dados;
    private $id_informacao_filho;


    public function __construct($id_informacao_filho)
    {
        $this->id_informacao_filho = $id_informacao_filho;
        $this->banco_de_dados = new BancoDeDados();
    }

    // Funções de CRUD para persistência

    function inserirInformacaoFilho(array $valores_informacao_filho)
    {
        $sql = "INSERT INTO InformacaoFilho (
            id_informacao_filho,
            nome,
            sexo,
            data_nascimento,
            vive_com_participante,
            idade_saiu_casa,
        ) VALUES (
            :id_informacao_filho,
            :nome,
            :sexo,
            :data_nascimento
            :vive_com_participante,
            :idade_saiu_casa
        )";

        $parametros = [
            ':id_informacao_filho' => $valores_informacao_filho['id_informacao_filho'],
            ':nome' => $valores_informacao_filho['nome'],
            ':sexo' => $valores_informacao_filho['sexo'],
            ':data_nascimento' => $valores_informacao_filho['data_nascimento'],
            ':vive_com_participante' => $valores_informacao_filho['vive_com_participante'],
            ':solteiro' => $valores_informacao_filho['solteiro'],
            ':idade_saiu_casa' => $valores_informacao_filho['idade_saiu_casa']
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoInformacaoFilho() : string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    function listarInformacaoFilho() {
     $sql = "SELECT * FROM InformacaoFilho";
        return $this->banco_de_dados->consultar($sql);
    }

    function modificarInformacaoFilho() {

    }

    function excluirInformacaoFilho() {

    }

    function buscarSobreInformacaoFilho() {

    }
}
