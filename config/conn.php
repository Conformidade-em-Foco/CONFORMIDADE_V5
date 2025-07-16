<?php
$host = 'localhost';
$dbname = 'lgpd_em_foco'; // ou o nome real do seu banco
$user = 'root';
$pass = ''; // senha vazia no XAMPP por padrão

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
