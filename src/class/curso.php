<?php
 
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
 
    // Método para exibir os dados
    public function exibirDados() {
        echo "<p>Título: <strong>$this->titulo</strong><br>";
        echo "Horas: <strong>$this->horas</strong> anos<br>";
        echo "Dias: <strong>$this->dias</strong><br>";
        echo "Aluno: <strong>" . $this->getAluno() . "</strong></p>";
    }
}