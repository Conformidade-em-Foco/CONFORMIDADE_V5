<?php
session_start();
require_once '../config/conn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'dpo') {
    header('Location: ../login/');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

include_once '../includes/header_painel.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel DPO</title>
    <link rel="stylesheet" href="../assets/css/painel.css">
</head>
<body>
    <div class="container">
        <h2>👤 Bem-vindo, <?= htmlspecialchars($usuario['nome_completo']) ?></h2>
        <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>

        <h3><a href="empresas_disponiveis.php">🏢 Empresas que procuram DPO</a></h3>
        <?php include 'listar_usuarios.php'; listarEmpresas($pdo); ?>

        <p style="margin-top: 20px;">
            <a href="chat.php">💬 Acessar Chat</a>
        </p>
    </div>
</body>
</html>
