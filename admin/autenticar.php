<?php
session_start();
require_once '../config/conn.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuarios_admin WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_usuario'] = $row['usuario'];
            $_SESSION['admin_nome'] = $row['nome_completo'];

            header("Location: /lgpd/admin/dashboard.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Requisição inválida!'); window.location.href='login.php';</script>";
}
?>
