<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';

class CategoriaLivroFrequenteModel {
    
    private $banco_de_dados;
    private $id_categoria_livro_frequente;
    
    public function __construct($id_categoria_livro_frequente){
        $this->id_categoria_livro_frequente = $id_categoria_livro_frequente;
        $this->banco_de_dados = new BancoDeDados();
    }
    
    // CRUD
    public function cadastrarCategoriaLivroFrequente(array $valores_categoria_livro): bool {
        $sql = "INSERT INTO CategoriaLivroFrequente (
            sobre_condicao_estudo_id,
            nome_categoria
        ) VALUES (
            :sobre_condicao_estudo_id,
            :nome_categoria
        )";
        
        $params = [
            ':sobre_condicao_estudo_id' => $valores_categoria_livro['sobre_condicao_estudo_id'],
            ':nome_categoria' => $valores_categoria_livro['nome_categoria']
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }
    
    public function getUltimoIdInsercaoCategoriaLivroFrequente(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }
}