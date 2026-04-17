<?php
$host = 'localhost';
$db   = 'sistema_login';
$user = 'root';
$pass = '';

try {
    $PDO_CONN = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $PDO_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
