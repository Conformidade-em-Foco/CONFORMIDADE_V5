<?php
session_start();
require_once '../config/conn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'empresa') {
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
    <title>Painel da Empresa</title>
    <link rel="stylesheet" href="../assets/css/painel.css">
</head>
<body>
    <div class="container">
        <h2>🏢 Bem-vindo(a), <?= htmlspecialchars($usuario['razao_social'] ?? $usuario['email']) ?></h2>
        <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>

        <h3><a href="dpos_disponiveis.php">👨‍💼 DPOs disponíveis</a></h3>
        <?php include 'listar_usuarios.php'; listarDPOs($pdo); ?>

        <p style="margin-top: 20px;">
            <a href="chat.php">💬 Acessar Chat</a>
        </p>
    </div>
</body>
</html>
