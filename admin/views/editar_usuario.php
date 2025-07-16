<?php
require_once '../../config/conn.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID inválido.");
}

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_completo'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $tipo = $_POST['tipo_usuario'];

    $update = $pdo->prepare("UPDATE usuarios SET nome_completo = ?, email = ?, cidade = ?, tipo_usuario = ? WHERE id = ?");
    $update->execute([$nome, $email, $cidade, $tipo, $id]);

    header("Location: gerenciar_usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../css/admin-usuarios.css">
</head>
<body>
    <h2>✏️ Editar Usuário</h2>
    <form method="POST">
        <label>Nome completo:</label><br>
        <input type="text" name="nome_completo" value="<?= htmlspecialchars($usuario['nome_completo']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>

        <label>Cidade:</label><br>
        <input type="text" name="cidade" value="<?= htmlspecialchars($usuario['cidade']) ?>"><br><br>

        <label>Tipo de usuário:</label><br>
        <select name="tipo_usuario" required>
            <option value="dpo" <?= $usuario['tipo_usuario'] == 'dpo' ? 'selected' : '' ?>>DPO</option>
            <option value="empresa" <?= $usuario['tipo_usuario'] == 'empresa' ? 'selected' : '' ?>>Empresa</option>
        </select><br><br>

        <button type="submit">Salvar</button>
        <a href="gerenciar_usuarios.php">Cancelar</a>
    </form>
</body>
</html>
