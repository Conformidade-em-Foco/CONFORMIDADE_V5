<?php
session_start();

if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<link rel="stylesheet" href="css/admin-login.css">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin | LGPD em Foco</title>
</head>
<body>
    <div class="box">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['admin_usuario'] ?? 'Administrador'); ?>!</h1>
        <p>Você acessou o painel administrativo com sucesso.</p>

        <div class="menu">
            <a href="views/gerenciar_usuarios.php">👤 Gerenciar Usuários</a>
            <a href="views/editar_banner.php">🖼️ Editar Banner</a>
            <a href="views/noticias.php">📰 Gerenciar Notícias</a>
            <a href="logout.php">🚪 Sair</a>
        </div>
    </div>
</body>
</html>
