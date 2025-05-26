<?php
include 'db/conection.php';

class usuario {
    private $conn;

    public function __construct() {
        $database = new Conexao();
        $this->conn = $database->getConexao();
    }

    public function autenticar($email, $senha) {
        $sql = "SELECT * FROm login WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (($senha == $usuario['senha'])) {
                return $usuario;
            }
        }
        return false;
    }
}
