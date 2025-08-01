<?php 

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';


class SobreFamiliaModel {

    private $banco_de_dados;
    private $id_informacao_familiares;    


    public function __construct($id_informacao_familiares){
        $this->id_informacao_familiares = $id_informacao_familiares;
        $this->banco_de_dados = new BancoDeDados();
    }

    // CRUD
    public function cadastrarSobreFamilia(array $valores_sobre_familia): bool {
        $sql = "INSERT INTO SobreFamilia (
            participante_id,
            possui_filhos,
            quantidade_irmaos
        ) VALUES (
            :participante_id,
            :possui_filhos,
            :quantidade_irmaos
        )";
        
        $params = [
            ':participante_id' => $valores_sobre_familia['participante_id'],
            ':possui_filhos' => $valores_sobre_familia['possui_filhos'],
            ':quantidade_irmaos' => $valores_sobre_familia['quantidade_irmaos']
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }

    public function getUltimoIdInsercaoSobreFamilia(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

    public function atualizarSobreFamilia(){
    }

    public function excluirSobreFamilia(){
    }

    public function getSobreFamiliaPorId(){
    }

    public function listarTodos(){
        $sql = "SELECT * FROM SobreFamilia";
        return $this->banco_de_dados->consultar($sql);
    }
}
