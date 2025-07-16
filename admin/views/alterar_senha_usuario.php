<?php
require_once '../../config/conn.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID inválido.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['nova_senha'];
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $update = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
    $update->execute([$hash, $id]);

    header("Location: gerenciar_usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="../css/admin-usuarios.css">
</head>
<body>
    <h2>🔐 Alterar Senha do Usuário</h2>
    <form method="POST">
        <label>Nova senha:</label><br>
        <input type="password" name="nova_senha" required><br><br>
        <button type="submit">Salvar Senha</button>
        <a href="gerenciar_usuarios.php">Cancelar</a>
    </form>
</body>
</html>
