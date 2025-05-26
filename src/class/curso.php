<?php
 
include "db/conection.php";

class Curso {
    public $titulo;
    public $horas;
    public $dias;
    private $aluno;
 
    // Construtor com validação
    public function __construct($titulo, $horas,$dias, $aluno) {
        if (empty($titulo)) {
            throw new Exception("O campo Título é obrigatório.");
        }
        if (empty($horas)) {
            throw new Exception("O campo Horas é obrigatório.");
        }
        if (empty($aluno)) {
            throw new Exception("O campo Aluno é obrigatório.");
        }
        $this->titulo = $titulo;
        $this->horas = $horas;
        $this->dias = $dias;
        $this->aluno = $aluno;
    }
 
    // Getter do Aluno (encapsulamento)
    public function getAluno() {
        return $this->aluno;
    }
 
    // NOVO MÉTODO: Salvar no banco
    public function salvarNoBanco() {
        $database = new Conexao();
        $conn = $database->getConexao();
        $sql = "INSERT INTO curso (titulo, horas, dias) VALUES (:titulo, :horas, :dias)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':horas', $this->horas);
        $stmt->bindParam(':dias', $this->dias);
        return $stmt->execute(); // retorna true/false
    }
        // Método para listar os alunos
    public static function listar() {
        // Conexão com o banco de dados
        $database = new Conexao();
        $conn = $database->getConexao();

        // Preparar a consulta SQL
        $query = "SELECT * FROM curso";
        $stmt = $conn->prepare($query);
        $stmt->execute();
 
        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}