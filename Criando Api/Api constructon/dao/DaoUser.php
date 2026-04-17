<?php
require_once __DIR__ . "/../database/connect.php";

class DaoUser {
    private $conn;

    public function __construct() {
        global $PDO_CONN;
        $this->conn = $PDO_CONN;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT id_usuario, nome, email, senha, hierarquia 
                FROM usuarios 
                WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($nome, $email, $senha) {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome'  => $nome,
            ':email' => $email,
            ':senha' => sha1($senha) // hash SHA1
        ]);
    }

    public function getUserById($id) {
        $sql = "SELECT id_usuario, nome, email, data_criacao, ultimo_login, hierarquia
                FROM usuarios 
                WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
