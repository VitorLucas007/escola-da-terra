<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';

class UltimoLivroGostadoModel {
    
    private $banco_de_dados;
    private $id_ultimo_livro_gostado;
    
    public function __construct($id_ultimo_livro_gostado){
        $this->id_ultimo_livro_gostado = $id_ultimo_livro_gostado;
        $this->banco_de_dados = new BancoDeDados();
    }
    
    // CRUD
    public function cadastrarUltimoLivroGostado(array $valores_ultimo_livro): bool {
        $sql = "INSERT INTO UltimoLivroGostado (
            sobre_condicao_estudo_id,
            ordem_preferencia,
            nome_livro
        ) VALUES (
            :sobre_condicao_estudo_id,
            :ordem_preferencia,
            :nome_livro
        )";
        
        $params = [
            ':sobre_condicao_estudo_id' => $valores_ultimo_livro['sobre_condicao_estudo_id'],
            ':ordem_preferencia' => $valores_ultimo_livro['ordem_preferencia'],
            ':nome_livro' => $valores_ultimo_livro['nome_livro']
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }
    
    public function getUltimoIdInsercaoUltimoLivroGostado(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

}