 <?php 

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pesquisa_educacional/app/model/BancoDeDados.php';


class EtapaAtuanteEducacaoModel {

    private $banco_de_dados;
    private $id_etapa_atuante_educacao;


    public function __construct($id_etapa_atuante_educacao){
        $this->id_etapa_atuante_educacao = $id_etapa_atuante_educacao;
        $this->banco_de_dados = new BancoDeDados();
    }


    public function cadastrarEtapaAtuanteEducacao(array $valores_etapa_atuante): bool {
        $sql = "INSERT INTO EtapaAtuanteEducacao (
            participante_id,
            estabelecimento_trabalho_id,
            nivel_etapa,
        ) VALUES (
            :participante_id,
            :estabelecimento_trabalho_id,
            :nivel_etapa,
        )";
        
        $params = [
            ':participante_id' => isset($valores_etapa_atuante['participante_id']) ?
                $valores_etapa_atuante['participante_id'] : null,
            ':estabelecimento_trabalho_id' => isset($valores_etapa_atuante['estabelecimento_trabalho_id']) ?
                $valores_etapa_atuante['estabelecimento_trabalho_id'] : null,
            ':nivel_etapa' => isset($valores_etapa_atuante['nivel_etapa']) ?
                $valores_etapa_atuante['nivel_etapa'] : null
        ];
        
        return $this->banco_de_dados->executar($sql, $params);
    }   

    public function getUltimoIdInsercaoEtapaAtuante(): string {
        return $this->banco_de_dados->getUltimoIdInsercao();
    }

}

?>