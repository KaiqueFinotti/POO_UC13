<?php
 
class Escola {
    public $nome;
    private $cnpj;
    public $endereco;
    public $cidade;
   
 
    // Construtor com validação
    public function __construct($nome, $cnpj, $endereco,$cidade ) {
        if (empty($nome)) {
            throw new Exception("O campo Nome é obrigatório.");
        }
        if (empty($cnpj)) {
            throw new Exception("O campo CNPJ é obrigatório.");
        }
        if (empty($endereco)) {
            throw new Exception("O campo Endereço é obrigatório.");
        }
        if (empty($cidade)) {
            throw new Exception("O campo Cidade é obrigatório.");
        }
        $this->nome = $nome;
        $this->cnpj = $cnpj;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
    }
 
    // Getter do Cnpj (encapsulamento)
    public function getCnpj() {
        return $this->cnpj;
    }
 
    // Método para exibir os dados
    public function exibirDados() {
        echo "Nome: <strong>$this->nome</strong><br>";
        echo "CNPJ: <strong>" . $this->getCnpj() . "</strong><br>";
        echo "Endereço: <strong>$this->endereco</strong><br>";
        echo "Cidade: <strong>$this->cidade</strong></p>";
    }
}