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
            sobre_familia_id,
            nome,
            sexo,
            data_nascimento,
            vive_com_participante,
            solteiro,
            idade_saiu_casa
        ) VALUES (
            :id_informacao_filho,
            :sobre_familia_id,
            :nome,
            :sexo,
            :data_nascimento,
            :vive_com_participante,
            :solteiro,
            :idade_saiu_casa
        )";


        $parametros = [
            ':id_informacao_filho' => isset($valores_informacao_filho['id_informacao_filho']) ?
                $valores_informacao_filho['id_informacao_filho'] :
                $this->id_informacao_filho,
            ':sobre_familia_id' => isset($valores_informacao_filho['sobre_familia_id']) ?
                $valores_informacao_filho['sobre_familia_id'] : null,
            ':nome' => isset($valores_informacao_filho['nome']) ?
                $valores_informacao_filho['nome'] : null,
            ':sexo' => isset($valores_informacao_filho['sexo']) ?
                $valores_informacao_filho['sexo'] : null,
            ':data_nascimento' => isset($valores_informacao_filho['data_nascimento']) ?
                $valores_informacao_filho['data_nascimento'] : null,
            ':vive_com_participante' => isset($valores_informacao_filho['vive_com_participante']) ?
                $valores_informacao_filho['vive_com_participante'] : null,
            ':solteiro' => isset($valores_informacao_filho['solteiro']) ?
                $valores_informacao_filho['solteiro'] : null,
            ':idade_saiu_casa' => isset($valores_informacao_filho['idade_saiu_casa']) ?
                $valores_informacao_filho['idade_saiu_casa'] : null
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoInformacaoFilho(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    function listarInformacaoFilho()
    {
        $sql = "SELECT * FROM InformacaoFilho";
        return $this->banco_de_dados->consultar($sql);
    }

    function modificarInformacaoFilho() {}

    function excluirInformacaoFilho() {}

    function buscarSobreInformacaoFilho() {}
}
