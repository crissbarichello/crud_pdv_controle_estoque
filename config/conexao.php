<?php
// Configurações da Despensa (Banco de Dados)
$host = "localhost";
$db   = "db_restaurante";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Chave da despensa funcionando!"; 
} catch (PDOException $e) {
    die("Erro ao abrir a despensa: " . $e->getMessage());
}