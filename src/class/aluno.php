<?php
 
include "db/conection.php";

class Aluno {
    public $nome;
    public $idade;
    private $cpf;
    public $curso;
 
    // Construtor com validação
    public function __construct($nome, $idade, $cpf, $curso) {
        if (empty($nome)) {
            throw new Exception("O campo Nome é obrigatório.");
        }
        if (!filter_var($idade, FILTER_VALIDATE_INT) || $idade < 0) {
            throw new Exception("A Idade deve ser um número inteiro positivo.");
        }
        if (empty($cpf)) {
            throw new Exception("O campo CPF é obrigatório.");
        }
        if (empty($curso)) {
            throw new Exception("O campo Curso é obrigatório.");
        }
        $this->nome = $nome;
        $this->idade = $idade;
        $this->cpf = $cpf;
        $this->curso = $curso;
    }
 
    // Getter do CPF (encapsulamento)
    public function getCpf() {
        return $this->cpf;
    }
 
   // 🔹 MÉTODO NOVO: salvar no banco
    public function salvarNoBanco() {
        $database = new Conexao();
        $conn = $database->getConexao();
        $sql = "INSERT INTO aluno (nome, idade, cpf) VALUES (:nome, :idade, :cpf)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':cpf', $this->cpf);
        return $stmt->execute();

    }
    // Método para listar os alunos
    public static function listar() {
        // Conexão com o banco de dados
        $database = new Conexao();
        $conn = $database->getConexao();

        // Preparar a consulta SQL
        $query = "SELECT * FROM aluno";
        $stmt = $conn->prepare($query);
        $stmt->execute();
 
        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

