<?php
class ConexaoBanco {
    
    private $host;            
    private $db;        
    private $user;              
    private $pass;                
    private $charset;           
    private $informacoes_banco;
    private $conexao_banco;
    private $opcoes_conexao;

    public function __construct() {
        $this->host = "localhost";
        $this->db = "pesquisa_educacional";
        $this->user = "root";
        $this->pass = "";
        $this->charset = "utf8mb4";
        $this->informacoes_banco = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->opcoes_conexao = [ 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false, 
        ];
    }

    public function getConexaoBanco() {
        return $this->conexao_banco;
    }

    public function setConexaoBanco(){
        try {
            $this->conexao_banco = new PDO($this->informacoes_banco,  $this->user, $this->pass, $this->opcoes_conexao);
        } catch (PDOException $e) {
            throw new Exception("Ocorreu um erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

}
?>
