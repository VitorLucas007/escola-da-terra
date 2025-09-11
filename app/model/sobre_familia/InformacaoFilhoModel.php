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

    function inserirInformacaoFilho(array $valores_informacao_filho) : bool
{
    $sql = "INSERT INTO InformacaoFilho (
        sobre_familia_id,
        nome,
        sexo,
        data_nascimento,
        vive_com_participante,
        solteiro,
        idade_saiu_casa
    ) VALUES (
        :sobre_familia_id,
        :nome,
        :sexo,
        :data_nascimento,
        :vive_com_participante,
        :solteiro,
        :idade_saiu_casa
    )";

    $parametros = [
        ':sobre_familia_id' => $valores_informacao_filho['sobre_familia_id'],
        ':nome' => $valores_informacao_filho['nome'],
        ':sexo' => $valores_informacao_filho['sexo'],
        ':data_nascimento' => $valores_informacao_filho['data_nascimento'],
        ':vive_com_participante' => $valores_informacao_filho['vive_com_participante'],
        ':solteiro' => $valores_informacao_filho['solteiro'],
        ':idade_saiu_casa' => $valores_informacao_filho['idade_saiu_casa'] ?? null
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

    public function buscarFilhosComDetalhesPorFamiliaIdBanco($id_sobre_familia) {
    $sql = "
        SELECT 
            f.*,
            fm.situacao_vida,
            fme.etapa_educacao, fme.habitacao_fora_escola, fme.acompanhante
        FROM InformacaoFilho f
        LEFT JOIN InformacaoFilhoMaiorIdade fm ON f.id_informacao_filho = fm.informacao_filho_id
        LEFT JOIN InformacaoFilhoMenorIdade fme ON f.id_informacao_filho = fme.informacao_filho_id
        WHERE f.sobre_familia_id = :id_sobre_familia
    ";
    $parametros = [':id_sobre_familia' => $id_sobre_familia];
    return $this->banco_de_dados->consultar($sql, $parametros);
}
}
