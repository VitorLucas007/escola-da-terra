<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pesquisa_educacional/app/model/BancoDeDados.php';


class InformacaoIrmaoModel
{
    private $banco_de_dados;
    private $id_informacao_irmao;

    public function __construct($id_informacao_irmao)
    {
        $this->id_informacao_irmao = $id_informacao_irmao;
        $this->banco_de_dados = new BancoDeDados();
    }

    // Funções CRUD para persistência

    function inserirInformacaoIrmao(array $valores_sobre_irmao): bool
    {
        $sql = "INSERT INTO InformacaoIrmao (
            sobre_familia_id,
            nome,
            profissao,
            habita_mesma_localidade,
            local_habitacao
        ) VALUES (
            :sobre_familia_id,
            :nome,
            :profissao,
            :habita_mesma_localidade,
            :local_habitacao
        )";

        // CORREÇÃO: Usando sobre_familia_id (nome correto da chave estrangeira)
        $parametros = [
            ":sobre_familia_id" => isset($valores_sobre_irmao['sobre_familia_id']) ?
                $valores_sobre_irmao['sobre_familia_id'] : null,
            ":nome" => isset($valores_sobre_irmao['nome']) ?
                $valores_sobre_irmao['nome'] : null,
            ":profissao" => isset($valores_sobre_irmao['profissao']) ?
                $valores_sobre_irmao['profissao'] : 'Desconhecido',
            ":habita_mesma_localidade" => isset($valores_sobre_irmao['habita_mesma_localidade']) ?
                $valores_sobre_irmao['habita_mesma_localidade'] : 0,
            ":local_habitacao" => isset($valores_sobre_irmao['local_habitacao']) ?
                $valores_sobre_irmao['local_habitacao'] : null
        ];

        return $this->banco_de_dados->executar($sql, $parametros);
    }

    public function getUltimoIdInsercaoInformacaoIrmao(): string
    {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    function listarInformacaoIrmao()
    {
        $sql = "SELECT * FROM InformacaoIrmao";
        return $this->banco_de_dados->consultar($sql);
    }

    function modificarInformacaoIrmao() {}

    function excluirInformacaoIrmao() {}

    function buscarInformacaoIrmao() {}
}
