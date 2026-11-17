<?php 

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/app/model/BancoDeDados.php';


class FormacaoBasicaModel {
    private $banco_de_dados;
    private $id_informacao_formacao_basica;


    public function __construct($id_informacao_formacao_basica){
        $this->id_informacao_formacao_basica = $id_informacao_formacao_basica;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function inserirFormacaoBasica(array $valores_formacao_basica): bool {
        $sql = "INSERT INTO FormacaoBasica (
            sobre_formacao_escolar_id,
            nivel_formacao,
            tipo_escola,
            municipio_formacao,
            ano_conclusao
        ) VALUES (
            :sobre_formacao_escolar_id,
            :nivel_formacao,
            :tipo_escola,
            :municipio_formacao,
            :ano_conclusao
        )";
        
        $params = [
            ':sobre_formacao_escolar_id' => $valores_formacao_basica['sobre_formacao_escolar_id'],
            ':nivel_formacao' => $valores_formacao_basica['nivel_formacao'],
            ':tipo_escola' => $valores_formacao_basica['tipo_escola'],
            ':municipio_formacao' => $valores_formacao_basica['municipio_formacao'],
            ':ano_conclusao' => $valores_formacao_basica['ano_conclusao'],
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoFormacaoBasica(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function buscarPorFormacaoEscolarIdBanco($id_formacao_escolar) {
    $sql = "SELECT * FROM FormacaoBasica WHERE sobre_formacao_escolar_id = :id";
    $parametros = [':id' => $id_formacao_escolar];
    return $this->banco_de_dados->consultar($sql, $parametros);
    }
}


?>